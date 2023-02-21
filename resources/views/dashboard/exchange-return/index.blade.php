@extends('layouts.app')
@section('title', 'Exchange & Return')
@section('content')
<div class="d-flex align-items-center justify-content-between">
    <div class="pagetitle">
        <h1>Exchange & Return Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item active">Exchange & Return</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href="{{ route('exchange-return.create') }}" class="d-flex align-items-center btn btn-primary">
        <i class="bi bi-plus-lg"></i>Add
    </a>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Exchange & Return</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover datatable" id="productTable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Voucher</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Extra Charges</th>
                                    <th scope="col">Final Amount</th>
                                    <th scope="col">CREATED AT</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $index = 1;
                                @endphp
                                @foreach ($exchange_return as $ereturn)
                                    <tr>
                                        <th scope="row"><a href="#">{{ $index++ }}</a></th>
                                       
                                      
                                       <td>{{$ereturn->pos->voucher_no}}</td>
                                       <td>{{$ereturn->pos->customer->name}}</td>
                                       <td>{{$ereturn->type}}</td>
                                       <td>{{$ereturn->extra_charges}}</td>
                                       <td>{{$ereturn->final_amount}}</td>
            
                                        <td>{{ \Carbon\Carbon::create($ereturn->created_at)->toFormattedDateString() }}
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="edit-btn">
                                                    <a href="{{ route('exchange-return.edit', ['id' => $ereturn->id]) }}"
                                                        class="px-2">
                                                        <i class="bi bi-pencil-square"></i>
                                                        <span style="padding-left: 4px">Edit</span>
                                                    </a>
                                                </div>
                                                {{-- <form action="{{ route('exchange-return.delete', ['id' => $product->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="delete-btn mx-2  delete">
                                                        <i class="bi bi-trash"></i>
                                                        <span style="padding-left: 4px">Delete</span>
                                                    </button>
                                                </form> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
@endsection