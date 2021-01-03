<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\User as UserHelper;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $data = UserHelper::profile();
        return view('pages.profile.profile', compact('data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'image|max:30480',
            'name' => 'required',
        ]);
        try {
            $img = null;
            if($request->has('image')) {
                $name = time() . $request->image->getClientOriginalName();
                $img = $request->image->storeAs('public/users/img/', $name);
            }
            UserHelper::profile()
                ->update([
                    'image' => $img,
                    'name' => $request->name,
                    'address' => $request->address,
                    'phone' => $request->phone,
                ]);
            return redirect()->back()->with(['type'=>'update']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }
}
