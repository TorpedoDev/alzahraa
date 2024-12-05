@extends('layout.master')
@push('css')
@endpush
@section('content')
    <div id="nav" class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    العملاء
                </li>
                <li class="breadcrumb-item active">
                    عرض العملاء
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
                        <h4 class="card-title mg-b-0"> العملاء </h4>
                    </div>
                    <p class="tx-12 tx-gray-500 mb-2"></p>
                    <br>
                    <div id="nav" style="float: left;">
                        <button onclick="window.print(); return false;" class="btn btn-secondary">
                            طباعة
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-printer-fill" viewBox="0 0 16 16">
                                <path
                                    d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1" />
                                <path
                                    d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1" />
                            </svg></button>

                        <a class="btn btn-primary" href="{{ route('customer.create') }}" style="margin-right: 20px;">
                            إضافة عميل
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                        </a>
                    </div>
                    <br><br>
                </div>
                <div class="card-body">
                    <input type="text" name="search" id="ajaxSearch" class="form-control no-print" placeholder="ابحث هنا.....">
                    <br>
                    <div class="table-responsive">
                        <div class="customerData">
                            <table id="print" class="table  table-striped mg-b-0 text-md-nowrap">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اﻻسم</th>
                                        <th>العنوان</th>
                                        <th>رقم التليفون</th>
                                        <th> الخط</th>
                                        <th> نوع التعامل</th>
                                        <th>سعر بنط اللبن البقري</th>
                                        <th>سعر بنط اللبن الجاموسي</th>
                                        <th>سعر كيلو اللبن البقري</th>
                                        <th>سعر كيلو اللبن الجاموسي</th>

                                        <th>اجمالي السلف</th>
                                        <th>المبلغ المسدد</th>
                                        <th>الباقي</th>

                                        <th>العمليات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr class="table-data">
                                            <th scope="row">{{ $customers->firstItem() + $index }}</th>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->phone }}</td>
                                           @if ($customer->line == 1)
                                           <td>ميت سراج</td>
                                           @elseif ($customer->line == 2)
                                           <td>ميت خاقان</td>

                                           @elseif ($customer->line == 3)
                                           <td>كقر طنبدي</td>

                                           @elseif ($customer->line == 4)
                                           <td> الماي</td>

                                           @elseif ($customer->line == 5)
                                           <td>عزبة الجبالي</td>

                                           @else
                                           <td>كفر الشيخ خليل</td>

                                           @endif
                                            <td>{{ $customer->type == 'pont' ? 'بالبنط' : '' }}
                                                {{ $customer->type == 'kilo' ? 'بالكيلو' : '' }}
                                                {{ $customer->type == 'kilo_and_pont' ? 'بالكيلو والبنط معاً' : '' }}</td>
                                            <td>{{ $customer->cow_pont_price > 0 ? $customer->cow_pont_price . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>
                                            <td>{{ $customer->buffalo_pont_price > 0 ? $customer->buffalo_pont_price . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>
                                            <td>{{ $customer->cow_kilo_price > 0 ? $customer->cow_kilo_price . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>
                                            <td>{{ $customer->buffalo_kilo_price > 0 ? $customer->buffalo_kilo_price . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>


                                            <td>{{ $customer->debts->where('is_paid', 0)->sum('value') > 0 ? $customer->debts->where('is_paid', 0)->sum('value') . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>
                                            <td>{{ $customer->debts->where('is_paid', 0)->sum('paid') > 0 ? $customer->debts->where('is_paid', 0)->sum('paid') . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>
                                            <td>{{ $customer->debts->where('is_paid', 0)->sum('rest') > 0 ? $customer->debts->where('is_paid', 0)->sum('rest') . ' جنيه ' : 'ﻻ يوجد' }}
                                            </td>


                                            <td>
                                                <div class="row">
                                                    @if (Auth::user()->role != 'employee')
                                                        <a style="margin-left: 32px;"
                                                            href="{{ route('customer.edit', $customer->id) }}">
                                                            <i class="fa fa-edit text-info" title="تعديل"></i>
                                                        </a>
                                                    @endif
                                                    <form action="{{ route('customer.destroy', $customer->id) }}"
                                                        method="post">
                                                        @method('delete')
                                                        @csrf
                                                        <button style="border:none; background:none;" type="submit"
                                                            onclick="return confirm('هل تريد الحذف بالفعل ؟')">
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
                </div>
                <br>
                <div id="nav" class="card-body d-flex  justify-content-center">
                    {!! $customers->links() !!}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script>
        let debounce;
        $(document).on("input", "#ajaxSearch", function(e) {
            e.preventDefault();
            var ajaxSearch = $("#ajaxSearch").val();
            clearTimeout(debounce);
            debounce = setTimeout(() => {
                $.ajax({
                    url: "{{ route('customer.search') }}",
                    type: "GET",
                    dataType: 'html',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'search': ajaxSearch
                    },
                    success: function(response) {
                        $(".customerData").html(response);
                    }
                });
            }, 1000);

        });
    </script>
@endpush
