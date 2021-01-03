<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;
use DataTables;
use App\Helpers\Log;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.income.index');
    }

    public function data()
    {
        $data = Income::all();
        $data = $data->map(function($item) {
            return (object)[
                'id' => $item->id,
                'buyer' => $item->buyer,
                'item' => $item->item,
                'price' => "Rp." .  number_format($item->price, 0, ',', '.'),
                'total' => $item->total,
                'total_price' => "Rp." . number_format($item->total_price, 0, ',', '.')
            ];
        });
        return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($item) {
            return '
                <a href="'. route('income.show',$item->id).'" class="btn btn-primary">
                    <i class="fa fa-edit" style="color:white"></i>
                </a>
                <a href="'. route('income.delete',$item->id).'" class="btn btn-danger">
                    <i class="fa fa-trash" style="color:white"></i>
                </a>
              ';
        })
        ->make(true);
    }
    
    public function create()
    {
        $action = "create";
        return view('pages.income.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'image|max:30480',
            'buyer' => 'required | max:191',
            'address' => 'required',
            'item' => 'required | max: 191',
            'price' => 'required',
            'total' => 'required | numeric',
            'total_price' => 'required'
        ]);
        try {
            $img = null;
            if($request->has('image')) {
                $name = time() . $request->image->getClientOriginalName();
                $img = $request->image->storeAs('public/incomes/img/', $name);
            }
            Income::create([
                'image' => $img,
                'buyer' => $request->buyer,
                'address'=> $request->address,
                'item' => $request->item,
                'price' => $request->price,
                'total' => $request->total,
                'total_price' => $request->total_price
            ]);
            Log::store("created new income");
            return redirect()->route('income')->with(['type'=>'store']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function show($id)
    {
        try {
            $action = "edit";
            $data = Income::find($id);
            return view('pages.income.form', compact('action','data'));
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'image|max:30480',
            'buyer' => 'required | max:191',
            'address' => 'required',
            'item' => 'required | max: 191',
            'price' => 'required',
            'total' => 'required | numeric',
            'total_price' => 'required'
        ]);
        try {
            $img = null;
            if($request->has('image')) {
                $name = time() . $request->image->getClientOriginalName();
                $img = $request->image->storeAs('public/incomes/img/', $name);
            }
            Income::find($id)
                ->update([
                    'image' => $img,
                    'buyer' => $request->buyer,
                    'address'=> $request->address,
                    'item' => $request->item,
                    'price' => $request->price,
                    'total' => $request->total,
                    'total_price' => $request->total_price
                ]);
            Log::store("updated income");
            return redirect()->route('income')->with(['type'=>'update']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    public function delete($id)
    {
        try {
            Income::destroy($id);
            Log::store("deleted income");
            return redirect()->route('income')->with(['type'=>'delete']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }
}
