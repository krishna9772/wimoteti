@extends('layouts.app')
@section('title', 'Category Create')
@section('content')
    <div class="pagetitle">
        <h1>Category Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category') }}">Category</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Category</h5>

                        <form action="{{ route('category.store') }}" method="POST" novalidate
                            class="needs-validation">
                            @csrf
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" style="font-weight: 700">Name:</label>
                                    <input type="name" name="name"
                                        class="@error('name') is-invalid @enderror form-control py-1" required
                                        value="{{ old('name') }}">
                                    @error('name')
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
                        </form>


                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection
