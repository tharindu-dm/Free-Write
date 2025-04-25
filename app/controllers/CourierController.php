<?php

class CourierController extends Controller
{
    public function index()
    {
        if ($_SESSION['user_type'] == 'courier') {
            $orderTable = new Order();
            $orders = $orderTable->where(['courierID' => $_SESSION['user_id']]);

            $orderDetails = [];

            $userDetailsTable = new UserDetails();

            foreach ($orders as $order) {
                $customerID = $order['customer_userID'] ?? '';
                $customerUserDetails = $userDetailsTable->first(['user' => $customerID]);
                $customerName = htmlspecialchars(($customerUserDetails['firstName'] ?? '') . ' ' . ($customerUserDetails['lastName'] ?? ''));

                $publisherID = $order['bookPublisherID'] ?? '';
                $publisherUserDetails = $userDetailsTable->first(['user' => $publisherID]);
                $publisherName = htmlspecialchars(($publisherUserDetails['firstName'] ?? '') . ' ' . ($publisherUserDetails['lastName'] ?? ''));

                $orderDetails[] = [
                    'orderID' => $order['orderID'] ?? '',
                    'bookTitle' => $order['bookTitle'] ?? '',
                    'isbnID' => $order['isbnID'] ?? '',
                    'customerName' => $customerName,
                    'publisherName' => $publisherName,
                    'deliveryAddress' => $order['shippingAddress'] ?? '',
                    'status' => $order['delivery_status'] ?? '',
                    'orderDate' => $order['orderDate'] ?? '',
                    'phoneNo' => $order['phoneNo'] ?? '',
                    'quantity' => $order['quantity'] ?? '',
                    'courierAssigned_at' => $order['courierAssigned_at'] ?? '',
                ];
            }

            $this->view('courier/Dashboard', ['orders' => $orderDetails]);
        } else {
            header('location: /Free-Write/public/Login');
        }
    }

    public function acceptOrder()
    {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'courier') {
            $orderID = $_POST['orderID'] ?? '';

            if (!empty($orderID)) {
                $orderTable = new Order();

                if (
                    $orderTable->update($orderID, [
                        'delivery_status' => 'collectingOrder',
                        'status' => 'courierAcceptedTheOrder',
                        'courierID' => $_SESSION['user_id']
                    ], 'orderID')
                ) {
                    header('location: /Free-Write/public/Courier');
                } else {
                    echo "Failed to update order status.";
                }
            } else {
                echo "Order ID is required.";
            }
        } else {
            header('location: /Free-Write/public/Login');
        }
    }

    public function deliveryWithin1Day()
    {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'courier') {
            $orderID = $_POST['orderID'] ?? '';

            if (!empty($orderID)) {
                $orderTable = new Order();

                if (
                    $orderTable->update($orderID, [
                        'delivery_status' => 'deliveryWithin1Day',
                        'status' => 'outForDelivery',
                        'courierID' => $_SESSION['user_id']
                    ], 'orderID')
                ) {
                    header('location: /Free-Write/public/Courier');
                } else {
                    echo "Failed to update order status.";
                }
            } else {
                echo "Order ID is required.";
            }
        } else {
            header('location: /Free-Write/public/Login');
        }
    }

    public function completingOrder()
    {
        if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'courier') {
            $orderID = $_POST['orderID'] ?? '';

            if (!empty($orderID)) {
                $orderTable = new Order();

                if (
                    $orderTable->update($orderID, [
                        'delivery_status' => 'completed',
                        'status' => 'delivered',
                        'courierID' => $_SESSION['user_id']
                    ], 'orderID')
                ) {
                    header('location: /Free-Write/public/Courier');
                } else {
                    echo "Failed to update order status.";
                }
            } else {
                echo "Order ID is required.";
            }
        } else {
            header('location: /Free-Write/public/Login');
        }
    }




}