@extends('layouts.app')
@section('title', 'Pos')
@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Pos Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Pos</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <a href="{{ route('pos.create') }}" class="d-flex align-items-center btn btn-primary">
            <i class="bi bi-plus-lg"></i>Add
        </a>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Pos List </h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable" id="productTable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Voucher</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Discount</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Payment Status</th>
                                        <th scope="col">ACTION</th>
                                        <th scope="col">CREATED AT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($pos as $item)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $index++ }}</a></th>
                                            <td>{{ $item->voucher_no }}</td>
                                            <td>{{ $item->customer->name }}</td>
                                            <td>{{ $item->discount }}</td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>{{ $item->payment_status }}</td>
                    
                                            
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="print-btn">
                                                        <a href="{{ route('pos.voucher', ['id' => $item->id]) }}"
                                                            class="px-2 btn btn-primary">
                                                            {{-- <i class="bi bi-pencil-square"></i> --}}
                                                            <span style="padding-left: 4px">Print</span>
                                                        </a>
                                                    </div>
                                                    {{-- <form action="{{ route('product.delete', ['id' => $product->id]) }}"
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
                                            <td>{{ \Carbon\Carbon::create($item->created_at)->toFormattedDateString() }}</td>
                                            
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
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $('#productTable').on('click', 'button.delete', function(e) {
                // console.log(e);
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete record",
                    icon: 'warning',
                    showCancelButton: true,
                    timer: 4000,
                    timerProgressBar: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(e.target).closest('form').submit() // Post the surrounding form
                    }
                })
            });
        });
    </script>

@endsection