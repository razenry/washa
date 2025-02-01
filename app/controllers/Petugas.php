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

        $result = PetugasModel::insert($validatedData);

        if ($result) {
            $_SESSION['success'] = "Data berhasil di tambahkan";
            header('Location: ' . Routes::base('admin/petugas'));
        } else {
            $_SESSION['errors'] = "Data gagal di tambahkan";
            header('Location: ' . Routes::base('admin/petugas'));
        }
    }
}