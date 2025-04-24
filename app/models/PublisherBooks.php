<?php

class PublisherBooks
{
    use Model; // Use the Model trait

    protected $table = 'PublisherBooks'; //when using the Model trait, this table name ise used 

    public function getBookList()
    {
        $query = "SELECT * FROM (
            SELECT 
            p.isbnID,
            p.coverImage,
            p.publisherID, 
            p.title,
            CONCAT(u.firstName, ' ', u.lastName) AS author,
            ROW_NUMBER() OVER (PARTITION BY p.publisherID ORDER BY p.isbnID /*p.created_at DESC,*/ ) as row_num 
            FROM PublisherBooks p
            JOIN [UserDetails] u ON p.publisherID = u.[user]
        ) ranked_books 
        WHERE row_num <= 4";

        return $this->query($query);
    }

    public function getRecentBooks($count = 5)
    {
        $query = "SELECT TOP 5 * FROM publisherbooks WHERE publisherID = " . $_SESSION['user_id'] . " ORDER BY created_at DESC";
        return $this->query($query);
    }

    public function updateBookDetails($isbnID, $data)
    {
        $bookData = [
            'title' => $data['title'],
            'author_name' => $data['author_name'],
            'synopsis' => $data['synopsis'],
            'prize' => $data['prize'],
            'genre' => $data['genre']
        ];

        return $this->update($isbnID, $bookData, 'isbnID');
    }






}
