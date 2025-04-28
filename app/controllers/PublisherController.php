<?php

class PublisherController extends Controller
{
    public function index()
    {




        $book = new PublisherBooks();
        $bookDetails = $book->getBookList();


        $publisherBooks = [];
        foreach ($bookDetails as $book) {
            $publisherBooks[$book['author']][] = $book;
        }

        $this->view('publisher/PublisherPage4UsersO', ['publisherBooks' => $publisherBooks]);
    }

    public function BookDesign()
    {
        $publisherBook_table = new publisherBooks();
        $bookDetails = $publisherBook_table->where(['publisherID' => $_SESSION['user_id']]);


    }

    public function AddBook()
    {

        $publisherBooksTable = new publisherBooks();

        $this->view('publisher/bookUploadForm4Publishers');
    }

    public function checkIsbn()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $isbnID = $_POST['isbnID'];
            $book = new publisherBooks();

            if ($book->first(['isbnID' => $isbnID])) {
                echo 'exists';
            } else {
                echo 'not_exists';
            }
        }
    }


    public function BookUpload()
    {



        $requiredFields = ['title', 'isbnID', 'author_name', 'genre', 'publication_year', 'synopsis', 'prize'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                die('Error: Missing required field: ' . htmlspecialchars($field));
            }
        }


        if (!isset($_FILES['bookCover']) || $_FILES['bookCover']['error'] === UPLOAD_ERR_NO_FILE) {
            die('Error: No book cover uploaded.');
        }

        $title = $_POST['title'];
        $isbnID = $_POST['isbnID'];
        $author_name = $_POST['author_name'];
        $contributor_name = $_POST['contributor_name'] ?? '';
        $genre = $_POST['genre'];
        $publication_year = (int) $_POST['publication_year'];
        $synopsis = substr($_POST['synopsis'], 0, 1000);
        $prize = (float) $_POST['prize'];
        $created_at = date("Y-m-d H:i:s");




        $coverImage = $_FILES['bookCover'];
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxFileSize = 2 * 1024 * 1024;
        if (!in_array($coverImage['type'], $allowedTypes)) {
            die('Error: Only JPG or PNG files are allowed.');
        }
        if ($coverImage['size'] > $maxFileSize) {
            die('Error: File size exceeds 2MB limit.');
        }


        $fileName = time() . '_' . basename($coverImage['name']);
        $targetPath = '../app/images/coverDesign/' . $fileName;
        if (!move_uploaded_file($coverImage['tmp_name'], $targetPath)) {
            die('Error: Failed to upload book cover.');
        }


        $publisherBooks_table = new publisherBooks();


        $data = [
            'title' => $title,
            'isbnID' => $isbnID,
            'author_name' => $author_name,
            'contributor_name' => $contributor_name,
            'genre' => $genre,
            'publication_year' => $publication_year,
            'synopsis' => $synopsis,
            'prize' => $prize,
            'created_at' => $created_at,
            'coverImage' => $fileName,
            'publisherID' => $_SESSION['user_id']
        ];
        $result = $publisherBooks_table->insert($data);

        if ($result) {
            header('Location: /Free-Write/public/User/Profile?success=Book uploaded successfully');
        } else {

            if (file_exists($targetPath)) {
                unlink($targetPath);
            }
            die('Error: Failed to save book details to the database.');
        }
    }

    public function bookProfile4publishers()
    {

        $URL = splitURL();
        $bookID = $URL[2];
        $book_table = new publisherBooks();
        $bookDetails = $book_table->first(['isbnID' => $bookID]);

        $this->view('publisher/bookDesign4Publishers', ['bookDetails' => $bookDetails]);
    }
    public function bookProfile4Users()
    {
        $URL = splitURL();
        $bookID = $URL[2];
        $book_table = new publisherBooks();
        $bookDetails = $book_table->first(['isbnID' => $bookID]);
        $cartItems = null;
        $publisherTable = new Publisher();
        $publisherDetails = $publisherTable->first(['pubID' => $bookDetails['publisherID']]);

        if (isset($_SESSION['user_id'])) {
            $cartTable = new Cart();
            $cartItems = $cartTable->first(['bookID' => $bookID, 'userID' => $_SESSION['user_id']]);
        }

        $this->view('publisher/bookDesign4Users', ['bookDetails' => $bookDetails, 'cartItems' => $cartItems,]);
    }
    public function deletebookProfile()
    {
        if (!isset($_POST['isbnID'])) {
            header('Location: /Free-Write/public/User/Profile');
            exit();
        }

        $bookID = $_POST['isbnID'];
        $book_table = new publisherBooks();


        $book = $book_table->first([
            'isbnID' => $bookID,
            'publisherID' => $_SESSION['user_id']
        ]);

        if ($book) {
            $book_table->delete($bookID, 'isbnID');
        }

        header('Location: /Free-Write/public/User/Profile');
        exit();
    }
    public function Profile()
    {
        $URL = splitURL();

        $userID = $URL[2];
        $publisher_table = new Publisher();
        $publisherDetails = $publisher_table->first(['pubID' => $userID]);
        $publisherBooks = new PublisherBooks();
        $recentBooks = $publisherBooks->getRecentBooks($userID);
        $this->view('publisher/publisherProfile4User', ['publisherDetails' => $publisherDetails, 'recentBooks' => $recentBooks]);
    }

    public function bookList()
    {
        $URL = splitURL();
        $publisherID = $URL[2];
        $allBookDetails_table = new publisherBooks();
        $allBookDetails = $allBookDetails_table->where(['publisherID' => $publisherID]);

        $pubDetails_table = new Publisher();
        $pubDetails = $pubDetails_table->first(['pubID' => $publisherID]);

        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $publisherID]);


        $this->view('publisher/allPublicationList', [
            'allBookDetails' => $allBookDetails,
            'pubDetails' => $pubDetails,
            'userDetails' => $userDetails
        ]);
    }

    public function regPage()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $user = new User();
            $userDetails = new UserDetails();
            $publisher = new Publisher();


            $user->updateToPub("pub", $_SESSION['user_id']);

            $userDetails->updatePubDetail($_POST['description'], $_POST['dob'], $_POST['country'], $_SESSION['user_id']);


            if (isset($_POST['logout_after'])) {
                header('Location: /Free-Write/public/Login/logout');
                exit();
            }
        }
        $userDetails = new User();
        $userDetails = $userDetails->first(['userID' => $_SESSION['user_id']]);

        $this->view('publisher/publisherRegistrationPage', ['userDetails' => $userDetails]);
    }
    public function courier()
    {

        $this->view('publisher/courierLandingPage');
    }
    public function courierReview()
    {
        $this->view('publisher/courierReview');
    }

    public function paymentPage()
    {
        $URL = splitURL();
        $bookID = $URL[2];
        $quantityFromCart = isset($URL[3]) ? $URL[3] : null;
        $quantity = isset($_GET['quantity']) ? (int) $_GET['quantity'] : 1;

        $book_table = new publisherBooks();
        $bookDetails = $book_table->first(['isbnID' => $bookID]);


        $totalPrice = $bookDetails['prize'] * $quantity;







        $orderDetails = [
            'Item' => $bookDetails['title'],
            'Quantity' => isset($quantityFromCart) ? $quantityFromCart : $quantity,
            'Price' => $totalPrice,
            'Total' => $totalPrice
        ];

        $this->view(
            'paymentPage',
            [
                'type' => "PublisherBook",
                'orderInfo' => $orderDetails,
                'itemID' => $bookID
            ]
        );
    }

    public function updateBookDetails()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'title' => trim($_POST['title']),
                'author_name' => trim($_POST['author_name']),
                'synopsis' => trim($_POST['synopsis']),
                'prize' => trim($_POST['prize']),
                'genre' => trim($_POST['genre']),
                'contributor_name' => trim($_POST['publisher']),
                'publication_year' => trim($_POST['published_date']),

            ];
            $isbnID = (string) trim($_POST['isbnID']);

            $publisherBooks = new PublisherBooks();
            if ($publisherBooks->updateBookDetails($isbnID, $data)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
            exit;
        }
    }

    public function applyingAdvertisement()
    {
        $URL = splitURL();
        $adDetails = null;
        if (!empty($URL[2])) {
            $adID = $URL[2];
            $adModel = new Advertisement();
            $adDetails = $adModel->first(['adID' => $adID]);
        }

        $adModel = new Advertisement();
        $latestEndDate = $adModel->getLatestEndDate();



        $this->view('publisher/advertisementApplication', ['latestEndDate' => $latestEndDate, 'adDetails' => $adDetails]);
    }

    public function ApplyAdvertisement()
    {

        $ad_title = $_POST['ad_title'];
        $ad_type = $_POST['ad_type'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $contact_email = $_POST['contact_email'];

        $start_date_obj = new DateTime($start_date);
        $end_date_obj = new DateTime($end_date);


        $interval = $start_date_obj->diff($end_date_obj);


        $days = $interval->days;

        $total = $days * 100;


        $adImage = $_FILES['ad_image'];
        $fileName = time() . '_' . $adImage['name'];
        $targetPath = '../app/images/advertisements/' . $fileName;

        if (move_uploaded_file($adImage['tmp_name'], $targetPath)) {
            $advertisement_table = new Advertisement();
            $existingAds = $advertisement_table->where(['pubID' => $_SESSION['user_id']]);
            $status = empty($existingAds) ? 'active' : 'pending';
            $data = [
                'advertisementType' => $ad_type,
                'startDate' => $start_date,
                'endDate' => $end_date,
                'contactEmail' => $contact_email,
                'adImage' => $fileName,
                'pubID' => $_SESSION['user_id'],
                'status' => $status,
                'days' => $days,
                'total' => $total,
                'ad_title' => $ad_title
            ];
        }
        $this->view('publisher/paymentPage4Ad', ['adDetails' => $data]);
    }
    public function RenewAdvertisement()
    {
        $adID = $_POST['adID'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $advertisement_table = new Advertisement();
        $expiredAd = $advertisement_table->first(['adID' => $adID]);

        $start_date_obj = new DateTime($start_date);
        $end_date_obj = new DateTime($end_date);


        $interval = $start_date_obj->diff($end_date_obj);


        $days = $interval->days;

        $total = $days * 100;
        $renewedData = [
            'advertisementType' => $expiredAd['advertisementType'],
            'adImage' => $expiredAd['adImage'],
            'pubID' => $_SESSION['user_id'],
            'startDate' => $start_date,
            'endDate' => $end_date,
            'contactEmail' => $expiredAd['contactEmail'],
            'status' => 'pending',
            'days' => $days,
            'total' => $total,


        ];


        $this->view('publisher/paymentPage4Ad', ['adDetails' => $renewedData, 'adId' => $adID]);
    }

    public function deleteAdvertisement()
    {

        $adID = $_POST['adID'];
        $advertisement_table = new Advertisement();


        $advertisement = $advertisement_table->first([
            'adID' => $adID,
            'pubID' => $_SESSION['user_id']
        ]);

        if ($advertisement) {
            $advertisement_table->delete($adID, 'adID');
        }

        header('Location: /Free-Write/public/User/Profile');
        exit();
    }

    public function payPage4ad()
    {
        $adID = $_POST['adID'];
        $oldEndDate = $_POST['oldEndDate'];
        $newEndDate = $_POST['newEndDate'];


        $fileName = null;
        if (isset($_FILES['newAdImage']) && $_FILES['newAdImage']['size'] > 0) {
            $adImage = $_FILES['newAdImage'];
            $fileName = time() . '_' . $adImage['name'];
            $targetPath = '../app/images/advertisements/' . $fileName;
            move_uploaded_file($adImage['tmp_name'], $targetPath);
        }

        $this->view('publisher/paymentPage4ad', [
            'adID' => $adID,
            'oldEndDate' => $oldEndDate,
            'newEndDate' => $newEndDate,
            'newImage' => $fileName
        ]);
    }

    public function updateAdvertisementAfterPayment()
    {
        $adID = $_POST['adID'];
        $newEndDate = $_POST['newEndDate'];
        $newImage = $_POST['newImage'];

        $data = [
            'endDate' => $newEndDate
        ];

        if ($newImage) {
            $data['adImage'] = $newImage;
        }

        $advertisement_table = new Advertisement();
        $advertisement_table->update($adID, $data, 'adID');

        header('Location: /Free-Write/public/User/Profile');
        exit();
    }

    public function sendQuotation2Wri()
    {
        $bookId = $_POST['book_id'];
        $writerId = $_POST['writer_id'];
        $publisherId = $_SESSION['user_id'];
        $newMessage = $_POST['message'];

        $quotation_table = new Quotation();

        $existingQuotation = $quotation_table->first([
            'publisher' => $publisherId,
            'writer' => $writerId
        ]);

        $currentDate = date('Y-m-d H:i:s');
        $formattedMessage = "\n[" . $currentDate . " - Publisher] " . $newMessage;

        if ($existingQuotation) {

            $updatedMessage = $existingQuotation['message'] . $formattedMessage;

            $primaryKeyField = 'quotaID';

            $quotation_table->update($existingQuotation[$primaryKeyField], [
                'message' => $updatedMessage,
                'sendDate' => date('Y-m-d')
            ], $primaryKeyField);
        } else {

            $quotation_table->insert([
                'publisher' => $publisherId,
                'message' => $formattedMessage,
                'sendDate' => date('Y-m-d'),
                'writer' => $writerId,
            ]);
        }

        header('Location: /Free-Write/public/book/Overview/' . $bookId);
        exit();
    }
    public function sendQuotationChat()
    {
        $bookId = $_POST['book_id'];
        $newMessage = $_POST['message'];
        $userType = $_SESSION['user_type'];


        if ($userType == 'pub') {
            $writerId = $_POST['writer_id'];
            $publisherId = $_SESSION['user_id'];
            $senderLabel = "Publisher";
        } else if ($userType == 'writer') {
            $writerId = $_SESSION['user_id'];
            $publisherId = $_POST['publisher_id'];
            $senderLabel = "Writer";
        } else {

            header('Location: /Free-Write/public/User/Profile');
            exit();
        }

        $quotation_table = new Quotation();

        $existingQuotation = $quotation_table->first([
            'publisher' => $publisherId,
            'writer' => $writerId
        ]);

        $currentDate = date('Y-m-d H:i:s');
        $formattedMessage = "\n[" . $currentDate . " - " . $senderLabel . "] " . $newMessage;


        if ($existingQuotation) {

            $updatedMessage = $existingQuotation['message'] . $formattedMessage;

            $primaryKeyField = 'quotaID';

            $quotation_table->update($existingQuotation[$primaryKeyField], [
                'message' => $updatedMessage,
                'sendDate' => date('Y-m-d')
            ], $primaryKeyField);
        } else {

            $quotation_table->insert([
                'publisher' => $publisherId,
                'message' => $formattedMessage,
                'sendDate' => date('Y-m-d'),
                'writer' => $writerId,
            ]);
        }

        header('Location: /Free-Write/public/Publisher/viewQuotationHistory/User/Profile#quotations');
        exit();
    }

    public function viewQuotationHistory()
    {

        $writerId = $_GET['writer_id'];
        $bookId = $_GET['book_id'];

        if (!$writerId || !$bookId) {
            header('Location: /Free-Write/public/User/Profile');
            exit();
        }


        $writer = new UserDetails();
        $writerDetails = $writer->first(['user' => $writerId]);
        $writerName = $writerDetails['firstName'] . ' ' . $writerDetails['lastName'] ?? 'Unknown Writer';



        $quotation = new Quotation();
        $quotationHistory = $quotation->first([
            'publisher' => $_SESSION['user_id'],
            'writer' => $writerId
        ]);


        $messages = [];
        if ($quotationHistory && !empty($quotationHistory['message'])) {

            $lines = explode("\n", $quotationHistory['message']);
            foreach ($lines as $line) {
                if (empty(trim($line)))
                    continue;


                if (preg_match('/\[(.*?) - (.*?)\] (.*)/', $line, $matches)) {
                    $timestamp = $matches[1];
                    $senderType = strtolower($matches[2]);
                    $content = $matches[3];

                    $messages[] = [
                        'timestamp' => $timestamp,
                        'sender_type' => $senderType,
                        'sender_name' => $senderType == 'publisher' ? 'You' : $writerName,
                        'content' => $content
                    ];
                }
            }
        }

        $this->view('publisher/quotationHistory', [
            'writerName' => $writerName,
            'writerId' => $writerId,
            'bookId' => $bookId,
            'messages' => $messages,
            'quotationHistory' => $quotationHistory
        ]);
    }
    public function editQuotationMessage()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /Free-Write/public/User/Profile');
            exit();
        }

        $quotationId = $_POST['quotation_id'] ?? null;
        $messageIndex = $_POST['message_index'] ?? null;
        $writerId = $_POST['writer_id'] ?? null;
        $bookId = $_POST['book_id'] ?? null;
        $editedMessage = $_POST['edited_message'] ?? '';

        if (!$quotationId || !isset($messageIndex) || !$writerId || !$bookId) {
            $_SESSION['error_message'] = "Missing required information";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        $quotation = new Quotation();
        $quotationData = $quotation->first(['quotaID' => $quotationId]);

        if (!$quotationData || $quotationData['publisher'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = "You don't have permission to edit this message";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        $messages = [];
        $lines = explode("\n", $quotationData['message']);
        foreach ($lines as $line) {
            if (empty(trim($line)))
                continue;

            if (preg_match('/\[(.*?) - (.*?)\] (.*)/', $line, $matches)) {
                $timestamp = $matches[1];
                $senderType = $matches[2];
                $content = $matches[3];

                $messages[] = [
                    'timestamp' => $timestamp,
                    'sender_type' => $senderType,
                    'content' => $content,
                    'full_line' => $line
                ];
            }
        }


        if (!isset($messages[$messageIndex])) {
            $_SESSION['error_message'] = "Invalid message index";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        if (strtolower($messages[$messageIndex]['sender_type']) !== 'publisher') {
            $_SESSION['error_message'] = "You can only edit your own messages";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        $messages[$messageIndex]['content'] = $editedMessage;
        $messages[$messageIndex]['full_line'] = '[' . $messages[$messageIndex]['timestamp'] . ' - ' . $messages[$messageIndex]['sender_type'] . '] ' . $editedMessage . ' (edited)';


        $updatedMessage = '';
        foreach ($messages as $msg) {
            $updatedMessage .= $msg['full_line'] . "\n";
        }


        $result = $quotation->update($quotationId, [
            'message' => $updatedMessage
        ], 'quotaID');

        if ($result) {
            $_SESSION['success_message'] = "Message updated successfully";
        } else {
            $_SESSION['error_message'] = "Failed to update message";
        }

        header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
        exit();
    }

    public function deleteQuotationMessage()
    {
        $quotationId = $_GET['quotation_id'] ?? null;
        $messageIndex = $_GET['message_index'] ?? null;
        $writerId = $_GET['writer_id'] ?? null;
        $bookId = $_GET['book_id'] ?? null;

        if (!$quotationId || !isset($messageIndex) || !$writerId || !$bookId) {
            $_SESSION['error_message'] = "Missing required information";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        $quotation = new Quotation();
        $quotationData = $quotation->first(['quotaID' => $quotationId]);

        if (!$quotationData || $quotationData['publisher'] != $_SESSION['user_id']) {
            $_SESSION['error_message'] = "You don't have permission to delete this message";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        $messages = [];
        $lines = explode("\n", $quotationData['message']);
        foreach ($lines as $line) {
            if (empty(trim($line)))
                continue;

            if (preg_match('/\[(.*?) - (.*?)\] (.*)/', $line, $matches)) {
                $timestamp = $matches[1];
                $senderType = $matches[2];
                $content = $matches[3];

                $messages[] = [
                    'timestamp' => $timestamp,
                    'sender_type' => $senderType,
                    'content' => $content,
                    'full_line' => $line
                ];
            }
        }


        if (!isset($messages[$messageIndex])) {
            $_SESSION['error_message'] = "Invalid message index";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        if (strtolower($messages[$messageIndex]['sender_type']) !== 'publisher') {
            $_SESSION['error_message'] = "You can only delete your own messages";
            header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
            exit();
        }


        array_splice($messages, $messageIndex, 1);


        $updatedMessage = '';
        foreach ($messages as $msg) {
            $updatedMessage .= $msg['full_line'] . "\n";
        }


        $result = $quotation->update($quotationId, [
            'message' => $updatedMessage
        ], 'quotaID');

        if ($result) {
            $_SESSION['success_message'] = "Message deleted successfully";
        } else {
            $_SESSION['error_message'] = "Failed to delete message";
        }

        header('Location: /Free-Write/public/Publisher/viewQuotationHistory?writer_id=' . $writerId . '&book_id=' . $bookId);
        exit();
    }
}
