@extends('Ms.app')
@section('content')
    <div class="card">
        <div class="card-header">
          <p class="text-danger">User Removed</p>
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
                    <th></th>
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
                        <td style="width: 60px; height:60px;">
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="img-thumbnail" style="height: 100%;" alt="">
                        </td>
                        <td>{{ $user->prefixname }}</td>
                        <td>{{ $user->lastname.' '.$user->firstname.' , '.$user->middlename }}</td>
                        <td>{{ $user->suffixname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            <form method="POST" action="{{ route('ms.trashed.update',$user->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="submit" class="text-white btn btn-success btn-sm" value="Retrieve">
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('ms.trashed.destroy',$user->id) }}">
                            @csrf
                            @method('DELETE')
                            <input type="submit" class="text-white btn btn-danger btn-sm" value="Delete">
                            </form>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection

