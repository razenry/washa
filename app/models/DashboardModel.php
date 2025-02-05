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

        $data['total_pemasukan'] = DB::table('detail_transaksi')
            ->sum('total_harga');
        DB::reset();

        $data['customer'] = DB::table('customer')
            ->count();
        DB::reset();

        $data['pesanan'] = DB::table('transaksi')
            ->count();
        DB::reset();

        $data['selesai'] = DB::table('transaksi')
            ->where('status_transaksi', '=', '5')
            ->count();
        DB::reset();

        return $data;
    }
}
