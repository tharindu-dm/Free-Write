<?php

class Book
{
    use Model; // Use the Model trait

    protected $table = 'Book'; //when using the Model trait, this table name ise used 

    public function getBooks()
    {
        $query = "SELECT b.bookID, b.title, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image FROM Book b JOIN [UserDetails] u ON b.author = u.[user] JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public';";


        return $this->query($query);
    }

}
