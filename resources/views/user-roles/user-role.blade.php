@extends('admin.include.main')
@section('title', 'User Role')
@section('content')
<div class="content-wrapper">
    <div class="row">
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">User with their roles</h4>
            <p class="card-description">
              Here, Your User<code>Role</code> & <code>Permissions</code>
            </p>
            {{-- <a href="" class="btn btn-primary btn-sm float-right">Create</a> --}}
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($data as $count => $user)
                    <tr>
                        <td>{{$count+1}}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>
                            @if(count($user['roles']) > 0)
                                @foreach($user['roles'] as $role)
                                    <span class="badge rounded-pill bg-secondary">{{ $role['name'] }}</span>
                                @endforeach
                            @else
                                No Roles Assigned
                            @endif
                        </td>
                        <td>
                            @if(count($user['permissions']) > 0)
                                @foreach($user['permissions'] as $permission)
                                    {{ $permission['name'] }}<br>
                                @endforeach
                            @else
                                No Permissions
                            @endif
                        </td>
                        <td>
                            <a href="{{route('getAssignRole', $user->id)}}" class="btn btn-primary btn-sm">Assign Role</a>
                            <a href="{{route('getGiveAccess', $user->id)}}" class="btn btn-success btn-sm">Give Access</a>
                            <a href="{{route('removeAccess', $user->id)}}" class="btn btn-danger btn-sm">Revoke Access</a>
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