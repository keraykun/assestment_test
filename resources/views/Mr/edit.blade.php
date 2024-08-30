@extends('Mr.app')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('mr.users.index') }}" class="btn btn-success btn-sm">Back</a>
                </div>
                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                      </div>
                    @endif
                    <div class="text-success text-lg text-bold"> UPDATE USER PROFILE</div>
                    <form action="{{ route('mr.users.update',$user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-2">
                                    <label for="fname" class="form-label">Prefix</label>
                                    <select name="prefixname" id=""  class="form-control">
                                        <option value="Mr" {{ $user->prefixname == 'Mr' ? 'selected' : '' }}>Mr</option>
                                        <option value="Mrs" {{ $user->prefixname == 'Mrs' ? 'selected' : '' }}>Mrs</option>
                                        <option value="Ms" {{ $user->prefixname == 'Ms' ? 'selected' : '' }}>Ms</option>
                                    </select>
                                    @error('prefixname')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="fname" class="form-label">Firstname</label>
                                        <input type="text" class="form-control" id="fname" name="firstname" value="{{ $user->firstname }}">
                                    </div>
                                    @error('firstname')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="mname" class="form-label">Middlename</label>
                                        <input type="text" class="form-control" id="mname"  name="middlename" value="{{ $user->middlename }}">
                                    </div>
                                    @error('middlename')
                                        <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="lname" class="form-label">Lastname</label>
                                        <input type="text" class="form-control" id="lname"  name="lastname" value="{{ $user->lastname }}">
                                    </div>
                                    @error('lastname')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="suffix" class="form-label">Suffix Name</label>
                                        <input type="text" class="form-control" id="suffix"  name="suffixname" value="{{ $user->suffixname }}">
                                    </div>
                                    @error('suffixname')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-2">
                                        <label for="type" class="form-label">Type</label>
                                        <input type="text" class="form-control" name="type" id="type" value="{{ $user->type }}">
                                    </div>
                                    @error('type')
                                    <small class="text-danger fw-bold">{{ $message }}</small>
                                    @enderror
                                </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6" style="display: flex;">
                               @if ($user->photo===null)
                               <div class="my-2" id="displayImage" style="height: 250px; width:250px; background:#ddd;">
                                    <div id="hiddenImage"></div>
                                </div>
                               @else
                               <div class="my-2" id="displayImage" style="height: 250px; width:250px;">
                                <img class="img-thumbnail" id="hiddenImage" style="height: 250px; width:250px;" src="{{ asset('storage/' . $user->avatar) }}">
                                 </div>
                               @endif
                                <div class="m-2">
                                    <label class="m-2" for="">Upload Picture</label>
                                    <input type="file" accept=".png, .jpeg, .jpg" id="uploadImage" name="picture" class="form-control">
                                </div>
                            </div>
                            <script>
                                document.getElementById('uploadImage').addEventListener('change', function(event) {
                                    const file = event.target.files[0];
                                    if (file) {
                                        let hideImg = document.getElementById('hiddenImage')
                                        const reader = new FileReader();
                                        reader.onload = function(e) {
                                            hideImg.style.display='none'
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
                            <input type="submit" class="btn btn-success btn-sm" value="Update Profile">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="text-success text-lg text-bold"> UPDATE USER PASSWORD</div>
                </div>
                <div class="card-body">
                    <form action="{{ route('password.update',$user->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="email" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}">
                                </div>
                                @error('username')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" readonly class="form-control" id="email" name="email" value="{{ $user->email }}">
                                </div>
                                @error('email')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                            @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="password" class="form-label">Old Password</label>
                                    <input type="password" class="form-control" id="password" name="old_password" placeholder="Enter Old password">
                                </div>
                                @error('old_password')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                </div>
                                @error('password')
                                <small class="text-danger fw-bold">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <div class="mb-2">
                                    <label for="cpassword" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="cpassword" name="password_confirmation" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                            <div class="m-2">
                                <input type="submit" class="btn btn-success btn-sm" value="Update Password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

