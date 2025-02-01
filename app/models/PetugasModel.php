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
}
