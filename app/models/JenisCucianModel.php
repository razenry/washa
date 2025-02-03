<?php

class JenisCucianModel
{
    public static function validation($data, $action = 'tambah')
    {

        if ($action == 'tambah') {
            if (!empty($data)) {
                $data['errors'] = [];

                if ($data['nama'] == null) {
                    $data['errors']['nama'] = 'Nama harus diisi';
                }
                if ($data['harga'] == null) {
                    $data['errors']['harga'] = 'Harga harus diisi';
                }

                return $data;
            } else {
                return $data['errors'] = "Masukan nama dan harga";
            }
        } elseif ($action == 'update') {
            $data['errors'] = [];
            if (!empty($data)) {
                if ($data['nama'] == null) {
                    $data['errors']['nama'] = 'Nama harus diisi';
                }
                if ($data['harga'] == null) {
                    $data['errors']['harga'] = 'Harga harus diisi';
                }
                return $data;
            } else {
                return $data['errors'] = "Masukan nama dan harga";
            }
        }
    }
}
