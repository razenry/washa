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

    public function tambah_biodata()
    {
        UserModel::isLog();

        $validatedData = BiodataModel::validationForm($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/biodata'));
            exit();
        }

        $insertId = DB::table('biodata_user')
            ->insert(['nama' => $validatedData['nama'], 'alamat' => $validatedData['alamat'], 'email' => $validatedData['email'], 'notelp' => $validatedData['notelp']]);

        if ($insertId > 0) {
            $_SESSION['success'] = "Data berhasil di tambahkan";
            header('Location: ' . Routes::base('admin/biodata'));
        } else {
            $_SESSION['errors'] = "Data gagal di tambahkan";
            header('Location: ' . Routes::base('admin/biodata'));
        }
    }

    public function edit()
    {
        UserModel::isLog(); 
        
        $validatedData = BiodataModel::validationForm($_POST);

        $update = DB::table('biodata_user')
            ->where('biodata_user.id_biodata', '=', $validatedData['id_biodata'])
            ->update(['nama' => $validatedData['nama'], 'alamat' => $validatedData['alamat'], 'email' => $validatedData['email'], 'notelp' => $validatedData['notelp']]);

        if ($update > 0) {
            $_SESSION['success'] = "Data berhasil di diubah";
            header('Location: ' . Routes::base('admin/biodata'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di diubah";
            header('Location: ' . Routes::base('admin/biodata'));
        }
    }

    public function hapus()
    {
        UserModel::isLog();

        $id = $_POST['id'];

        $delete = DB::table('biodata_user')
            ->where('id_biodata', '=',  $id)
            ->delete();

        if ($delete > 0) {
            $_SESSION['success'] = "Data berhasil di hapus";
            header('Location: ' . Routes::base('admin/biodata'));
        } else {
            $_SESSION['errors'] = "Data gagal di hapus";
            header('Location: ' . Routes::base('admin/biodata'));
        }
    }
}
