@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">لیست نیازمندان</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('poors.create') }}" class="btn btn-primary">
                <span class="fa fa-plus"></span>
                <span class="mr-2">ثبت نیازمند جدید</span>
            </a>
        </div>
    </div>

    <div class="poors-filters mb-4">
        <div class="row">
            <div class="col-lg-4">
                <form method="GET" action="{{ route('poors.index') }}" id="search-poor-form">
                    <input type="text" placeholder="جستجو بر اساس نام، نام خانوادگی، آدرس، مدرک تحصیلی و ..." class="form-control" id="search-poor-input" />
                    <button type="submit" class="d-none"></button>
                </form>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>نام و نام خانوادگی</th>
                <th>تلفن همراه</th>
                <th class="text-center">برطرف شدن مشکل</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($poors as $poor)
                <tr>
                    <td>{{ $poor->full_name }}</td>
                    <td>{{ $poor->phone ?? 'نامشخص' }}</td>
                    <td class="text-center">
                        @if ($poor->has_problem_solved)
                            <span class="fa fa-check-circle text-success" style="font-size:20px"></span>
                        @else
                            <span class="fa fa-times-circle text-danger" style="font-size:20px"></span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('poors.edit', [ 'poor' => $poor ]) }}" class="btn btn-info btn-sm ml-1">
                            مشاهده و ویرایش
                        </a>
                    </td>
                </tr>                
            @empty
                <tr>
                    <td colspan="4" class="text-center">در حال حاضر نیازمندی ثبت نشده است.</td>
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
                <li class="page-item"><a class="page-link" href="{{ route('poors.index', ['page' => $page - 1]) }}">قبلی</a></li>
            @endif

            @for ($i = $from; $i < $to; $i++)
                @if ($i > 0 && $i < $lastPage + 1)
                    <li class="page-item {{ $i == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ route('poors.index', ['page' => $i]) }}">{{ $i }}</a>
                    </li>
                @endif
            @endfor

            @if ($page != $lastPage)
                <li class="page-item"><a class="page-link" href="{{ route('poors.index', ['page' => $page + 1]) }}">بعدی</a></li>
            @endif
        </ul>
    @endif
@endsection

@section('footerScripts')
    @parent

    <script>
        $(document).ready(function() {
            $('#search-poor-form').on('submit', function(e) {
                e.preventDefault();
                const keyword = $('#search-poor-input').val();
                // const querystring = qs.parse(window.location.search.replace('?',''));
                // querystring['keyword'] = keyword;
                const data = { search: keyword };
                const querystring = qs.stringify(data);
                window.open(window.location.href.split('?')[0] + '?' + querystring, '_self');
            });
        });
    </script>
@endsection
