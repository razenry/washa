<?php

class Petugas {
    public function index()
    {
        UserModel::isLog();   
    }

    public function tambah()
    {

        UserModel::isLog();

        $validatedData = PetugasModel::validation($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location:' . Routes::base('admin/petugas'));
        }

         die(var_dump($validatedData));  
    }
}