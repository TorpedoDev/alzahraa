@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                 مدفوعات التجار
            </li>
            <li class="breadcrumb-item active">
إضافة مدفوعات لتاجر            
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
                    <h4 class="card-title mb-1">إضافة مدفوعات لتاجر</h4>
                    <p class="mb-2">أدخل البيانات الآتية لإضافة مدفوعات لتاجر </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('traderpay.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <select name="trader_id" class="form-control @error('trader_id') border-danger @enderror select2">
                                <option value="">"(إجباري)"</option>
                                @foreach($traders as $trader)
                                <option value="{{$trader->id}}">{{$trader->name}}</option>
                                @endforeach
                            </select>
                            @error('trader_id')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                     
                        <div class="form-group">
                            <label for="inputAddress">المبلغ المدفوع</label>
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