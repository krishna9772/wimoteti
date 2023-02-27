@extends('layouts.app')
@section('title', 'Product Create')
@section('content')
    <div class="pagetitle">
        <h1>Product Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Create Product</h5>

                        <form action="{{ route('product.store') }}" method="POST" novalidate enctype="multipart/form-data"
                            class="needs-validation">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="" id="today_g_price" value="{{gold_price()}}">
                                <div class="col-md-12 mb-3">
                                    <label for="image" style="font-weight: 700">Image:</label><br>
                                    <label for="image">
                                        <div class="form-group" id="image">
                                          
                                        </div>
                                     
                                    </label>
                                    <input accept="image/*" name="image[]"  multiple="multiple" type='file' id="image" class="mx-2" required onchange="previewImageFile(event);"  />
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="code" style="font-weight: 700">Code:</label>
                                    <input type="text" name="code"
                                        class="@error('code') is-invalid @enderror form-control py-1" required
                                        value="{{ old('code') }}">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type" style="font-weight: 700">Category:</label>
                                    <select class="form-select" aria-label="Default select example" name="type">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option name="type" value="{{ $category->id }}">{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gem_type" style="font-weight: 700">Gem type:</label>
                                    <input type="text" name="gem_type"
                                        class="@error('gem_type') is-invalid @enderror form-control py-1" required
                                        value="{{ old('gem_type') }}">
                                    @error('gem_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quantity" style="font-weight: 700">Gem Quantity:</label>
                                    <input type="text" name="quantity" id="quantity"
                                        class="@error('quantity') is-invalid @enderror form-control py-1" required
                                        value="{{ old('quantity') }}">
                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="weight" style="font-weight: 700">Gem weight:</label>
                                    <input type="text" name="weight" id="weight"
                                        class="@error('weight') is-invalid @enderror form-control py-1" required
                                        value="{{ old('weight') }}">
                                    @error('weight')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2 mb-3">
                                    <label for="weight_type" style="font-weight: 700"></label>
                                    <select class="form-select" onchange="calculation()" name="weight_type" id="weight_type" name="weight_type">
                                        <option  name="weight_type" value=1>Carat</option>
                                        <option  name="weight_type" value=2>Ratti</option>
                                    </select>    
                                </div>
                            
                                <div class="col-md-6 mb-3">
                                    <label for="price" style="font-weight: 700">Gem price:</label>
                                    <input type="text" name="price" id="price"
                                        class="@error('price') is-invalid @enderror form-control py-1" required
                                        value="{{ old('price') }}">
                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gold_quantity_p" style="font-weight: 700">Gold Quantity(P):</label>
                                    <input type="text" name="gold_quantity_p" id="gold_quantity_p"
                                        class="@error('gold_quantity_p') is-invalid @enderror form-control py-1" required
                                        value="{{ old('gold_quantity_p') }}">
                                    @error('gold_quantity_p')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="gold_quantity_y" style="font-weight: 700">Gold Quantity(Y):</label>
                                    <input type="text" name="gold_quantity_y" id="gold_quantity_y"
                                        class="@error('gold_quantity_y') is-invalid @enderror form-control py-1" required
                                        value="{{ old('gold_quantity_y') }}">
                                    @error('gold_quantity_y')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="gold_price" style="font-weight: 700">Gold Price:</label>
                                    <input type="text" name="gold_price" id="gold_price"
                                        class="@error('gold_price') is-invalid @enderror form-control py-1" required
                                        value="{{ old('gold_price') }}">
                                    @error('gold_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ad_gold_quantity_p" style="font-weight: 700">AD Gold Quantity(P):</label>
                                    <input type="text" name="ad_gold_quantity_p" id="ad_gold_quantity_p"
                                        class="@error('ad_gold_quantity_p') is-invalid @enderror form-control py-1" 
                                        value="{{ old('ad_gold_quantity_p') }}">
                                    @error('ad_gold_quantity_p')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="ad_gold_quantity_y" style="font-weight: 700">AD Gold Quantity(Y):</label>
                                    <input type="text" name="ad_gold_quantity_y" id="ad_gold_quantity_y"
                                        class="@error('ad_gold_quantity_y') is-invalid @enderror form-control py-1" 
                                        value="{{ old('ad_gold_quantity_y') }}">
                                    @error('ad_gold_quantity_y')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ad_gold_price" style="font-weight: 700">AD Gold Price:</label>
                                    <input type="text" name="ad_gold_price" id="ad_gold_price"
                                        class="@error('ad_gold_price') is-invalid @enderror form-control py-1" required
                                        value="{{ old('ad_gold_price') }}">
                                    @error('ad_gold_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="service_charges" style="font-weight: 700">Service Charges (%):</label>
                                    <input type="text" name="service_charges" id="service_charges"
                                        class="@error('service_charges') is-invalid @enderror form-control py-1" required
                                        value="{{ old('service_charges') }}">
                                    @error('service_charges')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="total_price" style="font-weight: 700">Total Price:</label>
                                    <input type="text" name="total_price" id="total_price"
                                        class="@error('total_price') is-invalid @enderror form-control py-1" required
                                        value="{{ old('total_price') }}">
                                    @error('total_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-6 mb-3">
                                    <label for="product_qty" style="font-weight: 700">Product Quantity:</label>
                                    <input type="number" name="product_qty" id="product_qty"  min="1" max="10" value="1"
                                        class="@error('product_qty') is-invalid @enderror form-control py-1" required
                                        value="{{ old('product_qty') }}">
                                    @error('product_qty')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> --}}
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


@section('script')
<script>
    $(document).ready(function(){
    $("#quantity,#price,#weight,#gold_quantity_p,#gold_quantity_y,#ad_gold_quantity_p , #ad_gold_quantity_y,#service_charges").keyup(function(){
        calculation();
     });
    });
    function calculation(){
    var today_g_price = Number($("#today_g_price").val());
     var quantity = Number($("#quantity").val());
     var service_charges = Number($("#service_charges").val());
     var ad_gold_price = Number($("#ad_gold_price").val());
     var gold_price = Number($("#gold_price").val());
     var price = Number($("#price").val());
      var weight = Number($("#weight").val());
     var gold_quantity_p = Number($("#gold_quantity_p").val());
     var gold_quantity_y = Number($("#gold_quantity_y").val());
     var ad_gold_quantity_p = Number($("#ad_gold_quantity_p").val());
     var ad_gold_quantity_y = Number($("#ad_gold_quantity_y").val());
     var gold_price_total =  (gold_quantity_y/8 + gold_quantity_p)/16  * today_g_price;
     var ad_gold_price_total =  (ad_gold_quantity_y/8 + ad_gold_quantity_p)/16  * today_g_price;
     var weight_type = $("#weight_type").val();
     var total_gem_price = weight_type == 1?  (price * weight) :   (price * weight) * 1.1;
     var total =total_gem_price +
     gold_price_total + ad_gold_price_total;
     total = total + ( (service_charges / 100) * total);
        $("#total_price").val(Math.round(total));
        $("#gold_price").val(Math.round(gold_price_total));
        $("#ad_gold_price").val(Math.round(ad_gold_price_total));
    }
    // function previewImageFile(event){
    //     var file = $("input[type=file]").get(0).files[0];
    //     if(file){
    //      $("#blah").attr("src",  URL.createObjectURL(file) );
    //     }
    // }
    var previewImageFile = function(event) {
            for(var i =0; i< event.target.files.length; i++){
                var src = URL.createObjectURL(event.target.files[i]);
                $("#image").append("<img id='myImg"+i+"'   src="+src+" class='rounded shadow-sm p-1' style='transition: 0.4s; height: 100px; width: 100px' style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");
            }
        };
</script>

@endsection
 