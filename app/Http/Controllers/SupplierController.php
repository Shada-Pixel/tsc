<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Purchase;
use Yajra\Datatables\Datatables;
use Illuminate\Http\Request;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Supplier::query())->addIndexColumn()->make(true);
        }
        return view('suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupplierRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {
        $initial_payable = 0;
        $initial_receivable = 0;
        if ($request->initial_payable) { $initial_payable = $request->initial_payable; }
        if ($request->initial_receivable) { $initial_receivable = $request->initial_receivable; }

        $supplier = Supplier::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'id_number' => $request->id_number,
            'laisence' => $request->laisence,
            'initial_payable' => $initial_payable,
            'initial_receivable' => $initial_receivable,
        ]);


        return redirect()->route('suppliers.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Supplier $supplier)
    {
        $supplier = Supplier::with('purchases')->findOrFail($supplier->id);

        if ($request->ajax()) {
            return Datatables::of(
                Purchase::all()
            )->addIndexColumn()->make(true);
        }
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function getpurchases(Supplier $supplier)
    {
        return Datatables::of( Purchase::where('supplier_id',$supplier->id)->get() )->addIndexColumn()->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupplierRequest  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier = Supplier::find($supplier->id);
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->contact = $request->contact;
        if ($request->address) {
            $supplier->address = $request->address;
        }
        if ($request->id_number) {
            $supplier->id_number = $request->id_number;
        }
        if ($request->laisence) {
            $supplier->laisence = $request->laisence;
        }
        if ($request->initial_payable) {
            $supplier->initial_payable = $request->initial_payable;
        }
        if ($request->initial_receivable) {
            $supplier->initial_receivable = $request->initial_receivable;
        }

        $supplier->update();

        return redirect()->route('suppliers.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
        return response()->json(['status' => 'success','message' => 'Supplier Deleted Successfully!'], 200);
    }
}