<?php

class BookList
{
    use Model; // Use the Model trait

    protected $table = 'BookList'; //when using the Model trait, this table name ise used 

    public function getBookList($userID)
    {

        return $this->where(['user' => $userID]);

    }
    public function getBookListCount($userID)
    {
        $query = "SELECT 
            COUNT(CASE WHEN [status] = 'reading' THEN 1 END) AS reading,
            COUNT(CASE WHEN [status] = 'planned' THEN 1 END) AS planned,
            COUNT(CASE WHEN [status] = 'dropped' THEN 1 END) AS dropped,
            COUNT(CASE WHEN [status] = 'hold' THEN 1 END) AS hold,
            COUNT(CASE WHEN [status] = 'completed' THEN 1 END) AS completed
            FROM [dbo].[BookList]
            WHERE [user] = $userID;";
        return $this->query($query);
    }
    public function addToList($userID, $bookID, $AddStatus)
    { //$chapter to be added to the list : edit the query to add the chapter to the list
        return $this->insert(['user' => $userID, 'book' => $bookID, 'status' => $AddStatus]);
    }

    public function getUserBookList($userID, $staus)
    { //get the list of books of the user with the status

        $query = "SELECT b.[bookID], b.[title], l.chapterProgress, l.[status], 
        c.[name] AS cover_image FROM [Book] b 
        LEFT JOIN [BookList] l ON b.bookID = l.[book] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE l.[user] = $userID AND l.[status] = '$staus';";

        //show($query);

        return $this->query($query);
    }
}
