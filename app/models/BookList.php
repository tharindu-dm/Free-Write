<?php

class BookList
{
    use Model; 

    protected $table = 'BookList'; 

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
    { 
        $this->insert(['user' => $userID, 'book' => $bookID, 'status' => $AddStatus]);
        return;
    }

    public function getUserBookList($userID, $staus)
    { 

        $query = "SELECT b.[bookID], b.[title], l.chapterProgress, l.[status], 
        c.[name] AS cover_image FROM [Book] b 
        LEFT JOIN [BookList] l ON b.bookID = l.[book] 
        LEFT JOIN [CoverImage] c ON b.[coverImage] = c.covID 
        WHERE l.[user] = $userID AND l.[status] = '$staus';";

        

        return $this->query($query);
    }


    public function updateList($uid, $bid, $chaps, $status)
    {
        $query = "UPDATE [BookList] SET [chapterProgress] = $chaps, [status] = '$status' WHERE [user] = $uid AND [book] = $bid;";

        

        $this->query($query);
        return;
    }

    public function deleteFromList($uid, $bid)
    {
        $query = "DELETE FROM [BookList] WHERE [user] = $uid AND [book] = $bid;";

        

        $this->query($query);
        return;
    }
}
