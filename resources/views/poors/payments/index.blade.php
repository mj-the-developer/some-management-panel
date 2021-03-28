@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">لیست پرداخت های نیازمند: {{ $poor->full_name }}</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('payments.create', ['poor_id' => $poor->id]) }}" class="btn btn-primary">
                <span class="fa fa-plus"></span>
                <span class="mr-2">ثبت پرداخت جدید</span>
            </a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>مبلغ (تومان)</th>
                <th>کد رهگیری</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($payments as $payment)
                <tr>
                    <td>{{ number_format($payment->amount) }} تومان</td>
                    <td>{{ $payment->tracking_code ?? 'نامشخص' }}</td>
                    <td>
                        <a href="{{ route('payments.edit', [ 'poor_id' => $poor->id, 'payment' => $payment ]) }}" class="btn btn-info btn-sm ml-1">
                            ویرایش
                        </a>
                        <form method="POST" id="payment-{{ $payment->id }}" data-payment-id="{{ $payment->id }}" class="d-inline-block delete-payment-form" action="{{ route('payments.destroy', ['poor_id' => $poor->id, 'payment' => $payment]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">در حال حاضر پرداختی برای این نیازمند ثبت نشده است.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @php
        $page = app('request')->input('page') ?? 1;
        $lastPage = ceil($count / 10);
        $from = $page - 3;
        $to = $page + 3;
    @endphp

    @if ($count > 10)
        <ul class="pagination justify-content-center p-0 mt-5">
            @if ($page && $page != '1')
                <li class="page-item"><a class="page-link" href="{{ route('payments.index', ['poor_id' => $poor->id, 'page' => $page - 1]) }}">قبلی</a></li>
            @endif

            @for ($i = $from; $i < $to; $i++)
                @if ($i > 0 && $i < $lastPage + 1)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('payments.index', ['poor_id' => $poor->id, 'page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($page != $lastPage)
                <li class="page-item"><a class="page-link" href="{{ route('payments.index', ['poor_id' => $poor->id, 'page' => $page + 1]) }}">بعدی</a></li>
            @endif
        </ul>
    @endif
@endsection

@section('footerScripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.delete-payment-form').on('submit', function(e) {
                e.preventDefault();
                const deleteConfirmation = confirm('آیا از حذف این پرداخت اطمینان دارید؟');
                if (deleteConfirmation) {
                    let paymentId = $(this).data('payment-id');
                    $('#payment-' + paymentId).unbind('submit').submit();
                }
            });
        });
    </script>
@endsection
