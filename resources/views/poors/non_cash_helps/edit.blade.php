@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">ویرایش کمک غیر نقدی برای نیازمند: {{ $noncashhelp->poor->full_name }}</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('nch.index', ['poor_id' => $noncashhelp->poor->id]) }}" class="btn btn-primary">
                <span class="fa fa-table"></span>
                <span class="mr-2">بازگشت به لیست کمک های غیر نقدی</span>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('nch.update', ['poor_id' => $noncashhelp->poor->id, 'nch' => $noncashhelp]) }}">
        @csrf
        @method('PATCH')

        <h4 class="bg-green p-3 mb-4">اطلاعات کمک غیر نقدی:</h4>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <label for="details">جزئیات:</label>
                <textarea class="form-control" id="details" name="details">{{ $noncashhelp->details }}</textarea>
            </div>
        </div>

        <div class="text-right mb-5">
            <button class="btn btn-primary btn-lg" type="submit">ویرایش کمک غیر نقدی</button>
        </div>
    </form>
@endsection
