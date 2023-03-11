<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankTransaction;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreBankTransactionRequest;
use App\Http\Requests\UpdateBankTransactionRequest;
use App\Models\Bank;
use Illuminate\Support\Facades\Session;

class BankTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(BankTransaction::all())->addIndexColumn()->make(true);
        }
        return view('transactions.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::all();
        return view('transactions.create',compact('banks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBankTransactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankTransactionRequest $request)
    {
        $transaction = BankTransaction::create($request);
        Session::flash('message','New transaction added!');
        return redirect()->route('transactions.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BankTransaction $transaction)
    {
        return view('transactions.show',compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BankTransaction $transaction)
    {
        return view('transactions.edit',compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBankTransactionRequest  $request
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBankTransactionRequest $request, BankTransaction $transaction)
    {
        $transaction->update($request);
        Session::flash('message','Transaction updated!');
        return redirect()->route('transactions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankTransaction  $bankTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BankTransaction $transaction)
    {
        $transaction->delete();
        Session::flash('message','Transaction Deleted!');
        return redirect()->route('transactions.index');
    }
}
