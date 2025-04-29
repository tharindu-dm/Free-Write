<?php

class PublisherBooks
{
    use Model; 

    protected $table = 'PublisherBooks';  

    public function getBookList()
    {
        $query = "SELECT * FROM (
            SELECT 
            p.isbnID,
            p.coverImage,
            p.publisherID, 
            p.title,
            CONCAT(u.firstName, ' ', u.lastName) AS author,
            u.profileImage,
            ROW_NUMBER() OVER (PARTITION BY p.publisherID ORDER BY p.isbnID ) as row_num 
            FROM PublisherBooks p
            JOIN [UserDetails] u ON p.publisherID = u.[user]
        ) ranked_books 
        WHERE row_num <= 4";

        return $this->query($query);
    }

    public function getRecentBooks($publisherID)
    {
        $query = "SELECT * FROM publisherbooks WHERE publisherID = :publisherID ORDER BY created_at DESC";
        return $this->query($query, ['publisherID' => $publisherID]);
    }
    

    public function updateBookDetails($isbnID, $data)
    {
        $query = "UPDATE [PublisherBooks] SET 
        [title]='" . $data['title'] . "', 
        [contributor_name]='" . $data['contributor_name'] . "', 
        [publication_year]='" . $data['publication_year'] . "', 
        [author_name]='" . $data['author_name'] . "', 
        [synopsis]='" . $data['synopsis'] . "', 
        [prize]=" . $data['prize'] . ", 
        [genre]='" . $data['genre'] . "' 
        WHERE [isbnID] = '" . $isbnID . "'";

        return $this->query($query);
    }


}
