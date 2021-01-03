<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Income as IncomeModel;
use Auth;

class Income {

    public static function total() {
        return IncomeModel::get()->sum('total_price');
    }
}