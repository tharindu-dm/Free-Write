<?php

class CollectionBook
{
    use Model; // Use the Model trait

    protected $table = 'CollectionBook'; //when using the Model trait, this table name ise used 

    public function deleteBookRecord($collection, $book)
    {
        $query = "DELETE FROM [dbo].[CollectionBook] WHERE [Book] = $book AND [collection] = $collection;";
        return $this->query($query);
    }

    public function getBooksInCollection($collectionID)
    {
        $query = "SELECT b.[bookID], b.[title], b.[price], CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS cover_image 
        FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        JOIN [CollectionBook] cb ON b.bookID = cb.Book
        WHERE cb.collection = $collectionID;";

        return $this->query($query);
    }
}
