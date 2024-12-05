@extends('layout.master')
@push('css')
@endpush
@section('content')
<div id="nav" class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                عجز كمية اللبن
            </li>
            <li class="breadcrumb-item active">
                عرض عجز كمية اللبن  
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

                    <h4 class="card-title mg-b-0"> عجز كمية اللبن </h4>
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

                    <a class="btn btn-primary" href="{{route('deficiencymilk.create')}}" style="margin-right: 20px;">
                        إضافة عجز 
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
                                <th>كمية العجز</th>
                                <th>نوع اللبن</th>
                                <th> التاريخ</th>
                                <th>المسؤول عن اﻻضافة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deficiencyMilk as $index => $deficiency)
                            <tr>
                                <th scope="row">{{$deficiencyMilk->firstItem() + $index}}</th>
                                <td>{{$deficiency->driver}}</td>
                                <td>{{$deficiency->value}}  كيلو</td>
                                <td>{{$deficiency->type == 'buff' ? 'جاموسي' : 'بقري'}}</td>
                                <td>
                                    {{\Carbon\Carbon::parse($deficiency->date)->locale('ar')->dayName}}
                                    <br>
                                    {{$deficiency->date}}
                                </td>
                                <td>{{$deficiency->user->name}}</td>
                                <td>
                                    <div class="row">
                                        <a style="margin-left: 32px;" href="{{ route('deficiencymilk.edit', $deficiency->id) }}">
                                            <i class="fa fa-edit text-info" title="تعديل"></i>
                                        </a>

                                        <form action="{{ route('deficiencymilk.destroy' , $deficiency->id) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button style="border:none; background:none;" type="submit" onclick="return confirm('هل تريد الحذف بالفعل ؟ اذا كنت تريد الحذف فقم بحذف الخصم الخاص بالعجز أيضاً من جدول خصومات الموظفين')">
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
                {!! $deficiencyMilk->links() !!}
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
@push('scripts')
@endpush