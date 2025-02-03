<?php

class Jenis_cucian
{
    public function index()
    {
        UserModel::isLog();
        header('Location:' . Routes::base('admin/jenis_cucian'));
    }

    public function tambah()
    {

        UserModel::isLog();

        $validatedData = JenisCucianModel::validation($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location:' . Routes::base('admin/jenis_cucian'));
            exit;
        }

        $result = DB::table('jenis_cucian')->insert(['nama' => $validatedData['nama'], 'harga' => $validatedData['harga']]);

        if ($result > 0) {
            $_SESSION['success'] = "Data berhasil di tambahkan";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        } else {
            $_SESSION['errors'] = "Data gagal di tambahkan";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        }
    }

    public function edit()
    {
        UserModel::isLog();

        $validatedData = JenisCucianModel::validation($_POST, 'update');

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location:' . Routes::base('admin/jenis_cucian'));
            exit;
        }

        // die(var_dump($validatedData));

        $update = DB::table('jenis_cucian')
            ->where('jenis_cucian.id_jenis_cucian', '=', $validatedData['id_jenis_cucian'])
            ->update(['nama' => $validatedData['nama'], 'harga' => $validatedData['harga']]);

        if ($update > 0) {
            $_SESSION['success'] = "Data berhasil di diubah";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di diubah";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        }
    }

    public function hapus()
    {
        $id = $_POST['id'];
        $delete = DB::table('jenis_cucian')->where('id_jenis_cucian', '=', $id)->delete();

        if ($delete > 0) {
            $_SESSION['success'] = "Data berhasil di hapus";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        } else {

            echo $_SESSION['errors'] = "Data gagal di hapus";
            header('Location: ' . Routes::base('admin/jenis_cucian'));
        }
    }
}
