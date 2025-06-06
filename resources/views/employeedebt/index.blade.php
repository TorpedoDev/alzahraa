@extends('layout.master')
@push('css')
@endpush
@section('content')
<div id="nav" class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                سلف الموظفين
            </li>
            <li class="breadcrumb-item active">
                عرض سلف الموظفين
            </li>
        </ol>
    </nav>
</div>
<div class="row row-sm">
    <!--div-->
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

                        @if(session('error'))
                    <div id="redirectMSG" class="alert alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                        {{session('error')}}
                    </div>
                    @endif

                    <h4 class="card-title mg-b-0">  سلف الموظفين </h4>
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

                    <a class="btn btn-primary" href="{{route('employeedebt.create')}}" style="margin-right: 20px;">
                        إضافة سلفة 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                        </svg>
                    </a>

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
                                <th>قيمة السلفة</th>
                                <th> المبلغ المسدد</th> 
                                <th>الباقي</th> 
                                <th> التاريخ</th>
                                <th>المسؤول عن اﻻضافة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employeeDebts as $index => $employeeDebt)
                            <tr>
                                <th scope="row">{{$employeeDebts->firstItem() + $index}}</th>
                                <td>{{$employeeDebt->employee->name}}</td>
                                <td>{{$employeeDebt->value}} جنيه</td>
                                <td>{{$employeeDebt->paid}} جنيه</td>
                                <td>{{$employeeDebt->rest}} جنيه</td>
                                <td>
                                    {{\Carbon\Carbon::parse($employeeDebt->date)->locale('ar')->dayName}}
                                    <br>
                                    {{$employeeDebt->date}}
                                </td>
                                <td>{{$employeeDebt->user->name}}</td>
                                <td>
                                    <div class="row">
                                        <a style="margin-left: 8px;" href="{{ route('employeedebt.edit', $employeeDebt->id) }}">
                                            <i class="fa fa-edit text-info" title="تعديل"></i>
                                        </a>

                                        <a style="margin-left: 8px;"  href="{{ route('employeedebtpay.getpay', $employeeDebt->id) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                                              </svg>
                                        </a>

                                        <form action="{{ route('employeedebt.destroy' , $employeeDebt->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button style="border:none; background:none;" type="submit" onclick="return confirm('هل تريد الحذف بالفعل ؟ اذا كنت تريد الحذف فقم بحذف السداد الخاص بالسلفة أيضاً إذا كان لها سداد')">
    <i class="fa fa-trash text-danger" title="حذف"></i>
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
            <br>
            <div id="nav" class="card-body d-flex  justify-content-center">
                {!! $employeeDebts->links() !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection