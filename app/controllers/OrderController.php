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
    public function addOrder4Pub()
    {
        $isbnID = $_POST['isbnID'];
        $userID = $_POST['userID'];
        $totalPrice = $_POST['totalPrice'];
        $orderDate = date("Y-m-d H:i:s");
        $quantity = $_POST['quantity'];
        $bookTitle = $_POST['bookTitle'];
        $bookPublisherID = $_POST['bookPublisherID'];
        $deliveryStatus = 'Pending';
        $shippingAddress = $_POST['shipping_address'];
        $phoneNo = $_POST['phone_number'];

        $orderTable = new Order();
        $orderTable->insert(['isbnID' => $isbnID, 'customer_userID' => $userID, 'totalPrice' => $totalPrice, 'orderDate' => $orderDate, 'quantity' => $quantity, 'bookTitle' => $bookTitle,'status'=>$deliveryStatus, 'bookPublisherID' => $bookPublisherID , 'shippingAddress' => $shippingAddress, 'phoneNo' => $phoneNo]);
        header('Location: /Free-Write/public/Publisher');
    }

    public function viewStats()
    {
        $this->view('publisher/viewStats4Orders');
    }

    public function proceedingOrder(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderID = $_POST['orderID'] ?? null;
            
            if (!$orderID) {
                // Handle error - no order ID provided
                $_SESSION['error'] = "No order ID provided";
                header('Location: /Free-Write/public/Publisher/order');
                exit;
            }
            
            $courierTable = new Courier();
            $courierDetails = $courierTable->getCourierByAssignedDate();
            $courierID = $courierDetails[0]['courierID'];
            $assignedDate = date("Y-m-d H:i:s");

            $orderTable = new Order();
            $orderTable->update($orderID,
                ['status' => 'courier Assigned', 'courierID' => $courierID , 'courierAssigned_at' => $assignedDate,'delivery_status' =>'pendingfromcourier'],'orderID'
            );

            $courierTable = new Courier();
            $courierTable->update($courierID,['assignedDate' => $assignedDate],'courierID');
            

            header('Location: /Free-Write/public/Order');
            exit;
    }
}

// public function newOrder()
//     {   $orderTable = new Order();

//         $orders = $orderTable->where(['bookPublisherID' => $_SESSION['user_id'],'status' => 'pending']);
//         $userName = htmlspecialchars($order['customer_userID'] ?? '');
//         $userDetailsTable = new UserDetails();
//         $userDetails = $userDetailsTable->first(['user' => $userName]);
//         $this->view('publisher/newOrder',['orders' => $orders, 'userDetails' => $userDetails]);
//     }

    // public function processedOrder(){
    //     $orderTable = new Order();
    //     $processedOrderDetails = $orderTable->where(['bookPublisherID' => $_SESSION['user_id'],'status' => 'courier Assigned']);
        
    //     $this->view('publisher/processedOrder', ['processedOrderDetails' => $processedOrderDetails]);
    // }

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
        
        $this->view('publisher/orderDetailPage', ['orderDetails' => $orderDetails , 'customerUserDetails' => $customerUserDetails, 'customerMainDetails' => $customerMainDetails, 'courierDetails' => $courierDetails, 'courierName' => $courierName , 'bookDetails' => $bookDetails]);
    }

    public function cancelOrder()
    {
        // Check if user is logged in
        if (!isset($_SESSION['user_id'])) {
            header('Location: /Free-Write/public/Login');
            exit;
        }
        
        // Get order ID from URL parameter
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            $_SESSION['error'] = "Invalid order ID";
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }
        
        $orderID = $_GET['id'];
        $userID = $_SESSION['user_id'];
        
        // Get the order from database
        $orderTable = new Order();
        $order = $orderTable->first(['orderID' => $orderID]);
        
        // Check if order exists and belongs to current user
        if (!$order || $order['customer_userID'] != $userID) {
            $_SESSION['error'] = "You don't have permission to cancel this order";
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }
        
        // Check if order can be canceled (not already delivered or canceled)
        $nonCancelableStatuses = ['delivered', 'completed', 'canceled'];
        if (in_array($order['delivery_status'], $nonCancelableStatuses)) {
            $_SESSION['error'] = "This order cannot be canceled because it is already " . $order['delivery_status'];
            header('Location: /Free-Write/public/User/Profile');
            exit;
        }
        
        // Update order status to canceled
        $updateData = [
            'delivery_status' => 'canceled'
        ];
        
        $result = $orderTable->update($orderID, $updateData, 'orderID');
        
        if ($result) {
            $_SESSION['success'] = "Order successfully canceled";
        } else {
            $_SESSION['error'] = "Failed to cancel order. Please try again.";
        }
        
        // Redirect back to profile page
        header('Location: /Free-Write/public/User/Profile');
        exit;
    }
     

}