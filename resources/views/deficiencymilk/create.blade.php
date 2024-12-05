@extends('layout.master')
@section('content')
    <div class="breadcrumb-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2">
                <li class="breadcrumb-item">
                    عجز كمية اللبن
                </li>
                <li class="breadcrumb-item active">
                    إضافة عجز كمية اللبن
                </li>
            </ol>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1">إضافة عجز كمية اللبن</h4>
                        <p class="mb-2">أدخل البيانات الآتية لإضافة عجز كمية اللبن </p>
                    </div>
                    <div class="card-body pt-0">
                        <form method="POST" action="{{ route('deficiencymilk.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputName">اسم السائق </label>
                                <input type="text" name="driver" class="form-control"
                                    @error('driver') border-danger @enderror" placeholder="(إجباري)"
                                    value="{{ old('driver') }}">
                                @error('driver')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputAddress">كمية عجز اللبن</label>
                                <input type="number" step=".01"
                                    class="form-control @error('value') border-danger @enderror" placeholder="(إجباري)"
                                    name="value" value="{{ old('value') }}">
                                @error('value')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputAddress"> نوع اللبن</label>
                                <select name="type" id="" class="form-control">
                                    <option value="">"(إجباري)"</option>
                                    <option value="buff">جاموسي</option>
                                    <option value="cow">بقري</option>
                                </select> 
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="inputAddress"> التاريخ</label>
                                <input type="date" id="date" class="form-control @error('date') border-danger @enderror"
                                    placeholder="(إجباري)" name="date" value="{{ old('date') }}">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group mb-0 mt-3 justify-content-end">
                                <div>
                                    <button type="submit" class="btn btn-primary">إضافة</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
