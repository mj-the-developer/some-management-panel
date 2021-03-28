@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">لیست کمک های غیر نقدی نیازمند: {{ $poor->full_name }}</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('nch.create', ['poor_id' => $poor->id]) }}" class="btn btn-primary">
                <span class="fa fa-plus"></span>
                <span class="mr-2">ثبت کمک غیر نقدی جدید</span>
            </a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>جزئیات کمک غیر نقدی</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($noncashhelps as $noncashhelp)
                <tr>
                    <td>{{ $noncashhelp->details }}</td>
                    <td>
                        <a href="{{ route('nch.edit', [ 'poor_id' => $poor->id, 'nch' => $noncashhelp ]) }}" class="btn btn-info btn-sm ml-1">
                            ویرایش
                        </a>
                        <form method="POST" id="noncashhelp-{{ $noncashhelp->id }}" data-noncashhelp-id="{{ $noncashhelp->id }}" class="d-inline-block delete-noncashhelp-form" action="{{ route('nch.destroy', ['poor_id' => $poor->id, 'nch' => $noncashhelp]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">در حال حاضر هیچ کمک غیر نقدی برای این نیازمند ثبت نشده است.</td>
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
                <li class="page-item"><a class="page-link" href="{{ route('nch.index', ['poor_id' => $poor->id, 'page' => $page - 1]) }}">قبلی</a></li>
            @endif

            @for ($i = $from; $i < $to; $i++)
                @if ($i > 0 && $i < $lastPage + 1)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('nch.index', ['poor_id' => $poor->id, 'page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($page != $lastPage)
                <li class="page-item"><a class="page-link" href="{{ route('nch.index', ['poor_id' => $poor->id, 'page' => $page + 1]) }}">بعدی</a></li>
            @endif
        </ul>
    @endif
@endsection

@section('footerScripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.delete-noncashhelp-form').on('submit', function(e) {
                e.preventDefault();
                const deleteConfirmation = confirm('آیا از حذف این کمک غیر نقدی اطمینان دارید؟');
                if (deleteConfirmation) {
                    let noncashhelpId = $(this).data('noncashhelp-id');
                    $('#noncashhelp-' + noncashhelpId).unbind('submit').submit();
                }
            });
        });
    </script>
@endsection
