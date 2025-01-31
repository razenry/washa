<?php

class TestModel {

    public static function getCategori()
    {
        return $results = DB::table('categories')
            ->select(['id', 'name', 'description'])
            ->where('status', '=', 1)
            ->orderBy('id', 'DESC')
            ->limit(10)
            ->get();
    }

}