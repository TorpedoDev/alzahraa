<table id="print" class="table table-striped mg-b-0 text-md-nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>اﻻسم</th>
            <th>العنوان</th>
            <th>رقم التليفون</th>
            <th> نوع التعامل</th>
            <th>سعر بنط اللبن البقري</th>
            <th>سعر بنط اللبن الجاموسي</th>
            <th>سعر كيلو اللبن البقري</th>
            <th>سعر كيلو اللبن الجاموسي</th>
            <th>العمليات</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($traders as $index => $trader)
            <tr>
                <th scope="row">{{ $traders->firstItem() + $index }}</th>
                <td>{{ $trader->name }}</td>
                <td>{{ $trader->address }}</td>
                <td>{{ $trader->phone }}</td>

                <td>{{ $trader->type == 'pont' ? 'بالبنط' : '' }}
                    {{ $trader->type == 'kilo' ? 'بالكيلو' : '' }}
                    {{ $trader->type == 'kilo_and_pont' ? 'بالكيلو والبنط معاً' : '' }}</td>
                <td>{{ $trader->cow_pont_price > 0 ? $trader->cow_pont_price . ' جنيه ' : 'ﻻ يوجد' }}
                </td>
                <td>{{ $trader->buffalo_pont_price > 0 ? $trader->buffalo_pont_price . ' جنيه ' : 'ﻻ يوجد' }}
                </td>
                <td>{{ $trader->cow_kilo_price > 0 ? $trader->cow_kilo_price . ' جنيه ' : 'ﻻ يوجد' }}
                </td>
                <td>{{ $trader->buffalo_kilo_price > 0 ? $trader->buffalo_kilo_price . ' جنيه ' : 'ﻻ يوجد' }}
                </td>
                <td>
                    <div class="row">
                        @if (Auth::user()->role != 'employee')
                            <a style="margin-left: 32px;"
                                href="{{ route('trader.edit', $trader->id) }}">
                                <i class="fa fa-edit text-info" title="تعديل"></i>
                            </a>
                        @endif
                        <form action="{{ route('trader.destroy', $trader->id) }}" method="post">
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