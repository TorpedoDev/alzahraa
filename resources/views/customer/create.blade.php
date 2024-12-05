@extends('layout.master')
@section('content')
    <div class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    العملاء
                </li>
                <li class="breadcrumb-item active">
                    إضافة عميل جديد
                </li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        @if (session('error'))
                            <div id="redirectMSG" class="alert alert-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-x" viewBox="0 0 16 16">
                                    <path
                                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                </svg>
                                {{ session('error') }}
                            </div>
                        @endif
                        <h4 class="card-title mb-1">إضافة عميل جديد</h4>
                        <p class="mb-2">أدخل البيانات الآتية لإضافة عميل جديد</p>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('customer.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputName">اﻻسم</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') border-danger @enderror" id="inputName"
                                    placeholder="(إجباري)">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputAddress">العنوان</label>
                                <input type="text" name="address"value="{{ old('address') }}"
                                    class="form-control @error('address') border-danger @enderror" id="inputAddress"
                                    placeholder="(اختياري)">
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPhone">رقم التليفون</label>
                                <input type="text" name="phone" value="{{ old('phone') }}"
                                    class="form-control @error('phone') border-danger @enderror" id="inputPhone"
                                    placeholder="(اختياري)">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputline"> الخط</label>
                                <select name="line" class="form-control @error('line') border-danger @enderror">
                                    <option value="">--- اختر الخط ---</option>
                                    <option value="1">ميت سراج</option>
                                    <option value="2">ميت خاقان</option>
                                    <option value="3">كفر طنبدي</option>
                                    <option value="4">الماي</option>
                                    <option value="5">عزية الجبالي</option>
                                    <option value="6">كفر الشيخ خليل</option>
                                </select>
                                @error('line')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="inputPhone"> نوع المعاملة</label>
                                <select name="type" class="form-control @error('type') border-danger @enderror"
                                    id="customerType">
                                    <option value="">(إجباري)</option>
                                    <option value="pont">بالبنط</option>
                                    <option value="kilo">بالكيلو</option>
                                    <option value="kilo_and_pont">بالكيلو وبالبنط معاً</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="pont1" style="display: none;" class="form-group">
                                <label for="inputSal"> سعر بنط اللبن البقري</label>
                                <input type="number" step=".01" name="cow_pont_price"
                                    value="{{ old('cow_pont_price') }}"
                                    class="form-control @error('cow_pont_price') border-danger @enderror" id="inputSal"
                                    placeholder="(إجباري)">
                                @error('cow_pont_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="pont2" style="display: none;" class="form-group">
                                <label for="inputSal"> سعر بنط اللبن الجاموسي</label>
                                <input type="number" step=".01" name="buffalo_pont_price"
                                    value="{{ old('buffalo_pont_price') }}"
                                    class="form-control @error('buffalo_pont_price') border-danger @enderror" id="inputSal"
                                    placeholder="(إجباري)">
                                @error('buffalo_pont_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="kilo1" style="display: none;" class="form-group">
                                <label for="inputSal"> سعر كيلو اللبن البقري</label>
                                <input type="number" step=".01" name="cow_kilo_price"
                                    value="{{ old('cow_kilo_price') }}"
                                    class="form-control @error('cow_kilo_price') border-danger @enderror" id="inputSal"
                                    placeholder="(إجباري)">
                                @error('cow_kilo_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div id="kilo2" style="display: none;" class="form-group">
                                <label for="inputSal"> سعر كيلو اللبن الجاموسي</label>
                                <input type="number" step=".01" name="buffalo_kilo_price"
                                    value="{{ old('buffalo_kilo_price') }}"
                                    class="form-control @error('buffalo_kilo_price') border-danger @enderror"
                                    id="inputSal" placeholder="(إجباري)">
                                @error('buffalo_kilo_price')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>


                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary">إضافة</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    @push('scripts')
        <script>
            var customerType = jQuery("#customerType");
            var select = this.value;
            customerType.change(function() {
                if ($(this).val() == '') {
                    $("#kilo1").hide();
                    $("#kilo2").hide();
                    $("#pont1").hide();
                    $("#pont2").hide();
                }
                if ($(this).val() == 'pont') {
                    $("#pont1").show();
                    $("#pont2").show();
                    $("#kilo1 :input").val("");
                    $("#kilo1").hide();
                    $("#kilo2 :input").val("");
                    $("#kilo2").hide();
                }
                if ($(this).val() == 'kilo') {
                    $("#kilo1").show();
                    $("#kilo2").show();
                    $("#pont1 :input").val("");
                    $("#pont1").hide();
                    $("#pont2 :input").val("");
                    $("#pont2").hide();
                }
                if ($(this).val() == 'kilo_and_pont') {
                    $("#kilo1").show();
                    $("#kilo2").show();
                    $("#pont1").show();
                    $("#pont2").show();
                }
            })
        </script>
    @endpush
