<?php

class Cart 
{
    use Model;
    protected $table = 'Cart';
    
    // You can add custom methods here as needed
    
    // Get active cart items for a user with book details
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
    
    // Get cart total for a user
    public function getCartTotal($userID)
    {
        $query = "SELECT SUM(c.quantity * c.price) as total
                  FROM [Cart] c
                  WHERE c.userID = ? AND c.status = 'active'";
                  
        $result = $this->query($query, [$userID]);
        return $result[0]['total'] ?? 0;
    }
    
    // Check if a book is already in the cart
    public function isBookInCart($userID, $bookID)
    {
        $result = $this->first([
            'userID' => $userID,
            'bookID' => $bookID,
            'status' => 'active'
        ]);
        
        return !empty($result);
    }
}
