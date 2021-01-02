<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use DataTables;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.expense.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $data = Expense::all();
        $data = $data->map(function($item) {
            return (object)[
                'id' => $item->id,
                'supplier' => $item->supplier,
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
                <a href="'. route('expense.show',$item->id).'" class="btn btn-primary">
                    <i class="fa fa-edit" style="color:white"></i>
                </a>
                <a href="'. route('expense.delete',$item->id).'" class="btn btn-danger">
                    <i class="fa fa-trash" style="color:white"></i>
                </a>
                ';
        })
        ->make(true);
    }

    public function create()
    {
        $action = "create";
        return view('pages.expense.form', compact('action'));
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
            'supplier' => 'required | max:191',
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
                $img = $request->image->storeAs('public/expense/img/', $name);
            }
            Expense::create([
                'image' => $img,
                'supplier' => $request->supplier,
                'address'=> $request->address,
                'item' => $request->item,
                'price' => $request->price,
                'total' => $request->total,
                'total_price' => $request->total_price
            ]);
            return redirect()->route('expense')->with(['type'=>'store']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $action = "edit";
            $data = Expense::find($id);
            return view('pages.expense.form', compact('action','data'));
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'photo' => 'image|max:30480',
            'supplier' => 'required | max:191',
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
                $img = $request->image->storeAs('public/expense/img/', $name);
            }
            Expense::find($id)
                ->update([
                    'image' => $img,
                    'supplier' => $request->supplier,
                    'address'=> $request->address,
                    'item' => $request->item,
                    'price' => $request->price,
                    'total' => $request->total,
                    'total_price' => $request->total_price
                ]);
            return redirect()->route('expense')->with(['type'=>'update']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        try {
            Expense::destroy($id);
            return redirect()->route('expense')->with(['type'=>'delete']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }
}
