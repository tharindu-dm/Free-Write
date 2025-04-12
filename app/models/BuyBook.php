<?php

class BuyBook
{
    use Model; // Use the Model trait

    protected $table = 'BuyBook'; //when using the Model trait, this table name ise used 

    public function getBoughtBooks($uid)
    {
        $sql = "SELECT b.[title], c.[name]as covimage, CONCAT(ud.[FirstName],'',ud.[LastName]) AS author FROM BuyBook bb 
        LEFT JOIN [Book] b ON bb.[book] = b.[bookID]
        LEFT JOIN [UserDetails] ud ON b.[author] = ud.[user]
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.[covID]
        WHERE bb.[user] = $uid";

        return $this->query($sql);
    }
}