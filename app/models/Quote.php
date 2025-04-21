<?php

class Quote
{
    use Model; // Use the Model trait for database interaction

    protected $table = 'Quote'; // Specify the table name

    public function addQuote($chapter, $quote)
    {
        $query = "INSERT INTO $this->table (chapter, quote) VALUES (:chapter, :quote)";
        $params = [
            ':chapter' => $chapter,
            ':quote' => $quote,
        ];
        return $this->query($query, $params);
    }

    public function getQuotes($chapter = null)
    {
        if ($chapter) {
            $query = "SELECT * FROM $this->table WHERE chapter = :chapter";
            $params = [':chapter' => $chapter];
        } else {
            $query = "SELECT * FROM $this->table";
            $params = [];
        }

        return $this->query($query, $params);
    }

    public function getQuoteByID($quoteID)
    {
        $query = "SELECT 
            q.quoteID,
            b.bookID,
            q.quote, 
            c.title AS chapter_name, 
            c.chapterID,
            bc.book,
            b.title AS book_name,
            u.userID
        FROM 
            Quote q
        LEFT JOIN Chapter c ON q.chapter = c.chapterID
        LEFT JOIN BookChapter bc ON c.chapterID = bc.chapter
        LEFT JOIN [Book] b ON bc.book = b.bookID
        LEFT JOIN [User] u ON b.author = u.userID
        WHERE 
            q.quoteID = :quoteID";
    
        $params = [':quoteID' => $quoteID];
        $result = $this->query($query, $params);
     
        if ($result) {
            return $result[0]; // Return the first result if found
        } else {
            return null; // No results found
        }
    }
    


    public function getQuoteByAuthor($uid)
    {
    
    $query = "SELECT 
    q.quoteID,
    q.quote, 
    c.title AS chapter_name, 
    bc.book,
    b.title AS book_name
    FROM 
    Quote q
    JOIN 
    Chapter c ON q.chapter = c.chapterID
    JOIN 
    BookChapter bc ON c.chapterID = bc.chapter
    JOIN 
    [Book] b ON bc.book = b.bookID
    WHERE 
    b.author =$uid";

    return $this->query($query);
    }
}

