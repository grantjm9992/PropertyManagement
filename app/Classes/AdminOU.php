<?php

namespace App\Classes;

class AdminOU
{
    public $controller;
    
    public function __construct()
    {
        $this->controller = new \App\Http\Controllers\Controller();
    }
}
