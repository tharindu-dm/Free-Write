<?php

class Book
{
    use Model; // Use the Model trait

    protected $table = 'Book'; //when using the Model trait, this table name ise used 

    public function getFWOBooks() //browse top page suggestions
    {
        $query = "SELECT TOP(5) b.bookID, b.title, b.price, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image 
        FROM Book b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public'
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0) AND b.[publisher] IS NULL;";

        return $this->query($query);
    }
    public function getPaidBooks()//top paid books
    {
        $query = "SELECT TOP(5) b.bookID, b.title, b.price, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image 
        FROM Book b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public'
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0) AND b.[price]>=0;";

        return $this->query($query);
    }

    public function getFreeBooks()//top paid books
    {
        $query = "SELECT TOP(5) b.bookID, b.title, b.price, CONCAT(u.firstName, ' ', u.lastName) AS author, c.[name] AS cover_image 
        FROM Book b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID WHERE b.accessType = 'public'
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0) AND (b.[price] = 0 OR b.[price] IS NULL);";

        return $this->query($query);
    }

    public function getBookByID($bid) //seeach for a book by given ID
    {
        $query = "SELECT b.[bookID], b.[author], b.[title], b.[Synopsis], b.[accessType], b.[publishType], b.[lastUpdateDate], b.[isCompleted], b.[viewCount] ,b.[price], CONCAT(u.[firstName], ' ', u.[lastName]) AS authorName, c.[name] AS cover_image 
        FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.[bookID] = $bid;";

        return $this->query($query);
    }

    public function getBookByAuthor($uid)
    {
        $query = "SELECT b.[bookID], b.[title], b.[Synopsis], b.[accessType], b.[lastUpdateDate], b.[isCompleted], b.[price], 
        CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS cover_image FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.[author] = $uid
        AND NOT b.[accessType] = 'deleted';";

        return $this->query($query);
    }
    public function getMostViewedBooks($uid)
    {
        $query = "SELECT TOP(6) b.[bookID], b.[title], b.[Synopsis] AS synopsis, b.[accessType], b.[lastUpdateDate],b.creationDate AS created_at, b.[isCompleted], b.[price], 
        CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS coverImage, b.[viewCount] AS views FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.accessType = 'public' 
        AND b.[author] = $uid 
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0)
        ORDER BY b.viewCount DESC;";

        return $this->query($query);
    }

    public function getLatestBooks($uid)
    {
        $query = "SELECT TOP(5) b.[bookID], b.[title], b.[Synopsis] AS synopsis, b.[accessType], b.[lastUpdateDate],b.creationDate AS created_at, b.[isCompleted], b.[price], 
        CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS coverImage FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.accessType = 'public' 
        AND b.[author] = $uid 
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0)
        ORDER BY b.lastUpdateDate DESC;";

        return $this->query($query);
    }

    public function getAuthorViews($uid)
    {
        $query = "SELECT SUM(viewCount) AS totalViews 
    FROM [dbo].[Book] 
    WHERE author = $uid";

        return $this->query($query);

    }

    public function searchBook($searchTitle)
    {
        $query = "SELECT TOP(10) [bookID]
        ,b.[title]
        ,b.[Synopsis]
        ,b.[author]
        ,b.[publisher]
        ,b.[accessType]
        ,b.[publishType]
        ,b.[creationDate]
        ,b.[lastUpdateDate]
        ,b.[isCompleted]
        ,b.[price]
        ,CONCAT(u.[firstName], ' ', u.[lastName]) AS author, c.[name] AS cover_image 
        FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.accessType = 'public' 
        AND NOT (b.publishType = 'book' AND b.isCompleted = 0)
        AND [title] LIKE '%$searchTitle%'";

        return $this->query($query);
    }

}

