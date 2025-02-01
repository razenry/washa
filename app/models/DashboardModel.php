<?php

class DashboardModel
{
    public static function getCardData()
    {
        $data = [];
        
        $data['admin'] = DB::table('akun')
        ->where('level', '=', 'Admin')
        ->count();
        DB::reset();  
        
        $data['petugas'] = DB::table('akun')
        ->where('level', '=', 'Petugas')
        ->count();
        DB::reset();  
        
        $data['anggota'] = DB::table('akun')
            ->where('level', '=', 'Anggota')
            ->count();
        DB::reset();  

        return $data;
    }
}
