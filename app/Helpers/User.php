<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\User as UserModel;
use Auth;

class User {

    public static function total() {
        return UserModel::get()->count();
    }

    public static function profile()
    {
        return UserModel::findOrFail(Auth::user()->id);
    }
}