@extends('layouts.app')
@section('title', 'User Edit')
@section('content')
    <div class="pagetitle">
        <h1>User Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('user') }}">User</a></li>
            </ol>
            @if(session('message'))
                <small class="text-success mb-0 ml-3 "> {{ session('message') }} </small>
            @endif
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit User</h5>

                        <form action="{{ route('user.update', ['id' => $user->id]) }}" method="POST" novalidate
                            enctype="multipart/form-data" class="needs-validation">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" style="font-weight: 700">Name:</label>
                                    <input type="text" name="name"
                                        class="@error('name') is-invalid @enderror form-control py-1" required
                                        value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="username" style="font-weight: 700">User Name:</label>
                                    <input type="username" name="username"
                                        class="@error('username') is-invalid @enderror form-control py-1" required
                                        value="{{ $user->username }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="role" style="font-weight: 700">User Role</label>
                                    <select class="form-select" aria-label="Default select example" @error('role') is-invalid @enderror name="role" required>
                                        <option value="">Choose User Role</option>
                                        <option value="admin" @if($user->role == "admin")selected @endif>Admin</option>
                                        <option value="employee" @if($user->role == "employee")selected @endif>Employee</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="password" style="font-weight: 700">Password:</label>
                                    <input type="password" name="password"
                                        class="@error('password') is-invalid @enderror form-control py-1">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row my-3">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                    </div>

                    </form>


                </div>
            </div>

        </div>
        </div>
    </section>
    <script>
        $('#summernote').summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 2,
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
            ]
        });
    </script>
    <script>
        profile_img.onchange = evt => {
            const [file] = profile_img.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>

@endsection
