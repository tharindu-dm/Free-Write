<?php

class Cart 
{
    use Model;
    protected $table = 'Cart';
    
    
    
    
    public function getCartWithBookDetails($userID)
    {
        $query = "SELECT c.*, b.title, b.price as bookPrice, b.coverImage, 
                  CONCAT(u.firstName, ' ', u.lastName) as authorName
                  FROM [Cart] c
                  JOIN [Book] b ON c.bookID = b.bookID
                  JOIN [UserDetails] u ON b.author = u.user
                  WHERE c.userID = ? AND c.status = 'active'";
                  
        return $this->query($query, [$userID]);
    }
    
    
    public function getCartTotal($userID)
    {
        $query = "SELECT SUM(c.quantity * c.price) as total
                  FROM [Cart] c
                  WHERE c.userID = ? AND c.status = 'active'";
                  
        $result = $this->query($query, [$userID]);
        return $result[0]['total'] ?? 0;
    }
    
    
    public function isBookInCart($userID, $bookID)
    {
        $result = $this->first([
            'userID' => $userID,
            'bookID' => $bookID,
            'status' => 'active'
        ]);
        
        return !empty($result);
    }

    public function getCartItems($uid){
        $query = "SELECT c.*, b.title as bookTitle
                  FROM [Cart] c
                  JOIN [PublisherBooks] b ON c.bookID = b.isbnID
                  WHERE c.userID = $uid AND c.status = 'active'";

        return $this->query($query);
    }
}
