@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-sm-6 mb-4 mb-sm-0">
            <h2 class="mb-0">ویرایش اطلاعات نیازمند: {{ $poor->full_name }}</h2>
        </div>
        <div class="col-sm-6 text-left">
            <a href="{{ route('poors.index') }}" class="btn btn-primary">
                <span class="fa fa-table"></span>
                <span class="mr-2">بازگشت به لیست نیازمندان</span>
            </a>
        </div>
    </div>

    <form method="POST" action="{{ route('poors.update', [ 'poor' => $poor ]) }}">
        @csrf
        @method('PATCH')

        <h4 class="bg-green p-3 mb-4">اطلاعات فردی:</h4>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="first_name">نام:</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $poor->first_name }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="last_name">نام خانوادگی:</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $poor->last_name }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="national_code">کد ملی:</label>
                <input type="text" class="form-control" id="national_code" name="national_code" value="{{ $poor->national_code }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="marital_status">وضعیت تاهل:</label>
                <select class="form-control" id="marital_status" name="marital_status">
                    <option value="">وضعیت تاهل...</option>
                    <option {{ $poor->marital_status === 'متاهل' ? 'selected' : '' }} value="متاهل">متاهل</option>
                    <option {{ $poor->marital_status === 'مجرد' ? 'selected' : '' }} value="مجرد">مجرد</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="education_status">میزان تحصیلات:</label>
                <select class="form-control" id="education_status" name="education_status">
                    <option value="">میزان تحصیلات...</option>
                    <option {{ $poor->education_status === 'بی سواد' ? 'selected' : '' }} value="بی سواد">بی سواد</option>
                    <option {{ $poor->education_status === 'سیکل' ? 'selected' : '' }} value="سیکل">سیکل</option>
                    <option {{ $poor->education_status === 'دیپلم' ? 'selected' : '' }} value="دیپلم">دیپلم</option>
                    <option {{ $poor->education_status === 'فوق دیپلم' ? 'selected' : '' }} value="فوق دیپلم">فوق دیپلم</option>
                    <option {{ $poor->education_status === 'لیسانس' ? 'selected' : '' }} value="لیسانس">لیسانس</option>
                    <option {{ $poor->education_status === 'فوق لیسانس' ? 'selected' : '' }} value="فوق لیسانس">فوق لیسانس</option>
                    <option {{ $poor->education_status === 'دکترا' ? 'selected' : '' }} value="دکترا">دکترا</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="job">شغل:</label>
                <input type="text" class="form-control" id="job" name="job" value="{{ $poor->job }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="kids_qty">تعداد فرزندان:</label>
                <input type="number" min="0" class="form-control" id="kids_qty" name="kids_qty" value="{{ $poor->kids_qty }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="under_supervision_qty">تعداد افراد تحت سرپرستی:</label>
                <input type="number" min="0" class="form-control" id="under_supervision_qty" name="under_supervision_qty" value="{{ $poor->under_supervision_qty }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="insurance_status">وضعیت بیمه:</label>
                <input type="text" class="form-control" id="insurance_status" name="insurance_status" value="{{ $poor->insurance_status }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="supportive_org_status">وضعیت تحت پوششی سازمان های حمایتی:</label>
                <input type="text" class="form-control" id="supportive_org_status" name="supportive_org_status" value="{{ $poor->supportive_org_status }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="physical_status">وضعیت جسمانی:</label>
                <input type="text" class="form-control" id="physical_status" name="physical_status" value="{{ $poor->physical_status }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="working_ability">توانایی انجام کار:</label>
                <select class="form-control" id="working_ability" name="working_ability">
                    <option value="">توانایی انجام کار...</option>
                    <option {{ $poor->working_ability == '1' ? 'selected' : '' }} value="1">دارد</option>
                    <option {{ $poor->working_ability == '0' ? 'selected' : '' }} value="0">ندارد</option>
                </select>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="landline_phone">تلفن ثابت:</label>
                <input type="text" class="form-control" id="landline_phone" name="landline_phone" value="{{ $poor->landline_phone }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="phone">تلفن همراه:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ $poor->phone }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="credit_card">شماره کارت بانکی:</label>
                <input type="text" class="form-control" id="credit_card" name="credit_card" value="{{ $poor->credit_card }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <label for="address">آدرس:</label>
                <textarea class="form-control" id="address" name="address">{{ $poor->address }}</textarea>
            </div>
        </div>

        <h4 class="bg-green p-3 mb-4">اطلاعات اعضای خانواده:</h4>

        <div class="row">
            <div class="col-12 mb-4">
                <label for="members_physical_status">وضعیت جسمانی افراد خانواده:</label>
                <textarea class="form-control" id="members_physical_status" name="members_physical_status">{{ $poor->members_physical_status }}</textarea>
            </div>
            <div class="col-12 mb-4">
                <label for="members_patient_status">وضعیت افراد بیمار خانواده:</label>
                <textarea class="form-control" id="members_patient_status" name="members_patient_status">{{ $poor->members_patient_status }}</textarea>
            </div>
            <div class="col-12 mb-4">
                <label for="members_education_status">وضعیت تحصیل فرزندان:</label>
                <textarea class="form-control" id="members_education_status" name="members_education_status">{{ $poor->members_education_status }}</textarea>
            </div>
        </div>

        <h4 class="bg-green p-3 mb-4">اطلاعات معیشتی:</h4>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="home_status">وضعیت مسکن:</label>
                <select class="form-control" id="home_status" name="home_status">
                    <option value="">وضعیت مسکن...</option>
                    <option {{ $poor->home_status == 'استیجاری' ? 'selected' : '' }} value="استیجاری">استیجاری</option>
                    <option {{ $poor->home_status == 'صاحب ملک' ? 'selected' : '' }} value="صاحب ملک">صاحب ملک</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="home_deposit_amount">میزان ودیعه (تومان):</label>
                <input type="text" min="0" class="form-control" id="home_deposit_amount" name="home_deposit_amount" value="{{ $poor->home_deposit_amount }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="home_rent_amount">میزان اجاره ماهیانه (تومان):</label>
                <input type="text" min="0" class="form-control" id="home_rent_amount" name="home_rent_amount" value="{{ $poor->home_rent_amount }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="has_car">خودروی شخصی:</label>
                <select class="form-control" id="has_car" name="has_car">
                    <option value="">خودروی شخصی...</option>
                    <option {{ $poor->has_car == '1' ? 'selected' : '' }} value="1">دارد</option>
                    <option {{ $poor->has_car == '0' ? 'selected' : '' }} value="0">ندارد</option>
                </select>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="monthly_rent_amount">میزان اقساط ماهیانه (تومان):</label>
                <input type="text" min="0" class="form-control" id="monthly_rent_amount" name="monthly_rent_amount" value="{{ $poor->monthly_rent_amount }}" autocomplete="off" />
            </div>
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="furniture">وضعیت لوازم خانگی:</label>
                <input type="text" class="form-control" id="furniture" name="furniture" value="{{ $poor->furniture }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 mb-4">
                <label for="details">توضیحات:</label>
                <textarea class="form-control" id="details" name="details">{{ $poor->details }}</textarea>
            </div>
        </div>

        <h4 class="bg-green p-3 mb-4">درخواست های نیازمند:</h4>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                <label for="monthly_need_amount">میزان درخواست کمک نقدی ماهیانه (تومان):</label>
                <input type="text" class="form-control" id="monthly_need_amount" name="monthly_need_amount" value="{{ $poor->monthly_need_amount }}" autocomplete="off" />
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9 mb-4">
                <label for="non_cash_need">نوع حمایت درخواستی غیر نقدی ماهیانه:</label>
                <textarea class="form-control" id="non_cash_need" name="non_cash_need">{{ $poor->non_cash_need }}</textarea>
            </div>
        </div>

        <div class="row pt-4">
            <div class="col-12 mb-5 d-flex align-items-center">
                <input type="checkbox" id="has_problem_solved" name="has_problem_solved" {{ $poor->has_problem_solved ? 'checked' : '' }} />
                <label for="has_problem_solved" class="mb-0 mr-2">مشکل این نیازمند حل شده است.</label>
            </div>
        </div>

        <div class="text-right mb-5">
            <button class="btn btn-primary btn-lg" type="submit">ثبت اطلاعات</button>
        </div>
    </form>
@endsection
