<?php
class Order
{
    use Model; // Use the Model trait

    protected $table = 'Order'; //when using the Model trait, this table name ise used 
     
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
