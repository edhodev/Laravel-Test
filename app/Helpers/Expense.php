<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Expense as ExpenseModel;
use Auth;

class Expense {
    public static function total() {
        return ExpenseModel::get()->sum('total_price');
    }
}