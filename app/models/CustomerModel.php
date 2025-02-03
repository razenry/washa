<?php

class CustomerModel
{
    public static function validation($data)
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
}
