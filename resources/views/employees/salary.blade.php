@extends('layout.master')
@push('css')
@endpush
@section('content')
    <div class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    الموظفين
                </li>
                <li class="breadcrumb-item active">
                    قبض الموظفين
                </li>
            </ol>
        </nav>
    </div>
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @if (session('success'))
                            <div id="redirectMSG" class="alert alert-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-check-lg" viewBox="0 0 16 16">
                                    <path
                                        d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                </svg>
                                {{ session('success') }}
                            </div>
                        @endif
                        <h4 class="card-title mg-b-0"> قبض الموظفين </h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"></p>
                    <br>
                    <div style="float: left;">
                        <button onclick="window.print(); return false;" class="btn btn-secondary">
                            طباعة
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                                <path
                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            </svg></button>

                    </div>
                    <br><br>
                </div>
                <div class="card-body">
                    <form action="{{ route('emp.getsal') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">الشهر</label>
                                    <select name="month" class="form-control">
                                        <option value="">---</option>
                                        <option value="1">يناير</option>
                                        <option value="2">فبراير</option>
                                        <option value="3">مارس</option>
                                        <option value="4">ابريل</option>
                                        <option value="5">مايو</option>
                                        <option value="6">يونيو</option>
                                        <option value="7">يوليو</option>
                                        <option value="8">أغسطس</option>
                                        <option value="9">سبتمبر</option>
                                        <option value="10">أكتوبر</option>
                                        <option value="11">نوفمبر</option>
                                        <option value="12">ديسمبر</option>

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <button style="margin-top: 30px" type="submit" class="btn btn-info">عرض المرتبات</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                @if (isset($employees) && count($employees) > 1)
                    <div class="table-responsive">
                        <table id="print" class="table table-striped mg-b-0 text-md-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اﻻسم</th>
                                    <th>العنوان</th>
                                    <th>رقم التليفون</th>
                                    <th>عدد الشيفتات</th>
                                    <th>اجمالي الخصم</th>
                                    <th>اجمالي الحوافز</th>
                                    <th>اجمالي المرتب</th>
                                    <th> السلف</th>
                                    <th>العمليات</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $index => $employee)
                                    <tr id="printRow">
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ $employee->name }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->attendences()->whereMonth('created_at', $month)->where('is_paid', 0)->count() }}
                                        </td>
                                        <td>{{ $employee->discounts()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') }}
                                        </td>
                                        <td>{{ $employee->bonuses()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') }}
                                        </td>
                                        <td>{{ $employee->attendences()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('price') + $employee->bonuses()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') - $employee->discounts()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') < 0 ? 0 : round($employee->attendences()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('price') + $employee->bonuses()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') - $employee->discounts()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value')) }}
                                        </td>
                                        <td>
                                            <h5>
                                                {{ $employee->debts->sum('rest') > 0 ? $employee->debts->sum('rest') . 'جنيه' : 'لا شئ' }}
                                            </h5>
                                        </td>
                                        <td>
                                            @if (
                                                $employee->attendences()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('price') +
                                                    $employee->bonuses()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') -
                                                    $employee->discounts()->whereMonth('created_at', $month)->where('is_paid', 0)->sum('value') >
                                                    0)
                                                <div class="row">
                                                    <a style="margin-left: 40px;"
                                                        href="{{ route('emp.paysal', ['id' => $employee->id, 'month' => $month]) }}"
                                                        class="btn btn-success">
                                                        سداد
                                                    </a>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@push('scripts')
@endpush
