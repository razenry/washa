<?php

class Transaksi
{

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
            'status_pembayaran' => '0',
        ];

        $validatedData = TransaksiModel::validation($data);

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location: ' . Routes::base('admin/transaksi'));
            exit;
        }

        $kodeUnik = DB::table('transaksi')->select('id_transaksi')->where('id_customer', '=', $data['id_customer'])->count();
        DB::reset();


        $kodeUnik = $kodeUnik + 1;
        $kodeTrans = 'TR' . $data['id_customer'] . '-' . $kodeUnik;

        while (DB::table('transaksi')->where('kode_trans', '=', $kodeTrans)->exists()) {
            $kodeUnik++;
            $kodeTrans = 'TR' . $data['id_customer'] . '-' . $kodeUnik;
        }

        DB::reset();


        $tambah = DB::table('transaksi')->insert([
            'kode_trans' => $kodeTrans,
            'id_customer' => $data['id_customer'],
            'tgl_transaksi' => $data['tgl_transaksi'],
            'waktu_transaksi' => $data['waktu_transaksi'],
            'id_petugas' => $data['id_petugas'],
            'status' => $data['status'],
            'status_pembayaran' => $data['status_pembayaran'],
        ]);

        DB::reset();

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

        $data = [
            'id_transaksi' => htmlspecialchars($_POST['id_transaksi']),
            'id_customer' => htmlspecialchars($_POST['id_customer']),
            'tgl_transaksi' => htmlspecialchars($_POST['tgl_transaksi']),
            'waktu_transaksi' => htmlspecialchars($_POST['waktu_transaksi']),
            'id_petugas' => htmlspecialchars($_POST['id_petugas']),
            'status' => '0',
        ];

        $validatedData = TransaksiModel::validation($data);

        $checkIdCustomer = DB::table('transaksi')->select()->where('id_transaksi', '=', $validatedData['id_transaksi'])->single();

        if ($validatedData['id_customer'] == $checkIdCustomer['id_customer']) {
            $kodeTrans = $checkIdCustomer['kode_trans'];
        } else {
            $kodeUnik = DB::table('transaksi')->select('id_transaksi')->where('id_customer', '=', $data['id_customer'])->count();
            DB::reset();


            $kodeUnik = $kodeUnik + 1;
            $kodeTrans = 'TR' . $data['id_customer'] . '-' . $kodeUnik;

            while (DB::table('transaksi')->where('kode_trans', '=', $kodeTrans)->exists()) {
                $kodeUnik++;
                $kodeTrans = 'TR' . $data['id_customer'] . '-' . $kodeUnik;
            }

            DB::reset();
        }

        if ($validatedData['errors']) {
            $_SESSION['errors'] = $validatedData['errors'];
            header('Location:' . Routes::base('admin/transaksi'));
        }

        $update = DB::table('transaksi')->where('id_transaksi', '=', $validatedData['id_transaksi'])->update([
            'kode_trans' => $kodeTrans,
            'id_customer' => $validatedData['id_customer'],
            'tgl_transaksi' => $validatedData['tgl_transaksi'],
            'waktu_transaksi' => $validatedData['waktu_transaksi'],
            'id_petugas' => $validatedData['id_petugas'],
            'status' => $validatedData['status'],
        ]);
        DB::reset();

        if ($update > 0) {
            $_SESSION['success'] = "Berhasil menambah data";
            header('Location:' . Routes::base('admin/transaksi'));
        } else {
            echo $_SESSION['errors'] = "Gagal menambah data";
        }
    }
}
