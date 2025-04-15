<?php
class AdminController extends Controller
{
    public function index()
    {
        //echo "this is the Mod Controller\n";
        header('location: /Free-Write/public/Mod/Dashboard');
    }
}