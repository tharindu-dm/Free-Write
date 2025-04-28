<?php
class Order
{
    use Model; 

    protected $table = 'Order';  
     
    public function addOrder($isbnID,$userID,$totalPrice,$orderDate,$quantity)
    {
        $orderData=[
            'isbnID' => $isbnID,
            'customer_userID' => $userID,
            'totalPrice' => $totalPrice,
            'orderDate' => $orderDate,
            'quantity' => $quantity
        ];
        return $this->insert($orderData);
    }
}
