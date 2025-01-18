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
        $orderDetails = [
            'Item' => $bookDetails[0]['title'],
            'Quantity' => 1,
            'Price' => $bookDetails[0]['price'],
            'Total' => $bookDetails[0]['price']
        ];

        $this->view('paymentPage', ['type' => "Book", 'orderInfo' => $orderDetails]);
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

    public function Premium()
    { //premium account
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $type = $_GET['type'];

        switch ($type) {
            case 'reader':
                $orderDetails = ['Item' => "Premium Reader Account", 'Quantity' => 1, 'Price' => 899, 'Total' => 899];
                $this->view('paymentPage', ['type' => "premium_reader", 'orderInfo' => $orderDetails]);

                break;
            case 'writer':
                $orderDetails = ['Item' => "Premium Writer Account", 'Quantity' => 1, 'Price' => 1199, 'Total' => 1199];
                $this->view('paymentPage', ['type' => "premium_writer", 'orderInfo' => $orderDetails]);
                break;
            default:
                header('location:/Free-Write/public/Error404');
        }
    }

    private function makePremium()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];

        $user = new User();
        $user->update($userID, ['isPremium' => 1], 'userID');

        header('location:/Free-Write/public/User/Profile');
    }
    public function buy_premium_reader()
    {
        $this->makePremium();
    }

    public function buy_premium_writer()
    {
        $this->makePremium();
    }

}