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

        $comment = new Comment();
        $comment->insert(['chapter' => $chapID, 'content' => $commentContent, 'user' => $user, 'dateAdded' => $datetime]);

        header("Location: /Free-Write/public/book/Chapter/$chapID");
    }
}