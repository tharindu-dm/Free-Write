<?php

class OrderController extends Controller
{
    public function index()
    {
    $orderTable = new Order();
    
    $orders = $orderTable->where(['bookPublisherID' => $_SESSION['user_id']]);
    $userName =  htmlspecialchars($order['customer_userID'] ?? ''); 
    $userDetailsTable = new UserDetails();
    $userDetails = $userDetailsTable->first(['user' => $userName]);
    $this->view('publisher/order', ['orders' => $orders, 'userDetails' => $userDetails]);
}




    public function addOrder4Pub(){
        $isbnID = $_POST['isbnID'];
        $userID = $_POST['userID'];
        $totalPrice = $_POST['totalPrice'];
        $orderDate = date("Y-m-d H:i:s");
        $quantity = $_POST['quantity'];
        $bookTitle = $_POST['bookTitle'];
        $bookPublisherID = $_POST['bookPublisherID'];

        $orderTable = new Order();
        $orderTable->insert(['isbnID' =>$isbnID, 'customer_userID' =>$userID, 'totalPrice' =>$totalPrice,'orderDate'=>$orderDate, 'quantity'=>$quantity, 'bookTitle'=>$bookTitle, 'bookPublisherID'=>$bookPublisherID]);
        header('Location: /Free-Write/public/Publisher');
    }

    public function viewStats(){
        $this->view('publisher/viewStats4Orders');
    }

}