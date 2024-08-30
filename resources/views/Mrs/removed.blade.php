@extends('Mrs.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mrs.users.create') }}" class="btn btn-success btn-sm">New User</a>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
              </div>
            @elseif (Session::has('danger'))
            <div class="alert alert-danger" role="alert">
                {{ Session::get('danger') }}
              </div>
            @endif
            <div class="text-success text-lg text-bold"> ALL USERS</div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Prefixname</th>
                    <th scope="col">Fullname</th>
                    <th scope="col">Suffixname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Username</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->prefixname }}</td>
                        <td>{{ $user->lastname.' '.$user->firstname.' , '.$user->middlename }}</td>
                        <td>{{ $user->suffixname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <a href="{{ route('mrs.users.edit',$user->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('mrs.users.destroy',$user->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="text-white btn btn-danger btn-sm" value="Remove">
                            </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection

