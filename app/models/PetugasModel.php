<?php

class PetugasModel
{
    public static function getPetugas()
    {
        $data = DB::table('akun')
            ->select()
            ->join('biodata_user', 'akun.id_biodata = biodata_user.id_biodata')
            ->where('level', '=', 'Petugas')
            ->get();
        DB::reset();
        return $data;
    }

    public static function insert($data)
    {
        $insertId = DB::table('akun')
            ->insert(['username' => $data['username'], 'password' => $data['password'], 'level' => 'Petugas', 'status' => 1, 'id_biodata' => $data['id_biodata']]);
        DB::reset();
        return $insertId;
    }

    public static function update($data)
    {

        $updateCount = DB::table('akun')
            ->where('akun.id', '=', $data['id'])
            ->update([
                'username'  => $data['username'],
                'password'  => $data['password'],
                'id_biodata' => $data['id_biodata']
            ]);

        // Reset query builder state (jika diperlukan)
        DB::reset();


        return $updateCount;
    }

    public static function validation($data, $action = 'tambah')
    {

        if ($action == 'tambah') {
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

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                return $data;
            } else {
                return $data['errors'] = "Masukan username dan password";
            }
        } elseif ($action == 'update') {
            $data['errors'] = [];
            if (!empty($data)) {
                if ($data['id_biodata'] == null) {
                    $data['errors']['id_biodata'] = 'Biodata harus diisi';
                }
                if ($data['username'] == null) {
                    $data['errors']['username'] = 'Username harus diisi';
                }

                if ($data['password'] != null && $data['verifikasi_password'] != null) {

                    if ($data['password'] !== $data['verifikasi_password']) {
                        $data['errors']['verifikasi_password'] = 'Password tidak sama';
                    }
                } else {
                    $oldPassword = DB::table('akun')->select('password')->where('id', '=', $data['id'])->single();
                    $data['password'] = $oldPassword['password'];
                }
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
                return $data;
            } else {
                return $data['errors'] = "Masukan username dan biodata";
            }
        }
    }
}
