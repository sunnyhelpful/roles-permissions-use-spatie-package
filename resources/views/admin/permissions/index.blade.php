@extends('admin.include.main')
@section('title', 'All Permissions')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Role With Permission</h4>
            <p class="card-description">
              Here, your<code>Role</code>
            </p>
            <a href="{{route('createPermission')}}" class="btn btn-primary btn-sm float-right">Create</a>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($permissions as $count=>$permission)
                        <tr>
                            <td>
                                {{$count+1}}
                            </td>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                <a href="{{route('editPermission', $permission->id)}}" class="btn btn-success btn-sm">Edit</a>
                                <a href="{{route('deletePermission', $permission->id)}}" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">There is no Data!</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection