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
        } else {
        }
    }

    public function pembayaran()
    {
        $data = [
            'id_detail_transaksi' => $_POST['id_detail_transaksi'],
            'total_harga' => $_POST['total_harga'],
            'pembayaran' => $_POST['pembayaran'],
        ];

        $id_transaksi = DB::table('detail_transaksi')
            ->select()
            ->where('id_detail_transaksi', '=', $data['id_detail_transaksi'])
            ->single();
        DB::reset();



        $hasil = TextHelper::to('int', $data['pembayaran']) - TextHelper::to('int', $data['total_harga']);

        if ($hasil >= 0) {
            $status_pembayaran = DB::table('transaksi')
                ->where('id_transaksi', '=', $id_transaksi['id_transaksi'])
                ->update([
                    'status_pembayaran' => 1
                ]);
            DB::reset();

            if ($status_pembayaran > 0) {
                header('Location:' . Routes::base('admin/transaksi'));
            } else {
                header('Location:' . Routes::base('admin/transaksi'));
            }
        } else {
            header('Location:' . Routes::base('admin/transaksi'));
        }
    }

    public function hapus()
    {
        $id_dt = htmlspecialchars($_POST['id_detail_transaksi']);
        $kode_trans = htmlspecialchars($_POST['kode_trans']);

        $hapus = DB::table('detail_transaksi')
            ->where('id_detail_transaksi', '=', $id_dt)
            ->delete();
        DB::reset();

        if ($hapus > 0) {
            $_SESSION['success'] = "Berhasil hapus data";
            header('Location:' . Routes::base("admin/detail_transaksi/$kode_trans"));
        }
    }
}
