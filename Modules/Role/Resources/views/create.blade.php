@extends('layouts.app')

@section('cssfile')
    <link href="{{ asset('datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ url('/admin/role/index') }}">Roles</a></li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Add Role
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

                <form class="horizontal-form" method="post" action="{{ url('/admin/role/store') }}" enctype="multipart/form-data">                    
                    <div class="row justify-content-between">
                        <div class="col-5">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            </div>
                          
                        </div>
                    </div>     
                    <hr>
                    <h4>Permission</h4>
                    
                    <div class="row justify-content-end">
                        <div class="col-12">          
                            @foreach ($permissions as $key => $permission)         
                            <div class="form-check">
                                <label class="form-check-label">
                                <input value="{{ $permission->name }}" name="permission[{{$key}}]" type="checkbox" class="form-check-input">
                                    {{ $permission->name }}
                                </label>
                            </div>                   
                            @endforeach
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-4">
                      
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            &nbsp;  &nbsp;      
                            <button type="button" onClick="location.href= '{{ url('/admin/role/index')}}'" class="btn float-right" style="margin-right:20px">Cancel</button>
                       
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
