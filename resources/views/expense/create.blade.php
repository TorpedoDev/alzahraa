@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                المصاريف اﻻضافية
            </li>
            <li class="breadcrumb-item active">
إضافة مصروف جديد            
</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">إضافة مصروف جديد</h4>
                    <p class="mb-2">أدخل البيانات الآتية لإضافة مصروف جديد </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('expense.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputAddress">بند المصروف</label>
                            <input type="text" class="form-control @error('reason') border-danger @enderror" name="reason" value="{{old('reason')}}">
                            @error('reason')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">قيمة المصروف</label>
                            <input type="number" step=".01" class="form-control @error('value') border-danger @enderror" name="value" value="{{old('value')}}">
                            @error('value')
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