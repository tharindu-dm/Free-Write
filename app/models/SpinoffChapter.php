<?php

class SpinoffChapter
{
    use Model; // Use the Model trait

    protected $table = 'SpinoffChapter'; //when using the Model trait, this table name ise used 

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

}
