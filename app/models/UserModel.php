<?php

class UserModel
{
    public static function validationLogin($data)
    {
        if (!empty($data)) {
            $data['errors']=[];
            if ($data['username'] == null) {
                $data['errors']['username'] = "Username harus di isi";
            }

            if ($data['password'] == null) {
                $data['errors']['password'] = "Password harus di isi";
            }
            return $data;
        } else {
            return $data['errors'] = "Masukan username dan password";
        }
    }

    public static function getUserByUsername($username)
    {
        $user = DB::table('akun as a')->select()->join('biodata_user as bu', 'a.id_biodata = bu.id_biodata')->where('a.username', '=', $username)->single();

        return $user;
    }

    public static function isLog()
    {
        if (!isset($_SESSION['login'])) {
            header('Location:'. Routes::base('admin/login'));
        }
    }

}
