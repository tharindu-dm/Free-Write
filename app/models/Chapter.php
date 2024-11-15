<?php

class Chapter
{
    use Model; // Use the Model trait

    protected $table = 'Chapter'; //when using the Model trait, this table name ise used

    public function getChapterByID($chapterID)
    {
        $arr = ['chapterID' => $chapterID];
        $chapter_content = $this->where($arr);

        $title_author_query = "SELECT b.[title] AS BookTitle,
                    CONCAT(u.[firstName], ' ', u.[lastName]) AS AuthorName
                    FROM [dbo].[Chapter] c
                    JOIN [dbo].[BookChapter] bc ON c.[chapterID] = bc.[chapter]
                    JOIN [dbo].[Book] b ON bc.[book] = b.[bookID]
                    JOIN [dbo].[UserDetails] u ON b.[author] = u.[user]
                    WHERE c.[chapterID] = $chapterID;";

        $comments_query = "SELECT 
                    CONCAT(u.[firstName], ' ', u.[lastName]) AS UserName,
                    c.[content] AS CommentContent,
                    c.[dateAdded] AS DateAdded
                    FROM [dbo].[Comment] c
                    JOIN [dbo].[UserDetails] u ON c.[user] = u.[user]
                    WHERE c.[chapter] = $chapterID
                    ORDER BY c.[dateAdded] DESC;"; //latest date first

        $title_author = $this->query($title_author_query);
        $chapter_comments = $this->query($comments_query);

        return ['chapter_content' => $chapter_content, 'title_author' => $title_author, 'chapter_comments' => $chapter_comments];
    }

}
