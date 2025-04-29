<?php

class PaymentController extends Controller
{
    public function loggedUserExists()
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

    public function Chapter()
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
    {
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

    private function makePremium()
    {
        if (!$this->loggedUserExists())
            header('location:/Free-Write/public/Login');

        $userID = $_SESSION['user_id'];

        $user = new User();
        $user->update($userID, ['isPremium' => 1], 'userID');

        header('location:/Free-Write/public/User/Profile');
    }

    public function buy_premium_user()
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
        if (isset($_POST['adID'])) {


            $advertisement_table->delete($_POST['adID'], 'adID');
        }


        $adImage = $_POST['adImage'];

        $advertisement_table = new Advertisement;


        $advertisement_table->insert([
            'advertisementType' => $ad_type,
            'startDate' => $start_date,
            'endDate' => $end_date,
            'contactEmail' => $contact_email,
            'adImage' => $adImage,
            'pubID' => $_SESSION['user_id'],
            'status' => 'pending'
        ]);

        header('Location: /Free-Write/public/User/Profile');
    }

    public function buy_institute()
    {
        $name = $_POST['name'] ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $subStartDate = $_POST['subStartDate'] ?? null;
        $creator = $_POST['creator'] ?? null;

        $notification = new Notification();
        $usernotification = new UserNotification();
        $date = date("Y-m-d H:i:s");
        $notiData = [];



        error_log(print_r($_POST, true));

        $name = $_POST['name'] ?? null;
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $subStartDate = $_POST['subStartDate'] ?? null;
        $creator = $_POST['creator'] ?? null;


        $missing_fields = [];
        if (empty($name))
            $missing_fields[] = 'name';
        if (empty($username))
            $missing_fields[] = 'username';
        if (empty($password))
            $missing_fields[] = 'password';
        if (empty($subStartDate))
            $missing_fields[] = 'subStartDate';
        if (empty($creator))
            $missing_fields[] = 'creator';
        if (!empty($missing_fields)) {
            error_log("Missing fields: " . implode(", ", $missing_fields));
        }


        if (($name != null) && ($username != null) && ($password != null) && ($subStartDate != null) && ($creator != null)) {
            $institution_table = new Institution();


            $institution_table->insert(['name' => $name, 'username' => $username, 'password' => $password, 'subStartDate' => $subStartDate, 'subPlan' => 4, 'creator' => $creator]);

            $user = new User();
            $user->update($creator, ['isPremium' => 1], 'userID');

            $notiData = [
                'subject' => 'New Institute notification',
                'message' => 'New institute login',
                'sentDate' => $date,
                'userTypes' => 'institute'
            ];
        } else {
            $notiData = [
                'subject' => 'Failed to create institute',
                'message' => 'institution creations has been failed. try again later',
                'sentDate' => $date,
                'userTypes' => 'institute'
            ];
        }

        $notification->insert($notiData);
        $notifyID = $notification->first(['sentDate' => $date, 'userTypes' => 'institute'])['notificationID'];
        $usernotification->insert(
            [
                'user' => $creator,
                'notification' => $notifyID,
                'isRead' => 0
            ]
        );

        header('Location: /Free-Write/public/User/Profile');
    }
}