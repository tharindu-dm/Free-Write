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

        $this->view(
            'paymentPage',
            [
                'type' => "Book",
                'orderInfo' => $orderDetails,
                'itemID' => $bookID
            ]
        );
    }

    public function buy_Book()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];
        $bookID = $_POST['itemID'];

        //if ($_POST['saveCard'] == 'yes') {
        //    $card = new CardDetails();
        //    $cardData = [
        //        "user" => $userID,
        //        "card_number" => $_POST['cardNumber'],
        //        "type" => $_POST['cardType'],
        //        "host" => $_POST['cardHost'],
        //        "exp_month" => $_POST['expMonth'],
        //        "exp_year" => $_POST['expYear'],
        //    ];
        //    $card->insert($cardData);
        //}

        $price = $_POST['totalPrice'];
        $buybook = new BuyBook();
        $buyBookDetails = [
            'user' => $userID,
            'book' => $bookID,
            'purchaseDateTime' => date("Y-m-d H:i:s"),
            "price" => $price,

        ];

        $buybook->insert($buyBookDetails);
        header('location:/Free-Write/public/Book/Overview/' . $bookID);
    }

    public function buy_chapter()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];
        $chapterID = $_POST['itemID'];
        $bookID = $_POST['bookID'];
        $buyChapter = new BuyChapter();
        $buyChapterDetails = [
            'user' => $userID,
            'chapter' => $chapterID,
            'purchaseDateTime' => date("Y-m-d H:i:s"),
        ];

        $buyChapter->insert($buyChapterDetails);
        header('location:/Free-Write/public/Book/Overview/' . $bookID);
    }

    public function Chapter()//buying a paid chapter
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $URL = splitURL();
        $chapterID = $URL[2];

        $chapter = new chapter();

        $chapterDetails = $chapter->getChapterByID($chapterID);
        $chapter = $chapterDetails['title_author'][0];
        $bookID = $chapter['BookID'];

        $orderDetails = [
            'Item' => $chapter['BookTitle'] . " | " . $chapter['ChapterTitle'],
            'Quantity' => 1,
            'Price' => $chapter['price'],
            'Total' => $chapter['price']
        ];

        $this->view(
            'paymentPage',
            [
                'type' => "Chapter",
                'orderInfo' => $orderDetails,
                'itemID' => $chapterID,
                'bookID' => $bookID
            ]
        );

    }

    public function Premium()
    { //premium account
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $type = $_GET['type'];

        switch ($type) {
            case 'reader':
                $orderDetails = [
                    'Item' => "Premium Reader Account",
                    'subID' => 2,
                    'Quantity' => 1,
                    'Price' => 899,
                    'Total' => 899
                ];

                $this->view('paymentPage', [
                    'type' => "premium_user",
                    'orderInfo' => $orderDetails
                ]);
                break;

            case 'writer':
                $orderDetails = [
                    'Item' => "Premium Writer Account",
                    'subID' => 3,
                    'Quantity' => 1,
                    'Price' => 1199,
                    'Total' => 1199
                ];

                $this->view('paymentPage', [
                    'type' => "premium_user",
                    'orderInfo' => $orderDetails
                ]);
                break;

            default:
                header('location:/Free-Write/public/Error404');
        }
    }

    private function makePremium()//enabling the isPremium
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];

        $user = new User();
        $user->update($userID, ['isPremium' => 1], 'userID');

        header('location:/Free-Write/public/User/Profile');
    }

    public function buy_premium_user()//subscribing to the tier
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];
        $subID = $_POST['subID'] ?? 1;
        $user = new UserSubscription();

        $user->insert([
            'user' => $userID,
            'subscription' => $subID,
            'subStartDate' => date('Y-m-d H:i:s')
        ]);
        
        $this->makePremium();
    }

    public function donateWriter()
    {
        $donation = new Donation();

        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            return;
        }

        $amount = $_POST['donateAmount'] ?? 100;
        $user = $_SESSION['user_id'];
        $writer = $_POST['writerID'];
        $date = date('Y-m-d H:i:s');

        $donation->insert(['writer' => $writer, 'user' => $user, 'amount' => $amount, 'date' => $date]);

        //send notification also
        $notification = new Notification();
        $userNotification = new UserNotification();

        $notification->insert(
            [
                'subject' => "new donation",
                'message' => 'A user donated LKR.' . $amount,
                'sentDate' => $date,
                'userTypes' => $writer
            ]
        );

        $sent = $notification->first(['sentDate' => $date]);
        $userNotification->insert([
            'user' => $writer,
            'notification' => $sent['notificationID'],
            'isRead' => 0
        ]);

        //redirect back to user profile
        header('/Free-Write/public/User/Profile?user=' . $writer);
        return;
    }

    public function buy_PublisherBook()
    {
        $publisherBooks = new PublisherBooks();

        $isbnID = $_POST['itemID'];
        $userID = $_SESSION['user_id'];
        $totalPrice = $_POST['totalPrice'];
        $orderDate = date("Y-m-d H:i:s");
        $quantity = $_POST['quantity'];

        $bookItem = $publisherBooks->first(['isbnID' => $isbnID]);

        $bookTitle = $bookItem['title'];
        $bookPublisherID = $bookItem['publisherID'];
        $deliveryStatus = 'Pending';
        $shippingAddress = $_POST['shipping_address'];
        $phoneNo = $_POST['phone_number'];

        $orderTable = new Order();
        $orderTable->insert(
            [
                'isbnID' => $isbnID,
                'customer_userID' => $userID,
                'totalPrice' => $totalPrice,
                'orderDate' => $orderDate,
                'quantity' => $quantity,
                'bookTitle' => $bookTitle,
                'status' => $deliveryStatus,
                'bookPublisherID' => $bookPublisherID,
                'shippingAddress' => $shippingAddress,
                'phoneNo' => $phoneNo
            ]
        );
        header('Location: /Free-Write/public/Publisher');

    }
    public function pay4Ad()
    {

        $ad_title = $_POST['ad_title'];
        $ad_type = $_POST['advertisementType'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $contact_email = $_POST['contact_email'];
        $advertisement_table = new Advertisement;
        if(isset( $_POST['adID'])){

            // $advertisement_table->insert($renewedData); 
        $advertisement_table->delete($_POST['adID'], 'adID');
        }

        // Handle image upload
        $adImage = $_POST['adImage'];
        
        $advertisement_table = new Advertisement;
       
        
            $advertisement_table->insert([
                'advertisementType' => $ad_type,
                'startDate' => $start_date,
                'endDate' => $end_date,
                'contactEmail' => $contact_email,
                'adImage' => $adImage,
                'pubID' => $_SESSION['user_id'],
                'status' => 'pending']);
        
        header('Location: /Free-Write/public/User/Profile');
    }
}