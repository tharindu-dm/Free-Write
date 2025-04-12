<?php

class DesignerController extends Controller
{
    public function index()
    {
        $this->view('CoverPageDesigner/Designers_and_Design');
    }

    public function Dashboard()
    {
        $this->view('CoverPageDesigner/Dashboard');
    }

    public function New()
    {
        $this->view('CoverPageDesigner/CreateDesign');
    }

    public function Competition()
    {
        $this->view('CoverPageDesigner/Competition');
    }
}