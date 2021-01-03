<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Expense as ExpenseModel;
use \Carbon\Carbon;
use Auth;

class Expense {
    public static function total() {
        return ExpenseModel::get()->sum('total_price');
    }

    public static function grafik()
    {
        $total = ExpenseModel::orderBy('id','desc')->take(5)->get()->pluck('total_price')->reverse()->values();
        $date  = ExpenseModel::orderBy('id','desc')->take(5)->get()->pluck('created_at')->reverse()->values();
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