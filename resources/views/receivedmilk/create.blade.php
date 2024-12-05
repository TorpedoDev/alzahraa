@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                استلام لبن
            </li>
            <li class="breadcrumb-item active">
                استلام لبن من عميل
            </li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    @if(session('error'))
                    <div id="redirectMSG" class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                        {{session('error')}}
                    </div>
                    @endif
                    <h4 class="card-title mb-1">استلام لبن من عميل </h4>
                    <p class="mb-2">أدخل البيانات الآتية لاستلام اللبن من عميل </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('receivemilk.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <select name="customer_id"   class="select2">
                                <option value="">"(إجباري)"</option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputAddress"> التاريخ</label>
                                    <input type="date" id="date"  name="date" value="{{old('date')}}" class="form-control @error('date') border-danger @enderror"  placeholder="(اجباري)">
                                    @error('date')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputAddress"> الفترة</label>
                                    <select name="period" id="" class="form-control">
                                        <option value="">"(إجباري)"</option>
                                        <option value="am">صباحية</option>
                                        <option value="pm">مسائية</option>

                                    </select>
                                    @error('period')
                                    <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
<div class="row">
    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputAddress">كمية اللبن الجاموسي</label>
                            <input type="number" step=".01" name="buffalo_milk_qty" value="{{old('buffalo_milk_qty')}}" class="form-control @error('buffalo_milk_qty') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('buffalo_milk_qty')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputAddress">كمية اللبن البقري</label>
                            <input type="number" step=".01" name="cow_milk_qty" value="{{old('cow_milk_qty')}}" class="form-control @error('cow_milk_qty') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('cow_milk_qty')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        </div>
</div>

<div class="row">
    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputAddress">بنط اللبن الجاموسي</label>
                            <input type="number" step=".01" name="buffalo_pont" value="{{old('buffalo_pont')}}" class="form-control @error('buffalo_pont') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('buffalo_pont')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        </div>
<div class="col-md-6">
                        <div class="form-group">
                            <label for="inputAddress">بنط اللبن البقري</label>
                            <input type="number" step=".01" name="cow_pont" value="{{old('cow_pont')}}" class="form-control @error('cow_pont') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('cow_pont')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                        </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPhone"> ملاحظات الاستلام</label>
                            <textarea name="notes" class="form-control" placeholder="(اختياري)"></textarea>
                            @error('notes')
                            <p class="text-danger">{{$message}}</p>
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
    @endpush