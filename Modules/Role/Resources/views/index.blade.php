@extends('layouts.app')

@section('cssfile')
    <link href="{{ asset('datatable/css/datatable.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Role</li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Role
            </div>
            <div class="card-body">
                
                    <table id="table-Role" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Permission</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                    </table>
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
        

            table=$("#table-Role").DataTable({
                buttons: [{
                    text: '<i class="fa fa-plus"></i> Add Role',
                    className: 'btn btn-success green-meadow  add-Role',
                    action: function ( e, dt, node, config ) {
                        window.location = "{{ url('/admin/role/create')}}";
                    }
                }],      
                ajax:{
                        url: "{{url('/admin/role/data')}}",
                        type: 'post',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        }
                    },
                columns: [
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
   

        function deleteRole(id){
         var confirmdel = confirm('Are you sure');
         if(confirmdel){
            axios.delete("{{ url('/admin/role/delete') }}"+'/'+id).then(function (response){
                toastr.clear();
                console.log(response);
                toastr.success(response.data.message, 'Success');
                table.ajax.reload();
            })
            .catch(function (error){
                toastr.clear();
                toastr.error(error.response.message, "Error deleting data");
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
    @elseif ($message = Session::get('error'))
        <script>
            $(function(){
                toastr.clear();
                toastr.error('{{$message}}', 'Error');
            })
        </script>
    @endif
     
@endsection
