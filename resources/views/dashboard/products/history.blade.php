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
<div class="pagetitle">
    <h1>Product History Page</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
            <li class="breadcrumb-item">History</li>
        </ol>
    </nav>
</div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">         
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable" id="productTable">               
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Gems</th>
                                        <th scope="col">Gold</th>
                                        <th scope="col">Price</th>        
                                        <th scope="col">Status</th>                               
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = 1;
                                    @endphp
                                    @foreach ($products as $product)
                                        <tr>
                                            <th scope="row"><a href="#">{{ $index++ }}</a></th>
                                            <td><img src="{{ asset("storage/".explode("~%",  $product->image)[0]) }}"
                                                alt="" width="60px" height="60px" onclick="clickImage(this)">
                                            </td>
                                            <td>{{ \Carbon\Carbon::create($product->created_at)->toFormattedDateString() }}</td>
                                            <td>
                                                <a href="{{route('product.detail',$product->id)}}">   {{ $product->code }}</a></td>
                                            @php
                                                $gem_weight = json_decode( $product->weight);
                                                $gem_type = json_decode( $product->gem_type);
                                                $gem_quantity = json_decode($product->quantity);
                                                $weight_type = json_decode($product->weight_type);
                                            @endphp
                                            @if(gettype($gem_type) == 'array')
                                                <td>
                                                    @for($i = 0 ; $i < count($gem_type); $i++)                                       
                                                        {{$gem_type[$i]}}-{{$gem_weight[$i]}} @if($weight_type != null && $weight_type[$i] == 1) Carat @else Ratti @endif  {{$gem_quantity == null ? ""  : "[".$gem_quantity[$i]."-pcs]"}}
                                                    <br>   
                                                    @endfor
                                                </td>              
                                            @endif
                                            <td> 
                                                @if($product->gold_quantity_k){{$product->gold_quantity_k}} ကျပ် @endif 
                                                @if($product->gold_quantity_p){{$product->gold_quantity_p}} ပဲ @endif
                                                 @if($product->gold_quantity_y){{$product->gold_quantity_y}} ရွေး @endif
                                            </td>
                                            <td>{{ number_format($product->total_price) }}</td>
                                            <td>{{$product->product_in == 0 ? "Sold" :"In Stock"  }}</td>
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
