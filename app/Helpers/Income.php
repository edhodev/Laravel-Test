<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Income as IncomeModel;
use \Carbon\Carbon;
use Auth;

class Income {

    public static function total() {
        return IncomeModel::get()->sum('total_price');
    }

    public static function grafik()
    {
        $total = IncomeModel::orderBy('id','desc')->take(5)->get()->pluck('total_price')->reverse()->values();
        $date  = IncomeModel::orderBy('id','desc')->take(5)->get()->pluck('created_at')->reverse()->values();
        $date  = $date->map(function($item) {
            return [
                Carbon::parse($item)->format('d/m/Y')
            ];
        });
        $data = [
            'total' => $total,
            'date'  => $date
        ];
        return $data;
    }
}