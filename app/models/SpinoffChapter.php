<?php

class SpinoffChapter
{
    use Model; 

    protected $table = 'SpinoffChapter';  

    public function getChapters($spinoffID)
    {
        $query = "SELECT 
                    c.[chapterID],
                    c.[title],
                    c.[lastUpdated],
                    c.[viewCount]
                    FROM [dbo].[Chapter] c
                    INNER JOIN [dbo].[SpinoffChapter] sc ON sc.[Chapter] = c.[ChapterID]
                    WHERE sc.[spinoff] = $spinoffID
                    ORDER BY sc.[chapter];";

        return $this->query($query);
    }

    public function deleteChapters($spinoffID)
    {
        $query = "DELETE FROM [dbo].[SpinoffChapter] WHERE [spinoff] = $spinoffID;";

        return $this->query($query);
    }

}
