@extends('layouts.app')


@section('cssfile')
    <link href="{{ asset('datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection
@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ url('/admin/user/index') }}">User</a></li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Edit User
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

                <form class="horizontal-form" method="post" action="{{ url('/admin/user/update') }}/{{$user->id}}" enctype="multipart/form-data">                    
                <input type="hidden" name="_method" value="PUT">
                <div class="row justify-content-between">
                       
                        <div class="col-12">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}"/>
                            </div>
                          
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" value="{{ $user->email }}"/>
                            </div>
                          
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                @foreach ($roles as $key => $role)
                                    <option value="{{$role->name}}" {{ ($user->hasRole($role->name) )?'selected':''}}>{{ $role->name }}</option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="password" class="form-control" value=""/>
                            </div>
                          
                            <div class="form-group">
                                <label>Password Confirmation</label>
                                <input type="text" name="password_confirmation" class="form-control" value=""/>
                            </div>
                          
                        </div>
                          
                        </div>
                    </div>     
                    <br>
                   
                    <hr>
                    <div class="row justify-content-end">
                        <div class="col-4">
                      
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            &nbsp;  &nbsp;      
                            <button type="button" onClick="location.href= '{{ url('/admin/user/index')}}'" class="btn float-right" style="margin-right:20px">Cancel</button>
                       
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
