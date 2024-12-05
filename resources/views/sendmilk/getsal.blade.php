@extends('layout.master')
@push('css')
@endpush
@section('content')
    <div id="nav" class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    طلبيات اللبن
                </li>
                <li class="breadcrumb-item active">
                    عرض مدة طلبيات اللبن
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
                        <h4 class="card-title mg-b-0"> عرض مدة طلبيات اللبن</h4>
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
                    <br><br>
                </div>


                @if (isset($milks) && count($milks) > 0)
                    <div id="print" class="card-body">
                        <div class="card-header">
                            <div class="row" style="margin-bottom: 50px">
                                <div class="col-md-6">
                                    <h3>
                                        معمل ألبان الزهراء
                                    </h3>
                                </div>
                                <div class="col-md-3" style="float: left">
                                    <h3>
                                        الحاج عماد دياب : 01003774774
                                    </h3>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <h4>
                                        اسم التاجر : {{ $trader->name }}
                                    </h4>
                                </div>
                                @if (!empty($trader->address))
                                    <div class="col-md-3">
                                        <h4>
                                            العنوان : {{ $trader->address }}
                                        </h4>
                                    </div>
                                @endif

                                @if (!empty($trader->phone))
                                    <div class="col-md-3">
                                        <h4>
                                            رقم التليفون : {{ $trader->phone }}
                                        </h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <br><br><br><br>
                        <div class="table-responsive">
                            <table id="print" class="table table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                    <tr>
                                        <th></th>
                                        <th style="font-weight: bold; font-size: 19px;" colspan="2">اللبن الجاموسي</th>
                                        <th style="font-weight: bold; font-size: 19px;" colspan="2">اللبن البقري</th>
                                        <th style="font-weight: bold; font-size: 19px;">الديون</th>
                                        <th></th>

                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="font-weight: bold;">اليوم</td>
                                        <td style="font-weight: bold;">الكمية </td>
                                        <td style="font-weight: bold;">البنط </td>
                                        <td style="font-weight: bold;">الكمية </td>
                                        <td style="font-weight: bold;">البنط </td>
                                        <td>{{ $trader->debt > 0 ? $trader->debt . 'جنيه' : 'لا شئ' }}</td>
                                        <td></td>
                                    </tr>
                                    @foreach ($milks as $index => $milk)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($milk->date)->locale('ar')->dayName }} <br>
                                                {{ $milk->date }}</td>
                                            <td>{{ $milk->buffalo_milk_qty ?? '----' }} كيلو</td>
                                            <td>{{ $milk->buffalo_pont ?? '----' }}</td>
                                            <td>{{ $milk->cow_milk_qty ?? '----' }} كيلو</td>
                                            <td>{{ $milk->cow_pont ?? '----' }}</td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="print" class="card-footer">
                                <h3>
                                    اجمالي كمية اللبن الجاموسي : {{ $total_buff }} كيلو
                                    <br>
                                    اجمالي كمية اللبن البقري : {{ $total_cow }} كيلو
                                    <br>
                                    المبلغ : {{ $salary }}جنيهاً مصرياً فقط لا غير

                                </h3>


                            </div>
                        </div>
                    </div>
                @else
                    <div class="card-body">
                        <div class="alert alert-info" style="width: 100%">
                            هذا التاجر ليس له أي مدة لم يتم سدادها
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('scripts')
@endpush
