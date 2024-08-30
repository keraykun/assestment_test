@extends('Ms.app')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('ms.users.index') }}" class="btn btn-success btn-sm">Back</a>
        </div>
        <div class="card-body">
            @if (Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
              </div>
            @endif
            <div class="text-success text-lg text-bold"> CREATE USER</div>
            <form action="{{ route('ms.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-1">
                        <div class="mb-2">
                            <label for="fname" class="form-label">Prefix</label>
                            <select name="prefixname" id=""  class="form-control">
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                                <option value="Ms">Ms</option>
                            </select>
                            @error('prefixname')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="fname" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="fname" name="firstname" placeholder="Enter firstname">
                            </div>
                            @error('firstname')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="mname" class="form-label">Middlename</label>
                                <input type="text" class="form-control" id="mname"  name="middlename" placeholder="Enter middlename">
                            </div>
                            @error('middlename')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="lname" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lname"  name="lastname" placeholder="Enter lastname">
                            </div>
                            @error('lastname')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                        </div>
                        <div class="col-md-2">
                            <div class="mb-2">
                                <label for="suffix" class="form-label">Suffix Name</label>
                                <input type="text" class="form-control" id="suffix"  name="suffixname" placeholder="Enter suffixname">
                            </div>
                            @error('suffixname')
                            <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div class="mb-2">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" name="type" id="type" placeholder="Enter Type">
                        </div>
                        @error('type')
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-2">
                        <div class="mb-2">
                            <label for="email" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username">
                        </div>
                        @error('username')
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                        </div>
                        @error('email')
                        <small class="text-danger fw-bold">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                        </div>
                        @error('password')
                        <small class="text-danger fw-bold">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <div class="mb-2">
                            <label for="cpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="cpassword" name="password_confirmation" placeholder="Enter Confirm Password">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="display: flex;">
                        <div class="my-2" id="displayImage" style="height: 250px; width:250px; background:#ddd;">
                        </div>
                        <div class="m-2">
                            <label class="m-2" for="">Upload Picture</label>
                            <input type="file" accept=".png, .jpeg, .jpg" id="uploadImage" name="picture" class="form-control">
                        </div>
                    </div>
                    <script>
                        document.getElementById('uploadImage').addEventListener('change', function(event) {
                            const file = event.target.files[0];
                            if (file) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    document.getElementById('displayImage').style.backgroundImage = `url(${e.target.result})`;
                                    document.getElementById('displayImage').style.backgroundSize = 'cover';
                                    document.getElementById('displayImage').style.backgroundPosition = 'center';
                                }
                                reader.readAsDataURL(file);
                            }
                        });
                    </script>
                </div>
                <div class="m-2">
                    <input type="submit" class="btn btn-success btn-sm" value="Create">
                </div>
            </form>
        </div>
           {{-- <img src="..." class="" style="height: 500px;"  alt="..."> --}}
    </div>
@endsection

