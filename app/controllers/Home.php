<?php 

class Home
{
    public function index()
    {
        
        App::view('home/index', $data= [], 'app');
    }    
}

