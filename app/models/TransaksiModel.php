<?php

class TransaksiModel
{
    public static function validation($data)
    {
        if (!empty($data)) {

            $data['errors'] = [];
            if ($data['id_customer'] == null) {
                $data['errors']['id_customer'] = "Pilih customer";
            }

            if ($data['tgl_transaksi'] == null) {
                $data['errors']['tgl_transaksi'] = "Tanggal harus di isi";
            }

            if ($data['waktu_transaksi'] == null) {
                $data['errors']['waktu_transaksi'] = "Waktu harus di isi";
            }

            if ($data['id_petugas'] == null) {
                $data['errors']['id_petugas'] = "Petugas harus di isi";
            }

            return $data;
        } else {
            return $data['errors'] = "Masukan username dan password";
        }
    }
}
