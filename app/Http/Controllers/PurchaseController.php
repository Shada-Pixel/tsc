<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Product;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Purchase::all();
        if ($request->ajax()) {

            if ($request->from_date) {
                return Datatables::of(Purchase::with('supplier')->whereBetween('created_at', array($request->from_date, $request->to_date))->get())->addIndexColumn()->make(true);
            }
            return Datatables::of(Purchase::with('supplier')->get())->addIndexColumn()->make(true);
        }

        return view('purchases.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $suppliers = Supplier::all();
        $products = Product::all();
        return view('purchases.create',compact('suppliers', 'products'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {
        $purchase = new Purchase();
        $purchase->purchase_number = date('ymdis');
        $purchase->supplier_id = $request->supplier_id;
        $purchase->user_id = Auth::id();
        $purchase->total_price = $request->subtotal;
        $purchase->total_paid = $request->paid;
        $purchase->total_weight = $request->totalweight;

        if ($request->purchase_type == 2 && $request->purchase_dp ) {
            $purchase->delivery_point = $request->purchase_dp;
        }
        $purchase->save();


        foreach($request->product_id as $key => $items) {
            $data['purchase_id'] = $purchase->id;
            $data['product_id'] = $request->product_id[$key];
            $data['total_weight'] = $request->product_qty[$key];
            $data['unit_price'] = $request->product_up[$key];
            $data['total_paid'] = $request->product_st[$key];
            PurchaseItem::create($data);
        }

        Session::flash('message', "Purchase Successfully!");
        return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show(Purchase $purchase)
    {
        return view('purchases.show',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return response()->json([ 'status'=> 'success', 'message' => 'Purchase Deleted'],200);
    }
}