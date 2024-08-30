<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Assestment</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-5">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link active d-flex" style="gap:10px;" href="#">Hello  <span class="mr-3 ">
                        <b>{{ auth()->user()->prefixname.' '.auth()->user()->lastname.' '.auth()->user()->firstname.' '.auth()->user()->middlename }} </b></span>
                        <div style="width: 50px; height:50px; border-radius:100px;">
                            <img src="{{ asset('storage/' . auth()->user()->avatar) }}" class="img-thumbnail" style="height: 100%;" alt="">
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="nav-link" value="Sign Out">
                    </form>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container-fluid my-5 px-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ route('ms.users.index') }}">Active User</a></li>
              <li class="breadcrumb-item"><a href="{{ route('ms.trashed.index') }}">Removed User</a></li>
            </ol>
          </nav>
        @yield('content')
    </div>
</body>
</html>
