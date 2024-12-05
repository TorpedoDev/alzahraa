@extends("layout.master")
@section("content")
<div class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                مبيعات البيت
            </li>
            <li class="breadcrumb-item active">
تعديل مبيعات             
</li>
        </ol>
    </nav>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
            <div class="card  box-shadow-0">
                <div class="card-header">
                    <h4 class="card-title mb-1">تعديل مبيعات </h4>
                    <p class="mb-2">قم بتعديل البيانات الآتية لتعديل المبيعات  </p>
                </div>
                <div class="card-body pt-0">
                    <form method="POST" action="{{route('homesale.update' , $homeSale->id)}}">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <label for="inputAddress"> اسم المنتج</label>
                            <select name="product" class="form-control @error('product') border-danger @enderror">
                                <option value="">(إجباري)</option>
                                <option value="buff_milk" {{$homeSale->product == 'buff_milk' ? 'selected' : ''}}>لبن جاموسي</option>
                                <option value="cow_milk" {{$homeSale->product == 'cow_milk' ? 'selected' : ''}}>لبن بقري</option>
                                <option value="other" {{$homeSale->product == 'other' ? 'selected' : ''}}>منتج آخر</option>
                            </select>
                            @error('product')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress"> الكمية</label>
                            <input type="number" step=".01" class="form-control @error('quantity') border-danger @enderror" name="quantity" value="{{$homeSale->quantity}}">
                            @error('quantity')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress"> السعر</label>
                            <input type="number" step=".01" class="form-control @error('price') border-danger @enderror" name="price" value="{{$homeSale->price}}">
                            @error('price')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>

                        <div class="form-group">
                            <label for="inputAddress"> التاريخ</label>
                            <input type="date" id="date" class="form-control @error('date') border-danger @enderror" name="date" value="{{$homeSale->date}}">
                            @error('date')
                         <p class="text-danger">{{$message}}</p>
                         @enderror
                        </div>
                    
                        <div class="form-group mb-0 mt-3 justify-content-end">
                            <div>
                                <button type="submit" class="btn btn-primary"> تعديل</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection