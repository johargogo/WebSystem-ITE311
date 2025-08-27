<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        return view('index'); // Loads app/Views/index.php
    }

    public function about()
    {
        return view('about'); // Loads app/Views/about.php
    }

    public function contact()
    {
        return view('contact'); // Loads app/Views/contact.php
    }
}
