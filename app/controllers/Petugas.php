<?php

class Petugas
{
    public function index()
    {
        UserModel::isLog();
        header('Location:' . Routes::base('admin/petugas'));
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

    public function edit()
    {

        UserModel::isLog();

        $validatedData = PetugasModel::validation($_POST, 'update');

        $update = DB::table('akun')
            ->where('akun.id', '=', $validatedData['id'])
            ->update(['username' => $validatedData['username'], 'password' => $validatedData['password'], 'id_biodata' => $validatedData['id_biodata']]);

        if ($update > 0) {
            $_SESSION['success'] = "Data berhasil di diubah";
            header('Location: ' . Routes::base('admin/petugas'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di diubah";
            header('Location: ' . Routes::base('admin/petugas'));
        }
    }

    public function hapus()
    {
        UserModel::isLog();
        $id = $_POST['id'];
        $delete = DB::table('akun')->where('id', '=', $id)->delete();

        if ($delete > 0) {
            $_SESSION['success'] = "Data berhasil di hapus";
            header('Location: ' . Routes::base('admin/petugas'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di hapus";
            header('Location: ' . Routes::base('admin/petugas'));
        }
    }
}
