<?php


class Customer {
    public function index()
    {
        UserModel::isLog();
        header('Location: ' . Routes::base('admin/customer'));
    }

    public function tambah()
    {
        UserModel::isLog();

        $validatedData = CustomerModel::validation($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/customer'));
            exit;
        }

        $tambah = DB::table('customer')->insert([
            'nama' => $validatedData['nama'],
            'alamat' => $validatedData['alamat'],
            'notelp' => $validatedData['notelp'],
            'email' => $validatedData['email']
        ]);

        if ($tambah) {
            $_SESSION['success'] = 'Data berhasil ditambahkan';
            header('Location: ' . Routes::base('admin/customer'));
        } else {
            $_SESSION['error'] = 'Data gagal ditambahkan';
            header('Location: ' . Routes::base('admin/customer'));
        }

    }

    public function edit()
    {
        UserModel::isLog();

        die(var_dump($_POST));
    }

    public function hapus()
    {
        UserModel::isLog();

        $id = $_POST['id'];

        $hapus = DB::table('customer')->where('id', '=', $id)->delete();

        if ($hapus) {
            $_SESSION['success'] = 'Data berhasil dihapus';
            header('Location: ' . Routes::base('admin/customer'));
        } else {
            $_SESSION['error'] = 'Data gagal dihapus';
            header('Location: ' . Routes::base('admin/customer'));
        }
    }

}