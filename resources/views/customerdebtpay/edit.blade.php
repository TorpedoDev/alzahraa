@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                سداد سلف العملاء
            </li>
            <li class="breadcrumb-item active">
تعديل سداد سلفة عميل            
</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                @if(session('error'))
                    <div id="redirectMSG" class="alert alert-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                        {{session('error')}}
                    </div>
                    @endif
                    <h4 class="card-title mb-1">تعديل سداد سلفة عميل</h4>
                    <p class="mb-2">قم بتعديل البيانات الآتية لتعديل سداد سلفة العميل </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('customerdebtpay.update' , $customerDebtPay->id)}}">
                        @csrf
                        @method('PUT')
             
                    
                        <div class="form-group">
                            <label for="inputAddress">قيمة السداد</label>
                            <input type="number" step=".01" class="form-control @error('value') border-danger @enderror" name="value" value="{{$customerDebtPay->value}}">
                            @error('value')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress"> التاريخ</label>
                            <input type="date" id="date" class="form-control @error('date') border-danger @enderror" placeholder="(إجباري)" name="date" value="{{$customerDebtPay->date}}">
                            @error('date')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                    
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary">تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection