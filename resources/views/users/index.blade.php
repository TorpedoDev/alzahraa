@extends('layout.master')
@push('css')
@endpush
@section('content')
<div id="nav" class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                المستخدمين
            </li>
            <li class="breadcrumb-item active">
                عرض المستخدمين
            </li>
        </ol>
    </nav>
</div>
<div class="row row-sm">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    @if(session('success'))
                    <div id="redirectMSG" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
  <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
</svg>
                        {{session('success')}}
                    </div>
                    @endif
                    <h4 class="card-title mg-b-0"> المستخدمين </h4>
                </div>
                <p class="tx-12 tx-gray-500 mb-2"></p>
                <br>
                <div id="nav" style="float: left;">
                    <button onclick="window.print(); return false;" class="btn btn-secondary">
                        طباعة
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
                            <path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                            <path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                        </svg></button>
                        @if (Auth::user()->role  == 'moderator')                                            
                    <a class="btn btn-primary" href="{{route('user.create')}}" style="margin-right: 20px;">
                        إضافة جديد
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg>
                    </a>
@endif
                </div>
                <br><br>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="print" class="table table-striped mg-b-0 text-md-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>اﻻسم</th>
                                <th>البريد الالكتروني</th>
                                <th>حالة النشاط</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <th scope="row">{{++ $index}}</th>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email }}</td>
                                <td> <p style="width: 100px; font-size: 16px" class="{{$user->active == 1 ? 'bg-success' : 'bg-danger'}} text-white text-center"> {{$user->active == 1 ? 'نشط' : 'غير نشط'}} </p></td>

                             
                                <td>
                                    <div class="row">
                                        @if (Auth::user()->role == 'moderator')                                            
                                        <a style="margin-left: 32px;" href="{{ route('user.edit', $user->id) }}">
                                            <i class="fa fa-edit text-info" title="تعديل"></i>
                                        </a>
                                        @endif

                                        <form action="{{ route('user.destroy' , $user->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button style="border:none; background:none;" type="submit" onclick="return confirm('هل تريد الحذف بالفعل ؟')">
    <i class="fa fa-trash text-danger" title="حذف"></i>
</button>
                                        </form>
                                        <form style="margin-right: 20px;" action="{{route('user.activation' , $user->id)}}" method="post">
                                            @csrf
                                            <button style="border:none; background:none;"  type="submit">
                                                @if ($user->active == 1)
                                                <i class="fa fa-eye-slash text-dark" aria-hidden="true"></i>

                                                @else
                                                <i class="fa fa-eye text-success" aria-hidden="true"></i>

                                                @endif
                            
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@push('scripts')
@endpush