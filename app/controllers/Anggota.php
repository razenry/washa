<?php

class Anggota
{

    public function index()
    {
        UserModel::isLog();
        header('Location: ' . Routes::base('admin/anggota'));
    }

    public function tambah()
    {
        UserModel::isLog();

        $validatedData = PetugasModel::validation($_POST);

        $tambah = DB::table('akun')->insert([
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'level' => 'Anggota',
            'status' => 1,
            'id_biodata' => $validatedData['id_biodata']
        ]);
        DB::reset();

        if ($tambah) {
            $_SESSION['success'] = 'Data anggota berhasil ditambahkan';
            header('Location: ' . Routes::base('admin/anggota'));
        } else {
            $_SESSION['errors'] = 'Data anggota gagal ditambahkan';
            header('Location: ' . Routes::base('admin/anggota/tambah'));
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
            header('Location: ' . Routes::base('admin/anggota'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di diubah";
            header('Location: ' . Routes::base('admin/anggota'));
        }
    }

    public function hapus()
    {
        UserModel::isLog();

        $id = $_POST['id'];
        $delete = DB::table('akun')->where('id', '=', $id)->delete();

        if ($delete > 0) {
            $_SESSION['success'] = "Data berhasil di hapus";
            header('Location: ' . Routes::base('admin/anggota'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di hapus";
            header('Location: ' . Routes::base('admin/anggota'));
        }
    }
}
