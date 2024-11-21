<?php

class AdminController extends Controller
{
    public function index()
    {
        //echo "this is the Admin Controller\n";

        $this->Dashboard();
    }

    public function Dashboard()
    {
        $user = new User();
        $data = $user->getUserTypeCounts();
        $this->view('admin/adminDashboard', $data);
    }

    public function viewTable()
    {
        $modlog = new ModLog();
        $tables = $modlog->getAllTables();
        $this->view('admin/adminViewTable', $tables);
    }

    public function siteLogs()
    {
        $sitelog = new SiteLog();
        $logs = $sitelog->findAll();
        $this->view('admin/adminSiteLogs', $logs);
    }

}