@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                المستخدمين
            </li>
            <li class="breadcrumb-item active">
                إضافة مستخدم جديد
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
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                        {{session('error')}}
                    </div>
                    @endif
                    <h4 class="card-title mb-1">إضافة مستخدم جديد</h4>
                    <p class="mb-2">أدخل البيانات الآتية لإضافة مستخدم جديد</p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('user.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') border-danger @enderror" id="inputName" placeholder="(إجباري)">
                        @error('name')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">البريد الالكتروني</label>
                            <input type="text" name="email"value="{{old('email')}}" class="form-control @error('email') border-danger @enderror" id="inputAddress" placeholder="(إجباري)">
                            @error('email')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">كلمة المرور</label>
                            <input type="password" name="password" value="{{old('password')}}" class="form-control @error('password') border-danger @enderror" id="inputPhone" placeholder="(إجباري)">
                            @error('password')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">تأكيد كلمة المرور</label>
                            <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control @error('password_confirmation') border-danger @enderror" id="inputPhone" placeholder="(إجباري)">
                            @error('password_confirmation')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone"> نوع المستخدم</label>
                            <select name="role" class="form-control @error('role') border-danger @enderror" id="customerType" >
                                <option value="">(إجباري)</option>
                                <option value="employee">موظف</option>
                                <option value="admin">مدير</option>
                            </select>
                            @error('role')
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
    