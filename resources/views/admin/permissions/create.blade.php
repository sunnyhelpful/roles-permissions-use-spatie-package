@extends('admin.include.main')
@section('title', 'Create Permisson')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card"></div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
            <h4 class="card-title">Create A Permission!</h4>
            <p class="card-description">
                Here, We can create a permission!
            </p>
            <form action="{{route('storePermission')}}" class="forms-sample" id="" method="POST">
            @csrf
                <div class="form-group mt-3 mb-3">
                    <label for="Permission"><b>Permssion Name</b></label>
                    <input type="text" class="form-control" name="permission" id="permission" value="{{ old('permission') }}" placeholder="Enter Permission Name" required>
                </div>
                <div class="form-group float-right">
                    <a href="{{route('createPermission')}}" class="btn btn-light">Cancel</a>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card"></div>
    </div>
</div>
@endsection