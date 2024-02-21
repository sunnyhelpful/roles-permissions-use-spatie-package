@extends('admin.include.main')
@section('title', 'All Role')
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
          <a href="{{route('createRole')}}" class="btn btn-primary btn-sm float-right">Create</a>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Sl. No.</th>
                  <th>Roles</th>
                  <th>Permissions</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($roles as $count => $role)
                  <tr>
                      <td>{{ $count + 1 }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                          @if (count($role->permissions) > 0)  
                              @foreach ($role->permissions as $permission)
                                  {{ $permission->name }}<br>
                              @endforeach
                          @else
                              No permissions
                          @endif
                      </td>
                      <td>
                          <a href="{{route('editRole', $role->id)}}" class="btn btn-success btn-sm">Edit</a>
                          <a href="{{route('deleteRole', $role->id)}}" class="btn btn-danger btn-sm">Delete</a>
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