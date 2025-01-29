<?php 

class Admin
{
    public function index()
    {

        $data = [
            'title' => 'Admin Login'
        ];
        App::view('admin/dashboard/index', $data, 'admin/app');
    }
    
    public function login()
    {
        $data = [
            'title' => 'Admin Login'
        ];
        App::view('admin/login/index', $data, 'admin/app');
    }
}
