<?php
class CartController extends Controller
{
    public function addToCart()
    {
        $isbnID = $_POST['isbnID'] ?? null;
        $userID = $_SESSION['user_id'];
        $quantity = ($_POST['quantity'] ?? 1);
        $price = ($_POST['price'] ?? 0);
        $totalPrice = $price * $quantity;
        echo "<pre>";
        print_r($totalPrice);
        echo "</pre>";

        $cartTable = new Cart();
        $cartTable->insert([
            'userID' => $userID,
            'bookID' => $isbnID,
            'quantity' => $quantity,
            'price' => $price,
            'status' => 'active',
            'dateAdded' => date('Y-m-d H:i:s')
        ]);

        header('Location: /Free-Write/public/Publisher/bookProfile4Users/' . $isbnID);
        exit;
    }

    public function removeFromCart()
    {
        $cartID = $_POST['cartID'];
        $cartTable = new Cart();
        $cartTable->delete($cartID, 'cartID');
        header('Location: /Free-Write/public/User/Profile');
        exit;
    }

    public function UpdateQuantity()
    {
// Simple backend handling
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartID = $_POST['cartID'];
            $action = $_POST['action'];

            $cartTable = new Cart();
            $item = $cartTable->first(['cartID' => $cartID, 'userID' => $_SESSION['user_id']]);

            if ($item) {
                $quantity = $item['quantity'];
                if ($action === 'increase') {
                    $quantity += 1;
                } elseif ($action === 'decrease' && $quantity > 1) {
                    $quantity -= 1;
                }
                $cartTable->update($cartID,  ['quantity' => $quantity], 'cartID');

                echo json_encode(['success' => true, 'newQuantity' => $quantity]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Item not found.']);
            }
        }
    }
}
