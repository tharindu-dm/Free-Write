<?php

class Book
{
    use Model; // Use the Model trait

    protected $table = 'Book'; //when using the Model trait, this table name ise used 

    public function getFWOBooks()
    {
        $query = "SELECT TOP(5) b.bookID, b.title, b.price, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image FROM Book b JOIN [UserDetails] u ON b.author = u.[user] LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public' AND b.[publisher] IS NULL;";

        return $this->query($query);
    }
    public function getPaidBooks()
    {
        $query = "SELECT TOP(5) b.bookID, b.title, b.price, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image FROM Book b JOIN [UserDetails] u ON b.author = u.[user] LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public' AND b.[price]>=0;";

        return $this->query($query);
    }

    public function getBookByID($bid)
    {
        $query = "SELECT b.[bookID], b.[title], b.[Synopsis], b.[accessType], b.[lastUpdateDate], b.[isCompleted], b.[price], CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS cover_image FROM [Book] b JOIN [UserDetails] u ON b.author = u.[user] LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.[bookID] = $bid;";


        return $this->query($query);
    }

    public function getBookChapters($bid)
    {
        $query = "SELECT C.[chapterID],C.[title], C.[lastUpdated] FROM [dbo].[BookChapter] BC JOIN [dbo].[Chapter] C ON BC.[chapter] = C.[chapterID] WHERE BC.[book] = $bid ORDER BY C.[chapterID] ASC;";

        return $this->query($query);
    }

    public function getBookByAuthor($uid)
    {
        $query = "SELECT b.[bookID], b.[title], b.[Synopsis], b.[accessType], b.[lastUpdateDate], b.[isCompleted], b.[price], CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS cover_image FROM [Book] b JOIN [UserDetails] u ON b.author = u.[user] LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.[author] = $uid;";

        return $this->query($query);
    }

    public function getBookChapters($bid)
    {
        $query = "SELECT C.[chapterID],C.[title], C.[lastUpdated] FROM [dbo].[BookChapter] BC JOIN [dbo].[Chapter] C ON BC.[chapter] = C.[chapterID] WHERE BC.[book] = $bid ORDER BY C.[chapterID] ASC;";

        return $this->query($query);
    }
}

