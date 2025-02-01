<?php

class BiodataModel
{
    public static function getBiodata()
    {
        $data = DB::table('biodata_user')->select()->get();
        DB::reset();
        return $data;
    }

    public static function validationForm($data)
    {
        if (!empty($data)) {
            $data['errors'] = [];
            if ($data['nama'] == null) {
                $data['errors']['nama'] = "Nama harus di isi";
            }

            if ($data['alamat'] == null) {
                $data['errors']['alamat'] = "Alamat harus di isi";
            }

            if ($data['email'] == null) {
                $data['errors']['email'] = "Email harus di isi";
            }

            if ($data['notelp'] == null) {
                $data['errors']['notelp'] = "Notelp harus di isi";
            }

            return $data;
        } else {
            return $data['errors'] = "Masukan data biodata";
        }
    }

    public static function insert($data)
    {
        $insertId = DB::table('biodata_user')
            ->insert(['nama' => $data['nama'], 'alamat' => $data['alamat'], 'email' => $data['email'], 'notelp' => $data['notelp']]);
        return $insertId;
    }
}
