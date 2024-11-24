<?php

class PaymentController extends Controller
{
    public function loggedUserExists()//check user exsitstance
    {
        if (isset($_SESSION['user_id']))
            return true;
        else
            return false;
    }

    public function index()
    {
        $this->view('publisher/order');
    }

    //buying a paid book
    public function Book()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $URL = splitURL();
        $bookID = $URL[2];
        $book = new Book();

        $bookDetails = $book->getBookByID($bookID);
        $orderdetails = [
            'Item' => $bookDetails[0]['title'],
            'Quantity' => 1,
            'Price' => $bookDetails[0]['price'],
            'Total' => $bookDetails[0]['price']
        ];

        $this->view('paymentPage', ['type' => "Book", 'orderInfo' => $orderdetails]);
    }

    public function buy_Book()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];
        $bookID = $_POST['itemID'];

        if ($_POST['saveCard'] == 'yes') {
            $card = new CardDetails();

            $cardData = [
                "user" => $userID,
                "card_number" => $_POST['cardNumber'],
                "type" => $_POST['cardType'],
                "host" => $_POST['cardHost'],
                "exp_month" => $_POST['expMonth'],
                "exp_year" => $_POST['expYear'],
            ];
            $card->insert($cardData);
        }

        $buybook = new BuyBook();
        $buyBookDetails = [
            'user' => $userID,
            'book' => $bookID,
            'purchaseDateTime' => date("Y-m-d H:i:s"),
        ];

        $buybook->insert($buyBookDetails);
        header('location:/Free-Write/public/Book/Overview/' . $bookID);
    }

    public function Chapter()//buying a paid chapter
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $URL = splitURL();
        $chapterID = $URL[2];

    }

}