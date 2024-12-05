@extends('layout.master')
@section('content')
<div style="margin-top: 30px" class="page-header">
    <h3 class="page-title"> الملف الشخصي </h3>
    <div class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    الاعدادات
                </li>
                <li class="breadcrumb-item active">
                    اعدادات الحساب
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="container">
    @if(session('success'))
    <div id="redirectMSG" class="alert alert-success">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
<path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
</svg>
        {{session('success')}}
    </div>
    @endif

  @if(session('error'))
                    <div id="redirectMSG" class="alert alert-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg>
                        {{session('error')}}
                    </div>
                    @endif
<div class="row gutters">
<div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="account-settings">
                <div class="user-profile">
                    <div class="user-avatar">
                        <img src="{{asset('assets/img/avatar1.png')}}" alt="Maxwell Admin" width="150px" height="150px">
                    </div>
                    <br>
                    <h5 class="user-name">{{$user->name}}</h5>
                    <h6 class="user-email">{{$user->email}}</h6>
                </div>
                <br><br>
                <div class="about">
                    <h5 class="mb-2 text-primary"> نبذة عن المسنخدم</h5>
                    <p>
                        {{$user->role == 'moderator' ? 'المدير المسؤول وله كافة الصلاحيات' : ''}}
                        {{$user->role == 'admin' ? 'المدير المسؤول وله كافة الصلاحيات' : ''}}
                        {{$user->role == 'employee' ? 'مستخدم هام وله كافة الصلاحيات باستثناء بعض الصلاحيات الخاصة بالمدير' : ''}}


                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
    <div class="card h-100">
        <div class="card-body">
        <form action="{{route('setting.update')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-3 text-primary">التفاصيل الشخصية</h6>
                </div>
               
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="fullName">الاسم</label>
                        <input type="text" class="form-control @error('name') border-danger @enderror" id="fullName" placeholder="Enter full name" name="name" value="{{$user->name}}">
                        @error('name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                    <div class="form-group">
                        <label for="eMail">البريد الالكتروني</label>
                        <input type="email" class="form-control @error('email') border-danger @enderror" id="eMail" placeholder="Enter email" name="email" value="{{$user->email}}">
                        @error('email')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">تحديث البيانات</button>
        </form>
<br><br>
                <form action="{{route('setting.updatepassword')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row gutters">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <h6 class="mb-3 text-primary">تغيير كلمة المرور</h6>
                </div>
               
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="fullName">كلمة المرور الحالية</label>
                        <input type="password" class="form-control @error('old_password') border-danger @enderror" id="fullName" placeholder="أدخل كلمة المرور الحالية" name="old_password">
                        @error('old_password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="eMail">كلمة المرور الجديدة</label>
                        <input type="password" class="form-control @error('new_password') border-danger @enderror" id="eMail" placeholder="أدخل كلمة المرور الجديدة" name="new_password">
                        @error('new_password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label for="eMail">تأكيد كلمة المرور الجديدة</label>
                        <input type="password" class="form-control @error('new_password_confirmation') border-danger @enderror" id="eMail" placeholder="أدخل كلمة المرور الجديدة مرة أخرى" name="new_password_confirmation">
                        @error('new_password_confirmation')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">تغيير كلمة المرور</button>
        </form>
        </div>
    </div>
</div>
</div>
</div>
<br><br><br>

@endsection