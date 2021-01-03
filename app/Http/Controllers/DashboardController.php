<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Income;
use App\Helpers\Expense;
use App\Helpers\Log;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $profit = Income::total() - Expense::total();
        $log = Log::data(4);
        return view('dashboard', compact('profit', 'log'));
    }
}
