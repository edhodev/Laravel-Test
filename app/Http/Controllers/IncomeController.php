<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            return redirect()->route('income')->with(['type'=>'store']);
        } catch(\Throwable $th)
        {
            return $th->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function show(Income $income)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function edit(Income $income)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Income $income)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Income  $income
     * @return \Illuminate\Http\Response
     */
    public function destroy(Income $income)
    {
        //
    }
}
