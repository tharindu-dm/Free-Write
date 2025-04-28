<?php

class OrderController extends Controller
{
    public function index()
    {
        $orderTable = new Order();

        $orders = $orderTable->where(['bookPublisherID' => $_SESSION['user_id']]);
        $userName = htmlspecialchars($order['customer_userID'] ?? '');
        $userDetailsTable = new UserDetails();
        $userDetails = $userDetailsTable->first(['user' => $userName]);
        $this->view('publisher/order', ['orders' => $orders, 'userDetails' => $userDetails]);
    }
    
    public function viewStats()
    {
        $this->view('publisher/viewStats4Orders');
    }

    public function proceedingOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderID = $_POST['orderID'] ?? null;

            if (!$orderID) {
                $_SESSION['error'] = "No order ID provided";
                header('Location: /Free-Write/public/Publisher/order');
                exit;
            }

            $courierTable = new Courier();
            $courierDetails = $courierTable->getCourierByAssignedDate();
            $courierID = $courierDetails[0]['courierID'];
            $assignedDate = date("Y-m-d H:i:s");

            $orderTable = new Order();
            $orderTable->update(
                $orderID,
                ['status' => 'courier Assigned', 'courierID' => $courierID, 'courierAssigned_at' => $assignedDate, 'delivery_status' => 'pendingfromcourier'],
                'orderID'
            );

            $courierTable = new Courier();
            $courierTable->update($courierID, ['assignedDate' => $assignedDate], 'courierID');


            header('Location: /Free-Write/public/Order');
            exit;
        }
    }

    public function orderDetail()
    {
        $URL = splitURL();
        $orderID = $URL[2];
        $customerID = $URL[3];

        $userTable = new User();
        $customerMainDetails = $userTable->first(['userID' => $customerID]);

        $userDetailsTable = new UserDetails();
        $customerUserDetails = $userDetailsTable->first(['user' => $customerID]);

        $orderTable = new Order();
        $orderDetails = $orderTable->first(['orderID' => $orderID]);
        $courierID = $orderDetails['courierID'];
        $courierDetails = $userDetailsTable->first(['user' => $courierID]);
        $courierName = $courierDetails['firstName'] . ' ' . $courierDetails['lastName'];

        $bookID = $orderDetails['isbnID'];
        $bookDetailsTable = new publisherBooks();
        $bookDetails = $bookDetailsTable->first(['isbnID' => $bookID]);

        $this->view('publisher/orderDetailPage', ['orderDetails' => $orderDetails, 'customerUserDetails' => $customerUserDetails, 'customerMainDetails' => $customerMainDetails, 'courierDetails' => $courierDetails, 'courierName' => $courierName, 'bookDetails' => $bookDetails]);
    }

    public function cancelOrder()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            exit;
        }

        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['error'] = "Invalid order ID";
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }
            $URL= splitURL();
             $orderID =$URL[2];
        $userID = $_SESSION['user_id'];

        $orderTable = new Order();
        $order = $orderTable->first(['orderID' => $orderID]);

        if (!$order || $order['customer_userID'] != $userID) {
            $_SESSION['error'] = "You don't have permission to cancel this order";
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }

       
        $updateData = [
            'delivery_status' => 'canceled',
            'status' =>'canceled'
        ];

        $result = $orderTable->update($orderID, $updateData, 'orderID');

        if ($result) {
            $_SESSION['success'] = "Order successfully canceled";
        } else {
            $_SESSION['error'] = "Failed to cancel order. Please try again.";
        }

        header('Location: /Free-Write/public/User/Profile');
        exit;
    }


}