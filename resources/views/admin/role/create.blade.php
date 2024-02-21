@extends('admin.include.main')
@section('title', 'Create Role')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card"></div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
            <h4 class="card-title">Create A Role!</h4>
            <p class="card-description">
                Here, We can create a role!
            </p>
            <form action="{{route('storeRole')}}" class="forms-sample" id="" method="POST">
            @csrf
                <div class="form-group">
                    <label for="Role"><b>Role Name</b></label>
                    <input type="text" class="form-control" name="role" id="role" value="{{ old('role') }}" placeholder="Enter Role Name" required>
                </div>
                <div class="form-group">
                    <label for="permissions"><strong>Add Permissions</strong></label>
                    @foreach ($permissions as $permission)
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" value="{{ $permission->name }}" name="permissions[]">{{ $permission->name }}
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group float-right">
                    <a href="{{route('createRole')}}" class="btn btn-light">Cancel</a>
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