@extends('layouts.app')
@section('title', 'Customer Edit')
@section('content')
    <div class="pagetitle">
        <h1>Customer Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('customer') }}">Customer</a></li>
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
                        <h5 class="card-title">Create Customer</h5>

                        <form action="{{ route('customer.store') }}" method="POST" novalidate
                            enctype="multipart/form-data" class="needs-validation">
                            @csrf
                           
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" style="font-weight: 700">Name:</label>
                                    <input type="text" name="name"
                                        class="@error('name') is-invalid @enderror form-control py-1" required >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ph_no" style="font-weight: 700">Phone Number</label>
                                    <input type="text" name="ph_no"
                                        class="@error('ph_no') is-invalid @enderror form-control py-1" required
                                        >
                                    @error('ph_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="address" style="font-weight: 700">Address:</label>
                                    {{-- <input type="text" name="address"
                                        class="@error('address') is-invalid @enderror form-control py-1" required
                                        > --}}
                                    <textarea name="address" id="" cols="30" rows="5" class="@error('address') is-invalid @enderror form-control py-1" required></textarea>
                                    @error('address')
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
    

@endsection
