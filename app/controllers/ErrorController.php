<?php
class ErrorController extends Controller
{
    public function index()
    {
        echo "An error occurred";
    }

    public function notFound()
    {
        $this->view('error');
    }
}