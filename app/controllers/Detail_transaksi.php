<?php

class Detail_transaksi
{
    public function index()
    {
        UserModel::isLog();
        header('Location:' . Routes::base('admin/detail_transaksi'));
    }

    public function tambah()
    {
        $data = [
            'id_transaksi' => htmlspecialchars($_POST['id_transaksi']),
            'id_jenis_cucian' => htmlspecialchars($_POST['id_jenis_cucian']),
            'berat' => htmlspecialchars($_POST['berat']),
            'harga_satuan' => htmlspecialchars($_POST['harga_satuan']),
        ];

        $data['total_harga'] = TextHelper::to('int', $data['berat']) * TextHelper::to('int', $data['harga_satuan']);

        $tambah = DB::table('detail_transaksi')->insert([
            'berat' => $data['berat'],
            'harga_satuan' => $data['harga_satuan'],
            'total_harga' => $data['total_harga'],
            'id_transaksi' => $data['id_transaksi'],
            'id_jenis_cucian' => $data['id_jenis_cucian'],
        ]);
        DB::reset();

        $kodeTrans = DB::table('transaksi')
            ->select('kode_trans')
            ->where('id_transaksi', '=', $data['id_transaksi'])
            ->single();

        if ($tambah > 0) {
            $_SESSION['success'] = "Berhasil Menambah Layanan";
            header('Location:' . Routes::base('admin/detail_transaksi/' . $kodeTrans['kode_trans']));
        }else {
        }
    }
}
