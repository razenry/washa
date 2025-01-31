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

    public function test()
    {
        $categories = DB::table('blogs')
            ->select(['blogs.id', 'blogs.slug', 'blogs.title','blogs.content', 'blogs.published', 'categories.name as category_name'])
            ->join('categories', 'blogs.id_category', 'categories.id')
            ->where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
        var_dump($categories);
    }
}
