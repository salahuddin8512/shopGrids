@extends('master.admin.master')

@section('body')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Add Category Form</h3>
                </div>
                <!-- form start -->
                <form class="form-horizontal" action="{{route('new-category')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <p class="text-center text-success">{{Session::get('message')}}</p>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Category Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="inputEmail3" placeholder="Category Name"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Category Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="inputPassword3" name="description" placeholder="Category Description"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Category Image</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control-file" name="image" accept="image/*"/>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer float-right">
                        <button type="submit" class="btn btn-info">Create New Category</button>
                    </div>
                    <!-- /.card-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
