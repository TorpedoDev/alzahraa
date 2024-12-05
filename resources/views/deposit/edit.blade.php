@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                أرضيات العملاء
            </li>
            <li class="breadcrumb-item active">
تعديل أرضية لعميل            
</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">تعديل أرضية لعميل</h4>
                    <p class="mb-2">قم بتعديل البيانات الآتية لتعديل أرضية العميل </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('deposit.update' , $deposit->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <select name="customer_id" class="form-control @error('customer_id') border-danger @enderror select2">
                                <option value="">"(إجباري)"</option>
                                @foreach($customers as $customer)
                                <option value="{{$customer->id}}" {{$customer->id == $deposit->customer_id ? "selected" : ""}}>{{$customer->name}}</option>
                                @endforeach
                            </select>
                            @error('customer_id')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="inputAddress">قيمة الارضية</label>
                            <input type="number" step=".01" class="form-control @error('value') border-danger @enderror" name="value" value="{{$deposit->value}}">
                            @error('value')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress"> التاريخ</label>
                            <input type="date" id="date" class="form-control @error('date') border-danger @enderror" placeholder="(إجباري)" name="date" value="{{$deposit->date}}">
                            @error('date')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                    
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection