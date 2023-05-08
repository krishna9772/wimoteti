@extends('layouts.app')
@section('title', 'Product Detail')
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
        <h1>Product Detail Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product.detail',$product->id) }}">Detail</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-lg-12">
                                {{-- <img id="blah" src="{{ asset("storage/".$product->image ? "storage/".$product->image : 'assets/img/images.jpg') }}"
                                class="rounded shadow-sm p-1"
                                style="transition: 0.4s; height: 100px; width: 100px" /> --}}
                                @php
                                    $images = array_filter(explode("~%",$product->image));
                                @endphp

                                @foreach($images as $img)
                                    
                                    <img src="{{ asset("storage/".$img) }}"
                                    alt="" width="60px" height="60px" onclick="clickImage(this)">
                                @endforeach
                              
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6">
                                <table class="table table-striped border">
                                    <tr>
                                        <th scope="row">Code</th>
                                        <td>{{$product->code}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Cateogry</th>
                                        <td>{{$product->getCategory->name}}</td>
                                    </tr>
                                    
                                    <tr>
                                        <th scope="row">Gold Quantity</th>
                                        <td>{{$product->gold_quantity_p}}.{{$product->gold_quantity_y}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gold Price</th>
                                        <td>{{number_format($product->gold_price)}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">AD Gold Quantity</th>
                                        <td>{{$product->ad_gold_quantity_p}}.{{$product->ad_gold_quantity_y}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">AD Gold Price</th>
                                        <td>{{number_format($product->ad_gold_price)}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Net weight</th>
                                        <td>{{$product->net_weight ? $product->net_weight : '-'}} g</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Service Charges</th>
                                        <td>{{$product->service_charges}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Price</th>
                                        <td>{{number_format($product->total_price)}}</td>
                                    </tr>
                                </table>
                                    
                            </div>
                            <div class="col-lg-4">
                                @php
                                    $gem_weight = json_decode($product->weight);
                                    $gem_type = json_decode($product->gem_type);
                                    $gem_quantity = json_decode($product->quantity);
                                    $weight_type = json_decode($product->weight_type);
                                    $gem_price = json_decode($product->price);
                                @endphp
                                <table class="table table-striped border">
                                    <th scope="row">Type</th>
                                    <th scope="row">Quantity</th>
                                    <th scope="row">Weight</th>
                                    <th scope="row">Price</th>
                                    

                                @if(gettype($gem_type) == 'array')
                                    @for($i = 0 ; $i < count($gem_type); $i++)
                                    <tr>

                                            <td>{{$gem_type[$i]}}</td>
                                       
                                            <td>{{$gem_quantity[$i]}}</td>
                                       
                                            <td>{{$gem_weight[$i]}} @if($gem_weight[$i] == 1) Carat  @else Ratti @endif</td>
                                        
                                            <td>{{number_format($gem_price[$i])}}</td>
                                        </tr>

                                    @endfor
                                @else
                                    <tr>
                                        <td>
                                            {{$product->gem_type}}
                                        </td>
                                        <td>
                                            {{$product->quantity}}
                                        </td>
                                        <td>
                                            {{$product->weight}}
                                        </td>
                                        <td>
                                            {{$product->price}}
                                        </td>
                                    </tr>
                                @endif
                            </div>
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