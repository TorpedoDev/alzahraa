@extends('layout.master')
@push('css')
@endpush
@section('content')
    <div id="nav" class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                     تقرير شامل
                </li>
                <li class="breadcrumb-item active">
                    عرض  احصائيات شاملة
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
                        <h4 class="card-title mg-b-0"> عرض تقرير شامل عن مدة</h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"></p>
                    <br>
                    <div id="nav" style="float: left;">
                        <a style="height: 40px; margin-left: 20px" class="btn btn-warning" href="{{ url()->previous() }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                                <path fill-rule="evenodd"
                                    d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                            </svg>
                            عودة</a>
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
                    <h5> من : {{\Carbon\Carbon::parse($from)->locale('ar')->dayName}} {{$from}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; إلى : {{\Carbon\Carbon::parse($to)->locale('ar')->dayName}} {{$to}} </h5>

                    <br><br>
                </div>
                <div id="print" class="card-body">
                    <br><br><br><br>
                    <div class="row">
                        @if (isset($buffaloQuantity))
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن الجاموسي المستلمة
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $buffaloQuantity > 0 ? $buffaloQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($cowQuantity))
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        كمية اللبن البقري المستلمة
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $cowQuantity > 0 ? $cowQuantity . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($receiveMoney))
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                        اجمالي مدفوعات اللبن المستلم
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $receiveMoney > 0 ? $receiveMoney . ' جنيه' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="row">

                       @if (isset($buffaloSales))
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div style="font-weight: bold" class="card-header">
                                         كمية اللبن الجاموسي المباعة
                                    </div>
                                    <div style="font-weight: bold" class="card-body text-white">
                                        {{ $buffaloSales > 0 ? $buffaloSales . ' كيلو' : 'لا يوجد' }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if (isset($cowSales))
                        <div class="col-md-4">
                            <div class="card bg-secondary">
                                <div style="font-weight: bold" class="card-header">
                                    كمية اللبن البقري المباعة
                                </div>
                                <div style="font-weight: bold" class="card-body text-white">
                                    {{ $cowSales > 0 ? $cowSales . ' كيلو' : 'لا يوجد' }}
                                </div>
                            </div>
                        </div>
                    @endif

                    @if (isset($salesMoney))
                    <div class="col-md-4">
                        <div class="card bg-secondary">
                            <div style="font-weight: bold" class="card-header">
                                اجمالي مبيعات اللبن 
                            </div>
                            <div style="font-weight: bold" class="card-body text-white">
                                {{ $salesMoney > 0 ? $salesMoney . ' جنيه' : 'لا يوجد' }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <div class="row">
                @if (isset($homeSales))
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        <div style="font-weight: bold" class="card-header">
                            اجمالي مبيعات البيت 
                        </div>
                        <div style="font-weight: bold" class="card-body text-white">
                            {{ $homeSales > 0 ? $homeSales . ' جنيه' : 'لا يوجد' }}
                        </div>
                    </div>
                </div>
            @endif

            @if (isset($expenses))
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div style="font-weight: bold" class="card-header">
                        اجمالي المصاريف الاضافية 
                    </div>
                    <div style="font-weight: bold" class="card-body text-white">
                        {{ $expenses > 0 ? $expenses . ' جنيه' : 'لا يوجد' }}
                    </div>
                </div>
            </div>
        @endif

        @if (isset($employeesSalary))
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div style="font-weight: bold" class="card-header">
                    اجمالي قبض الموظفين 
                </div>
                <div style="font-weight: bold" class="card-body text-white">
                    {{ $employeesSalary > 0 ? $employeesSalary . ' جنيه' : 'لا يوجد' }}
                </div>
            </div>
        </div>
    @endif
            </div>

            <div class="row">
                @if (isset($buffaloDeficiencyMilks))
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div style="font-weight: bold" class="card-header">
                        اجمالي عجز اللبن الجاموسي 
                    </div>
                    <div style="font-weight: bold" class="card-body text-white">
                        {{ $buffaloDeficiencyMilks > 0 ? $buffaloDeficiencyMilks . ' كيلو' : 'لا يوجد' }}
                    </div>
                </div>
            </div>
        @endif


        @if (isset($cowDeficiencyMilks))
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div style="font-weight: bold" class="card-header">
                    اجمالي عجز اللبن البقري 
                </div>
                <div style="font-weight: bold" class="card-body text-white">
                    {{ $cowDeficiencyMilks > 0 ? $cowDeficiencyMilks . ' كيلو' : 'لا يوجد' }}
                </div>
            </div>
        </div>
    @endif

        @if (isset($homeExpense))
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div style="font-weight: bold" class="card-header">
                        اجمالي مصاريف البيت 
                    </div>
                    <div style="font-weight: bold" class="card-body text-white">
                        {{ $homeExpense > 0 ? $homeExpense . ' جنيه' : 'لا يوجد' }}
                    </div>
                </div>
            </div>
        @endif

        @if (isset($farmExpense))
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div style="font-weight: bold" class="card-header">
                        اجمالي مصاريف المزرعة 
                    </div>
                    <div style="font-weight: bold" class="card-body text-white">
                        {{ $farmExpense > 0 ? $farmExpense . ' جنيه' : 'لا يوجد' }}
                    </div>
                </div>
            </div>
        @endif
            </div>
            <div class="row">
                @if (isset($buffaloHomeSale))
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        <div style="font-weight: bold" class="card-header">
                            كمية اللبن الجاموسي المباعة في البيت
                        </div>
                        <div style="font-weight: bold" class="card-body text-white">
                            {{ $buffaloHomeSale > 0 ? $buffaloHomeSale . ' كيلو' : 'لا يوجد' }}
                        </div>
                    </div>
                </div>
            @endif
            @if (isset($cowHomeSale))
            <div class="col-md-4">
                <div class="card bg-secondary">
                    <div style="font-weight: bold" class="card-header">
                        كمية اللبن البقري المباعة في البيت
                    </div>
                    <div style="font-weight: bold" class="card-body text-white">
                        {{ $cowHomeSale > 0 ? $cowHomeSale . 'كيلو' : 'لا يوجد' }}
                    </div>
                </div>
            </div>
        @endif
            </div>
                </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
