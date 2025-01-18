<?php
class ErrorController extends Controller
{
    public function index()
    {
        $this->view('error');
    }

    public function notFound()
    {
        $this->view('error');
    }
}