<?php

namespace App\Helpers;
 
use Illuminate\Support\Facades\DB;
use App\Models\Log as LogModel;
use App\Helpers\User;
use \Carbon\Carbon;
use Auth;

class Log {

    public static function store($message)
    {
        LogModel::create([
            'username' => User::profile()->username,
            'date'     => Carbon::now('Asia/Makassar')->format('Y-m-d'),
            'time'     => Carbon::now('Asia/Makassar')->format('H:i:s'),
            'activity' => $message
        ]);
    }

    public static function data($limit=0)
    {
        if($limit == 0) {
            $log = LogModel::get();
        } else {
            $log = LogModel::limit($limit)->get();
        }
        $log = $log->map(function($item) {
            return (object)[
                'username' => $item->username,
                'activity' => $item->activity,
                'timestamp' => Carbon::parse($item->date)->format('d/m/Y') . " " . Carbon::parse($item->time)->format('H:i:s')
            ];
        });
        return $log;
    }
}