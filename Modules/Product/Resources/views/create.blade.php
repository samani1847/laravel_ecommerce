@extends('layouts.app')


@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active"><a href="{{ url('/admin/product/index') }}">Product</a></li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Add Product
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

                <form class="horizontal-form" method="post" action="{{ url('/admin/product/store') }}" enctype="multipart/form-data">                    
                    <div class="row">
                        <div class="col-6">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" row="3" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Image</label>
                                <br>
                                <input type="file" name="image" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                            </div>
                            <div class="form-group">
                                <label>Subcategory</label>
                                <select name="subcategory_id" class="form-control">
                                    @foreach ($subcategory as $value)
                                        <option value="{{$value->id}}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Sample File</label>
                                <input type="file" name="sample_file" >
                            </div>
                            
                        </div>
                    </div>     
                    <hr>
                    <div class="row justify-content-end">
                        <div class="col-4">
                      
                            <button type="submit" class="btn btn-primary float-right">Save</button>
                            &nbsp;  &nbsp;      
                            <button type="button" onClick="location.href= '{{ url('/admin/product/index')}}'" class="btn float-right" style="margin-right:20px">Cancel</button>
                       
                        </div>
                    </div>
                 
                </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection

