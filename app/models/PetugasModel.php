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

    public static function validation($data)
    {
        if (empty($data['id_biodata'])) {
            $data['errors']['id_biodata'] = 'Biodata harus diisi';
        }
        if (empty($data['username'])) {
            $data['errors']['username'] = 'Username harus diisi';
        }
        if (empty($data['password'])) {
            $data['errors']['password'] = 'Password harus diisi';
        }
        if (empty($data['verifikasi_password'])) {
            $data['errors']['verifikasi_password'] = 'Konfirmasi password harus diisi';
        }
        if ($data['password'] !== $data['verifikasi_password']) {
            $data['errors']['verifikasi_password'] = 'Password tidak sama';
        }
        return $data;
    }

}
