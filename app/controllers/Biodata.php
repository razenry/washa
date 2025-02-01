<?php

class Biodata
{

    public function tambah()
    {
        UserModel::isLog();

        header('Content-Type: application/json');

        $validatedData = BiodataModel::validationForm($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/biodata'));
            exit();
        }

        $lastId = BiodataModel::insert($validatedData);

        if ($lastId) {
            $_SESSION['success'] = "Data berhasil di tambahkan";
            header('Location: ' . Routes::base('admin/petugas'));
        } else {
            $_SESSION['errors'] = "Data gagal di tambahkan";
            header('Location: ' . Routes::base('admin/biodata'));
        }
        
    }
}
