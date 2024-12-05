@extends('layout.master')
@push('css')
@endpush
@section('content')
<div  class="breadcrumb-header">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb breadcrumb-style2">
            <li class="breadcrumb-item">
                تقرير شامل
            </li>
            <li class="breadcrumb-item active">
              عرض  تقرير شامل 
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
                    @if(session('success'))
                    <div id="redirectMSG" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
  <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z"/>
</svg>
                        {{session('success')}}
                    </div>
                    @endif
                    <h4 class="card-title mg-b-0">   تقرير شامل عن مدة</h4>
                </div>
                <p class="tx-12 tx-gray-500 mb-2"></p>
                <br>
                <div style="float: left;">
                </div>
                <br><br>
            </div>
                
            <div class="card-body">
                <form action="{{route('generalrebort')}}" method="POST">
                    @csrf
                <div class="row">
                      
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">من</label>
                            <input type="date" id="date" name="from" class="form-control @error('from') border-danger @enderror">
                            @error('from')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="">إلى</label>
                            <input type="date" id="date" name="to" class="form-control @error('to') border-danger @enderror">
                            @error('to')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="from-group">
                            <br>
                        <button class="btn btn-primary" type="submit">  عرض التقرير</button>
                    </div>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
