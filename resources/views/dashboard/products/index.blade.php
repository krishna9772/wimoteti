@extends('layouts.app')
@section('title', 'Product')
@section('content')
<style>
    /* The Modal (background) */
#myModal1 {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 60px;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */ 
  background-color: rgba(90,90,85,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
#modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}
 
@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #bbb;
  font-size: 40px;
  font-weight: bold;
  
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Product Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <a href="{{ route('product.create') }}" class="d-flex align-items-center btn btn-primary">
            <i class="bi bi-plus-lg"></i>Add
        </a>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Product List </h5>
                            <select name="" id="" class="w-25 mt-3" style="height: 40px;" onchange="window.location.href=this.value;">
                                <option value="{{url('/auth/product')}}" {{ request()->routeIs('product') ? '' : 'selected' }}>Product In</option>
                                <option value="{{url('/auth/product?type=out')}}" @if(Request::get('type') == 'out') selected @endif>Product Out</option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable" id="productTable">
                                
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">CODE</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Total Price</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $index++ }}</a></th>
                                           
                                            {{-- <td><img src="{{ asset($product->image ? $product->image : 'assets/img/images.jpg') }}"
                                                alt="" width="60px" height="60px">
                                            </td> --}}
                                            
                                            <td><img src="{{ asset("storage/".$product->image) }}"
                                                alt="" width="60px" height="60px" onclick="clickImage(this)">
                                            </td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product->getcategory->name }}</td>
                                            <td>{{ number_format($product->total_price) }}</td>
                                            {{-- <td>{{ $product->type }}</td> --}}
                                            <td>{{ \Carbon\Carbon::create($product->created_at)->toFormattedDateString() }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="edit-btn">
                                                        <a href="{{ route('product.edit', ['id' => $product->id]) }}"
                                                            class="px-2">
                                                            <i class="bi bi-pencil-square"></i>
                                                            <span style="padding-left: 4px">Edit</span>
                                                        </a>
                                                    </div>
                                                    <form action="{{ route('product.delete', ['id' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="submit" class="delete-btn mx-2  delete">
                                                            <i class="bi bi-trash"></i>
                                                            <span style="padding-left: 4px">Delete</span>
                                                        </button>
                                                    </form>
                                                    <div class="edit-btn">
                                                        <a href="{{ route('product.detail', ['id' => $product->id]) }}"
                                                            class="px-2">
                                                            <i class="bi bi-info-square"></i>
                                                            <span style="padding-left: 4px">Detail</span>
                                                        </a>
                                                    </div>
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
        <div id="myModal1" class="modal">
            <span class="close" id="close">&times;</span>
            <img class="modal-content" id="modal-content">
           
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
        function clickImage(img) {
     
     var modal = document.getElementById("myModal1");  
     var modalImg = document.getElementById("modal-content");
     modal.style.display = "block";
     modalImg.src = img.src;
    
 }
 var span = document.getElementById('close');
    span.onclick = function() { 
        $('#myModal1').css({'display': 'none'});

    };





    </script>

@endsection
