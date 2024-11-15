<?php

class BookChapter
{
    use Model; // Use the Model trait

    protected $table = 'BookChapter'; //when using the Model trait, this table name ise used 

    public function getChapters($bookID)
    {
        $query = "SELECT bc.[chapter], ch.[title]
                    FROM [dbo].[BookChapter] bc 
                    JOIN [dbo].[Chapter] ch ON ch.chapterID=bc.chapter
                    WHERE [book]=$bookID ORDER BY chapter ASC OFFSET 1 ROWS";
        
        return $this->query($query);
    }

    
}
