<?php

class Transaksi {

    public function index()
    {
        UserModel::isLog();
        header('Location: ' . Routes::base('admin/transaksi'));
    }

    public function tambah()
    {
        UserModel::isLog();

        $data = [
            'id_customer' => htmlspecialchars($_POST['id_customer']),
            'tgl_transaksi' => htmlspecialchars($_POST['tgl_transaksi']),
            'waktu_transaksi' => htmlspecialchars($_POST['waktu_transaksi']),
            'id_petugas' => htmlspecialchars($_POST['id_petugas']),
            'status' => '0',
        ];

        $validatedData = TransaksiModel::validation($data);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/transaksi'));
            exit;
        }

        $tambah = DB::table('transaksi')->insert([
            'id_customer' => $data['id_customer'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'waktu_transaksi' => $data['waktu_transaksi'],
            'id_petugas' => $data['id_petugas'],
            'status' => $data['status'],
        ]);

        if ($tambah > 0) {
            $_SESSION['success'] = 'Data berhasil ditambahkan';
            header('Location: ' . Routes::base('admin/transaksi'));
        } else {
            $_SESSION['errors'] = 'Data gagal ditambahkan';
            header('Location: ' . Routes::base('admin/transaksi'));
        }

        die(var_dump($validatedData));
    }

    public function edit()
    {
        UserModel::isLog();
        die(var_dump($_POST));
    }

}