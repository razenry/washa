<?php

class PetugasModel
{
    public static function getPetugas()
    {
        $data = DB::table('akun')
            ->select()
            ->join('biodata_user', 'akun.id_biodata = biodata_user.id')
            ->where('level', '=', 'Petugas')
            ->get();
        DB::reset();
        return $data;
    }

    public static function insert($data)
    {
        $insertId = DB::table('akun')
            ->insert(['username' => $data['username'], 'password' => $data['password'], 'level' => 'Petugas', 'status' => 1, 'id_biodata' => $data['id_biodata']]);
        return $insertId;
    }

    public static function validation($data)
    {

        if (!empty($data)) {
            $data['errors'] = [];
            if ($data['id_biodata'] == null) {
                $data['errors']['id_biodata'] = 'Biodata harus diisi';
            }
            if ($data['username'] == null) {
                $data['errors']['username'] = 'Username harus diisi';
            }
            if ($data['password'] == null) {
                $data['errors']['password'] = 'Password harus diisi';
            }
            if ($data['verifikasi_password'] == null) {
                $data['errors']['verifikasi_password'] = 'Konfirmasi password harus diisi';
            }
            if ($data['password'] !== $data['verifikasi_password']) {
                $data['errors']['verifikasi_password'] = 'Password tidak sama';
            }
            return $data;
        } else {
            return $data['errors'] = "Masukan username dan password";
        }
    }
}
