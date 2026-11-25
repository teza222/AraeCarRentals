<?php

class HomeController
{
    public function index()
    {
        $siteName = "AREA Car Rentals";
        $pageTitle = "Dont buy it, Just Rent it!";
        $currentYear = date("Y");
        $isLoggedIn = false;

        require_once __DIR__ . '/../Views/pages/home.php';
    }
}