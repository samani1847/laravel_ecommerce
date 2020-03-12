@extends('layouts.app')

@section('cssfile')
    <link href="{{ asset('datatable/css/datatable.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Product</li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Product
            </div>
            <div class="card-body">
                
                    <table id="table-Product" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Subcategory Name</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
        <div class="modal fade" id="ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product From</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label>Product Name</label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                      
                        <div class="form-group">
                            <label>Status</label>
                            <br>
                            <label class="radio"><input type="radio" value="1" name="status">Active</label>
                            &nbsp;&nbsp;
                            <label class="radio"><input type="radio" value="0" name="status">Not Active</label>
                        
                        </div>
                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        
@endsection

@section('scriptfile')
    <script src="{{ asset('datatable/js/datatable.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatable.bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatable.button.min.js') }}"></script>
    <script src="{{ asset('datatable/js/datatable.buttonbootstrap.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script>
        var table;
        $(function(){
        

            table=$("#table-Product").DataTable({
                buttons: [{
                    text: '<i class="fa fa-plus"></i> Add Product',
                    className: 'btn btn-success green-meadow  add-Product',
                    action: function ( e, dt, node, config ) {
                        window.location = "{{ url('/admin/product/create')}}";
                    }
                }],      
                ajax:{
                        url: "{{url('/admin/product/data')}}",
                    },
                columns: [
                    null,
                    null,
                    null,
                    null,
                    null,
                    { "orderable": false }
                ] ,
                processing: true,
                serverSide: true,
                pagingType: "full_numbers",
                paging: true,
                dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                        "<'row'<'col-sm-12'tr>>" +
                        "<'row'<'col-sm-4'l>'<'col-sm-4'i><'col-sm-4'p>>",
                
            });


        })
   

        function deleteCategory(id){
         var confirmdel = confirm('Are you sure');
         if(confirmdel){
            axios.delete("{{ url('/admin/product/delete') }}"+'/'+id).then(function (response){
                toastr.clear();
                console.log(response);
                toastr.success(response.data.message, 'Success');
                table.ajax.reload();
            })
            .catch(function (error){
                toastr.clear();
                toastr.error(error.message, "Error deleting data");
            })
         }
         
        }
     
    </script>
    @if ($message = Session::get('success'))
        <script>
            $(function(){
                toastr.clear();
                toastr.success('{{$message}}', 'Success');
            })
        </script>
    @endif
     
@endsection

