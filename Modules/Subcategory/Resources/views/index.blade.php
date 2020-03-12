@extends('layouts.app')

@section('cssfile')
    <link href="{{ asset('datatable/css/datatable.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  @endsection

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Subcategory</li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Subcategory
            </div>
            <div class="card-body">
                
                    <table id="table-Subcategory" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subcategory Name</th>
                                <th>Status</th>
                                <th>Parent Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
            </div>
        </div>
        <div class="modal fade" id="SubcategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Subcategory From</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label>Subcategory Name</label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                        <label>Parent Category</label>
                        <br>
                        <select name="category_id" class="form-control">
                        @foreach ($category as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                        </select>
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
        

            table=$("#table-Subcategory").DataTable({
                buttons: [{
                    text: '<i class="fa fa-plus"></i> Add Subcategory',
                    className: 'btn btn-success green-meadow  add-Subcategory',
                    action: function ( e, dt, node, config ) {
                        addSubcategory();
                    }
                }],      
                ajax:{
                        url: "{{url('/admin/subcategory/data')}}",
                    },
                columns: [
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
        function edit(id, idModal='#SubcategoryModal'){
            $(idModal).modal('show');
            form = $(idModal).find('.form-horizontal'); 
            form[0].reset();
            form.unbind();
            axios.get("{{ url('/admin/subcategory/get') }}"+'/'+id).then(function (response){
                var Subcategory= response.data.data;
                $('input[name="name"]').val(Subcategory.name);
                if(Subcategory.status==1){
                    $('input[name="status"][value="1"]').attr("checked","checked");
                } else {
                    $('input[name="status"][value="0"]').attr("checked","checked");
                }
                $("[name='category_id']").val(Subcategory.category_id);
                form.find()
            }).catch(function (error){
                toastr.clear()
                toastr.error(error.message, "Error saving data");
            });
            
            form.submit(function(e){
                e.preventDefault();
                axios.put("{{ url('/admin/subcategory/update')}}"+'/'+id, form.serialize())
                .then(function (response){
                    toastr.clear();
                   
                    toastr.success('Subcategory saved successfully', 'Success');
                    table.ajax.reload();
                    $(idModal).modal('hide')
                })
                .catch(function (error){
                    console.log(error);
                    toastr.clear()
                    toastr.error(error.message, "Error saving data");
                   
                });
            });
           
        }

        function addSubcategory(){
            var idModal='#SubcategoryModal';
            $(idModal).modal('show');
            
            form = $(idModal).find('.form-horizontal');
            form[0].reset();
            form.unbind();
            form.submit(function(e) {
                e.preventDefault();
                axios.post("{{ url('/admin/subcategory/store') }}", form.serialize()).then(function (response){
                    toastr.clear();
                    toastr.success('Subcategory deleted successfully', 'Success');
                    $(idModal).modal('hide');
                    table.ajax.reload();
                })
                .catch(function (error){
                    toastr.clear();
                    toastr.error(error.message, "Error deleting data");
                })
            })
           
        }

        function deleteCategory(id){
            // var idModal='#SubcategoryModal';
            // $(idModal).modal('show');
            
            // form = $(idModal).find('.form-horizontal');
            // form[0].reset();
            // form.submit(function(e) {
            //     e.preventDefault();
                axios.delete("{{ url('/admin/subcategory/delete') }}"+'/'+id).then(function (response){
                    toastr.clear();
                    toastr.success('Subcategory deleted successfully', 'Success');
                    table.ajax.reload();
                })
                .catch(function (error){
                    toastr.clear();
                    toastr.error(error.message, "Error deleting data");
                })
            // })
           
        }
     
    </script>

@endsection

