<?php

namespace App\Http\Controllers\Poors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Poor;

class PaymentsController extends Controller
{
    public const PAYMENT_PAGINATION_LIMIT = 10;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $poor_id)
    {
        $page = $request->input('page');
        $offset = $page ? (($page * self::PAYMENT_PAGINATION_LIMIT) - self::PAYMENT_PAGINATION_LIMIT) : 0;

        $poor = Poor::findOrFail($poor_id);
        $payments = Payment::where('poor_id', $poor_id)->orderBy('created_at', 'desc');
        $count = $payments->count();
        $payments = $payments->skip($offset)->take(self::PAYMENT_PAGINATION_LIMIT)->get();
        return view('poors.payments.index', compact('poor', 'payments', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($poor_id)
    {
        $poor = Poor::findOrFail($poor_id);
        return view('poors.payments.create', compact('poor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $poor_id)
    {
        $payment = new Payment();
        $payment->amount = $request->input('amount');
        $payment->tracking_code = $request->input('tracking_code', 'نامشخص');
        $payment->poor_id = $poor_id;
        $payment->save();

        session()->flash('success', 'پرداخت با موفقیت ثبت شد.');
        return redirect()->route('payments.index', ['poor_id' => $poor_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($poor_id, $id)
    {
        $payment = Payment::findOrFail($id);
        return view('poors.payments.edit', compact('payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $poor_id, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->amount = $request->input('amount');
        $payment->tracking_code = $request->input('tracking_code', 'نامشخص');
        $payment->save();

        session()->flash('success', 'پرداخت با موفقیت ویرایش شد.');
        return view('poors.payments.edit', ['poor_id' => $poor_id, 'payment' => $payment]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($poor_id, $id)
    {
        Payment::destroy($id);
        session()->flash('success', 'پرداخت با موفقیت حذف شد.');
        return redirect()->route('payments.index', ['poor_id' => $poor_id]);
    }
}
