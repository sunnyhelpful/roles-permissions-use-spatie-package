@extends('admin.include.main')
@section('title', 'Assign User Role')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-3 grid-margin stretch-card"></div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
            <h4 class="card-title">Assign A User Role!</h4>
            <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-4 mt-2" style="float: right;">back</a>
            <p class="card-description">
                Here, You can assign user <code>role</code>!
            </p>
            <form action="{{route('storeAssignRole',  ['id' => $user->id])}}" class="forms-sample" id="" method="POST">
            @csrf
                <div class="form-group">
                    <label for="username"><b>Username</b></label>
                    <input type="text" class="form-control" value="{{ $user->name }}" id="username" disabled>
                </div>
                <div class="form-group">
                    <label for="permissions"><strong>Select Role</strong></label>
                    @foreach($roles as $role)
                        <div class="form-check form-check-primary">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" value="{{ $role->id }}" name="roles[]" id="flexCheckDefault"
                                @if ($index < count($user_roles)) 
                                    @if ($user_roles[$index] == $role->name)
                                        checked
                                        {{ $index++ }} 
                                    @endif
                                @endif>
                                {{ $role->name }}
                                <i class="input-helper"></i>
                            </label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group float-right">
                    {{-- <a href="{{route('createRole')}}" class="btn btn-light">Cancel</a> --}}
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