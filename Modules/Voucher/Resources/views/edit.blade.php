@extends('layouts.app')


@section('cssfile')
    <link href="{{ asset('datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ url('/admin/voucher/index') }}">Voucher</a></li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Edit Voucher
            </div>
            <div class="card-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

                <form class="horizontal-form" method="post" action="{{ url('/admin/voucher/update') }}/{{$voucher->id}}" enctype="multipart/form-data">                    
                <input type="hidden" name="_method" value="PUT">

                    <div class="row">
                        <div class="col-6">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $voucher->name }}"/>
                            </div>
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" class="form-control" value="{{ $voucher->code }}"/>
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="number" name="discount" class="form-control" value="{{ $voucher->discount }}"/>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <br>
                                <label class="radio"><input type="radio" value="1" {{ $voucher->status == 1?'checked': ''}} name="status">Active</label>
                                &nbsp;&nbsp;
                                <label class="radio"><input type="radio" value="0" {{ $voucher->status == 0?'checked': '' }} name="status">Not Active</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Max Claim</label>
                                <input type="number" name="max_claim" class="form-control" value="{{ $voucher->max_claim }}">
                            </div>
                            <div class="form-group">
                                <label>Valid From</label>
                                <input type="text" name="start_date" class="datepicker form-control" value="{{ $voucher->start_date }}">
                            </div>
                            <div class="form-group">
                                <label>Valid Until</label>
                                <input type="text" name="end_date" class="datepicker form-control" value="{{ $voucher->end_date }}">
                            </div>
                            
                            
                        </div>
                    </div>     
                    <hr>
                    <div class="row justify-content-end">
                        <div class="col-4">
                      
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            &nbsp;  &nbsp;      
                            <button type="button" onClick="location.href= '{{ url('/admin/voucher/index')}}'" class="btn float-right" style="margin-right:20px">Cancel</button>
                       
                        </div>
                    </div>
                 
                </form>
                </div>
            </div>
            
        </div>
    </div>


@endsection

@section('scriptfile')
    <script src="{{ asset('datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script>
        $(function(){
            $(".datepicker").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $('[name="code"]').keyup(function(){
                this.value = this.value.toUpperCase();
            });
        })
    </script>
@endsection
