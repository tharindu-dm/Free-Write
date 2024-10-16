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
}
