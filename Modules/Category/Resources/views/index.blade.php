@extends('layouts.app')

@section('content')

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Category</li>
      </ol>

        <div class="card mb-3">
            <div class="card-header">
                Category
            </div>
            <div class="card-body">
                <button class="btn btn-success" id="add-category" onClick="addCategory()">Add Category</button>
                <div class="table-responsive">
                    <table id="table-category" class="table table-bordered table-hover table-stripped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Category From</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="post" action="">
                        <div class="form-group">
                            <label>Category Name</label>
                            <input type="text" name="name" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="checkbox" name="status" value="1"/>
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
