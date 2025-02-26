<?php

class Book
{
    use Model; // Use the Model trait

    protected $table = 'Book'; //when using the Model trait, this table name ise used 

    public function getFWOBooks() //browse top page suggestions
    {
        $query = "SELECT TOP(5) 
        b.bookID, 
        b.title, 
        b.price, 
        CONCAT(u.firstName, ' ', u.lastName) AS author, 
        c.[name] AS cover_image 
        FROM Book b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.accessType = 'public' AND b.[publisher] IS NULL;";

        return $this->query($query);
    }
    public function getPaidBooks()//top paid books
    {
        $query = "SELECT TOP(5) 
        b.bookID, 
        b.title, 
        b.price, 
        CONCAT(u.firstName, ' ', u.lastName) AS author, 
        c.[name] AS cover_image,
        AVG(r.rating) AS avg_rating
        FROM Book b
        JOIN [UserDetails] u ON b.author = u.[user]
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID
        LEFT JOIN [Rating] r ON b.bookID = r.[book]
        WHERE b.accessType = 'public' AND b.[price]>=0 
        GROUP BY b.bookID, b.title, b.price, u.firstName, u.lastName, c.[name]
        ORDER BY avg_rating DESC;";

        return $this->query($query);
    }

    public function getBookByID($bid) //seeach for a book by given ID
    {
        $query = "SELECT 
        b.[bookID], 
        b.[author], 
        b.[title], 
        b.[Synopsis], 
        b.[accessType], 
        b.[lastUpdateDate], 
        b.[isCompleted], 
        b.[viewCount] ,
        b.[price], 
        CONCAT(u.[firstName], ' ', u.[lastName]) AS authorName, 
        c.[name] AS cover_image 
        FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.[bookID] = $bid;";

        return $this->query($query);
    }

    public function getTop5BooksByGenre($genreID)
    {
        $query = "SELECT TOP(5) 
        b.bookID, 
        b.title, 
        b.price, 
        CONCAT(u.firstName, ' ', u.lastName) AS author, 
        c.[name] AS cover_image
        FROM Book b
        JOIN BookGenre bg ON b.bookID = bg.book
        JOIN [UserDetails] u ON b.author = u.[user]
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID
        WHERE bg.genre = $genreID AND b.accessType = 'public'
        ORDER BY b.viewCount DESC;";

        return $this->query($query, [$genreID]);
    }


    public function getBookByAuthor($uid)
    {
        $query = "SELECT 
        b.[bookID], 
        b.[title], 
        b.[Synopsis], 
        b.[accessType], 
        b.[lastUpdateDate], 
        b.[isCompleted], 
        b.[price], 
        CONCAT(u.[firstName], ' ', u.[lastName]) AS author, 
        c.[name] AS cover_image FROM [Book] b 
        JOIN [UserDetails] u ON b.author = u.[user] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE b.[author] = $uid;";

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
        WHERE [title] LIKE '%$searchTitle%'";

        return $this->query($query);
    }

}

