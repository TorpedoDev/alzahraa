@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                الموظفين
            </li>
            <li class="breadcrumb-item active">
                تعديل بيانات موظف 
            </li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">تعديل بيانات موظف </h4>
                    <p class="mb-2">قم بتعديل البيانات التي  ترغب في تعديلها للموظف</p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('employee.update' , $employee->id)}}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <input type="text" name="name" value="{{$employee->name}}" class="form-control @error('name') border-danger @enderror" id="inputName" placeholder="(إجباري)">
                        @error('name')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">العنوان</label>
                            <input type="text" name="address"value="{{$employee->address}}" class="form-control @error('address') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('address')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">رقم التليفون</label>
                            <input type="text" name="phone" value="{{$employee->phone}}" class="form-control @error('phone') border-danger @enderror" id="inputPhone" placeholder="(اختياري)">
                            @error('phone')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputSal"> سعر الشيفت</label>
                            <input type="number" step=".01" name="sheft_sal" value="{{$employee->sheft_sal}}" class="form-control @error('sheft_sal') border-danger @enderror" id="inputSal" placeholder="(إجباري)">
                            @error('sheft_sal')
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