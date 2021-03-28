@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">ویرایش پرداخت برای نیازمند: {{ $payment->poor->full_name }}</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('payments.index', ['poor_id' => $payment->poor->id]) }}" class="btn btn-primary">
                <span class="fa fa-table"></span>
                <span class="mr-2">بازگشت به لیست پرداخت ها</span>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('payments.update', ['poor_id' => $payment->poor->id, 'payment' => $payment]) }}">
        @csrf
        @method('PATCH')

        <h4 class="bg-green p-3 mb-4">اطلاعات پرداخت:</h4>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="amount">مقدار (تومان):</label>
                <input type="text" min="0" class="form-control" id="amount" name="amount" value="{{ $payment->amount }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="tracking_code">کد رهگیری:</label>
                <input type="text" class="form-control" id="tracking_code" name="tracking_code" value="{{ $payment->tracking_code }}" autocomplete="off" />
            </div>
        </div>

        <div class="text-right mb-5">
            <button class="btn btn-primary btn-lg" type="submit">ویرایش پرداخت</button>
        </div>
    </form>
@endsection
