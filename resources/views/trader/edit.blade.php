@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                 التجار
            </li>
            <li class="breadcrumb-item active">
                تعديل بيانات تاجر 
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
                    <h4 class="card-title mb-1">تعديل بيانات تاجر </h4>
                    <p class="mb-2">قم بتعديل البيانات الآتية لتعديل التاجر </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('trader.update' , $trader->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="inputName">اﻻسم</label>
                            <input type="text" name="name" value="{{$trader->name}}" class="form-control @error('name') border-danger @enderror" id="inputName" placeholder="(إجباري)">
                        @error('name')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">العنوان</label>
                            <input type="text" name="address"value="{{$trader->address}}" class="form-control @error('address') border-danger @enderror" id="inputAddress" placeholder="(اختياري)">
                            @error('address')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone">رقم التليفون</label>
                            <input type="text" name="phone" value="{{$trader->phone}}" class="form-control @error('phone') border-danger @enderror" id="inputPhone" placeholder="(اختياري)">
                            @error('phone')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputPhone"> نوع المعاملة</label>
                            <select name="type" class="form-control @error('type') border-danger @enderror" id="traderType" >
                                <option value="">(إجباري)</option>
                                <option value="pont" {{$trader->type == "pont" ? "selected" : ""}}>بالبنط</option>
                                <option value="kilo" {{$trader->type == "kilo" ? "selected" : ""}} >بالكيلو</option>
                                <option value="kilo_and_pont" {{$trader->type == "kilo_and_pont" ? "selected" : ""}}>بالكيلو وبالبنط معاً</option>
                            </select>
                            @error('type')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div id="pont1" style="display: {{$trader->type == 'pont' || $trader->type == 'kilo_and_pont' ? 'block;' : 'none;'}}" class="form-group">
                            <label for="inputSal"> سعر بنط اللبن البقري</label>
                            <input type="number" step=".01" name="cow_pont_price" value="{{$trader->cow_pont_price}}" class="form-control @error('cow_pont_price') border-danger @enderror" id="inputSal" placeholder="(إجباري)">
                            @error('cow_pont_price')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div id="pont2" style="display: {{$trader->type == 'pont' || $trader->type == 'kilo_and_pont' ? 'block;' : 'none;'}}" class="form-group">
                            <label for="inputSal"> سعر بنط اللبن الجاموسي</label>
                            <input type="number" step=".01" name="buffalo_pont_price" value="{{$trader->buffalo_pont_price}}" class="form-control @error('buffalo_pont_price') border-danger @enderror" id="inputSal" placeholder="(إجباري)">
                            @error('buffalo_pont_price')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div id="kilo1" style="display: {{$trader->type == 'kilo' || $trader->type == 'kilo_and_pont' ? 'block;' : 'none;'}}" class="form-group">
                            <label for="inputSal"> سعر كيلو اللبن البقري</label>
                            <input type="number" step=".01" name="cow_kilo_price" value="{{$trader->cow_kilo_price}}" class="form-control @error('cow_kilo_price') border-danger @enderror" id="inputSal" placeholder="(إجباري)">
                            @error('cow_kilo_price')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div id="kilo2" style="display: {{$trader->type == 'kilo' || $trader->type == 'kilo_and_pont' ? 'block;' : 'none;'}}" class="form-group">
                            <label for="inputSal"> سعر كيلو اللبن الجاموسي</label>
                            <input type="number" step=".01" name="buffalo_kilo_price" value="{{$trader->buffalo_kilo_price}}" class="form-control @error('buffalo_kilo_price') border-danger @enderror" id="inputSal" placeholder="(إجباري)">
                            @error('buffalo_kilo_price')
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
    @push('scripts')
    <script>
   var traderType = jQuery("#traderType");
   var select = this.value;
   traderType.change(function(){
    if($(this).val() == ''){
        $("#kilo1").hide();
        $("#kilo2").hide();
        $("#pont1").hide();
        $("#pont2").hide();
    }
    if($(this).val() == 'pont'){
        $("#pont1").show();
        $("#pont2").show();
        $("#kilo1 :input").val("");
        $("#kilo1").hide();
        $("#kilo2 :input").val("");
        $("#kilo2").hide();
    }
    if($(this).val() == 'kilo'){
        $("#kilo1").show();
        $("#kilo2").show();
        $("#pont1 :input").val("");
        $("#pont1").hide();
        $("#pont2 :input").val("");
        $("#pont2").hide();
    }
    if($(this).val() == 'kilo_and_pont'){
        $("#kilo1").show();
        $("#kilo2").show();
        $("#pont1").show();
        $("#pont2").show();
    }
   })

    </script>
    @endpush