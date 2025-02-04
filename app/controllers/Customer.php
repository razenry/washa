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

        if ($tambah > 0) {
            $_SESSION['success'] = 'Data berhasil ditambahkan';
            header('Location: ' . Routes::base('admin/customer'));
        } else {
            $_SESSION['error'] = 'Data gagal ditambahkan';
            header('Location: ' . Routes::base('admin/customer'));
        }

    }
    public function tambah_customer()
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

        if ($tambah > 0) {
            $_SESSION['success'] = 'Data berhasil ditambahkan';
            header('Location: ' . Routes::base('admin/transaksi'));
        } else {
            $_SESSION['error'] = 'Data gagal ditambahkan';
            header('Location: ' . Routes::base('admin/transaksi'));
        }

    }

    public function edit()
    {
        UserModel::isLog();

        $validatedData = CustomerModel::validation($_POST);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/customer'));
            exit;
        }

        $update = DB::table('customer')
            ->where('id', '=', $validatedData['id'])
            ->update([
                'nama' => $validatedData['nama'],
                'alamat' => $validatedData['alamat'],
                'notelp' => $validatedData['notelp'],
                'email' => $validatedData['email']
            ]);

        if ($update > 0) {
            $_SESSION['success'] = 'Data berhasil diubah';
            header('Location: ' . Routes::base('admin/customer'));
        } else {
            $_SESSION['error'] = 'Data gagal diubah';
            header('Location: ' . Routes::base('admin/customer'));
        }
    }

    public function hapus()
    {
        UserModel::isLog();

        $id = $_POST['id'];

        $hapus = DB::table('customer')->where('id', '=', $id)->delete();

        if ($hapus > 0) {
            $_SESSION['success'] = 'Data berhasil dihapus';
            header('Location: ' . Routes::base('admin/customer'));
        } else {
            $_SESSION['error'] = 'Data gagal dihapus';
            header('Location: ' . Routes::base('admin/customer'));
        }
    }

}