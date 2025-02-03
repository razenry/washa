<?php 

class Anggota {

    public function index()
    {
        UserModel::isLog();
        header('Location: ' . Routes::base('admin/anggota'));
    }

}