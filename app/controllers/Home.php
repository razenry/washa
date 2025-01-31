<?php 

class Home
{
    public function index()
    {
        $data = [
            'title' => 'Homepage',
            'app_name' => $_SESSION['app_name']
        ];
        App::view('homepage/index', $data, 'homepage/app');
    }    
}

