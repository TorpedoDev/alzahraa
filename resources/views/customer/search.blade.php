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
            <tr>
                <th scope="row">{{$customers->firstItem()+$index }}</th>
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