<?php

class ChapterController extends Controller
{
    public function index()
    {
        $this->view('book/Chapter');

    }

    public function Comment()
    {
        $chapID = $_POST['chapterID'];
        $commentContent = $_POST['commentText'];
        $user = $_SESSION['user_id'];
        $datetime = date("Y-m-d H:i:s");

        //validations
        if (
            (!is_numeric($chapID) && $chapID > 0) 
            || (!is_numeric($user) && $user > 0)
            || strlen($commentContent) < 1
            || strlen($commentContent) > 255
            ) {
            header("Location: /Free-Write/public/book/Chapter/$chapID");
            return;
        }

        $comment = new Comment();
        $comment->insert(['chapter' => $chapID, 'content' => $commentContent, 'user' => $user, 'dateAdded' => $datetime]);

        header("Location: /Free-Write/public/book/Chapter/$chapID");
    }
}