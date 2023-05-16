@extends('layouts.app')
@section('title', 'Product Edit')
@section('content')
    <div class="pagetitle">
        <h1>Product Edit Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                <li class="breadcrumb-item"><a href="{{ route('product') }}">Product Edit</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Product</h5>

                        <form action="{{ route('product.update',$product->id) }}" method="POST" novalidate enctype="multipart/form-data"
                            class="needs-validation">
                            @csrf
                            @method('put')
                            <div class="row">
                                <input type="hidden" name="" id="today_g_price" value="{{gold_price()}}">
                                <div class="col-md-12 mb-3">
                                    <label for="image" style="font-weight: 700">Image:</label><br>
                                    <label for="image"> 
                                        @php
                                            $images = explode("~%" , $product->image) ;
                                        @endphp
                                           <div class="form-group" id="images">
                                        @foreach ($images as $img)
                                            @if($img != "")
                                         
                                                <img id="image" src="{{ asset("storage/".$img ? "storage/".$img : 'assets/img/images.jpg') }}"
                                                class="rounded shadow-sm p-1"
                                                style="transition: 0.4s; height: 100px; width: 100px" />
                                           
                                            @endif
                                        @endforeach    
                                    </div>                                                                                      
                                    </label>
                                    <input accept="image/*" name="image[]"  multiple="multiple" type='file' id="image" class="mx-2"  onchange="previewImageFile(event);"  />

                                    {{-- <input accept="image/*" name="image" type='file' id="image" class="mx-2" onchange="previewImageFile(this);" /> --}}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="code" style="font-weight: 700">Code:</label>
                                    <input type="text" name="code"
                                        class="@error('code') is-invalid @enderror form-control py-1" required
                                        value="{{ old("code",$product->code) }}">
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type" style="font-weight: 700">Category:</label>
                                    <select class="form-select" aria-label="Default select example" name="type" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option name="type" value="{{ $category->id }}" {{ old("category",$product->getCategory->id) == $category->id ? "selected" : "" }}>{{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @php
                                    $gem_weight = json_decode($product->weight);
                                    $gem_type = json_decode($product->gem_type);
                                    $gem_quantity = json_decode($product->quantity);
                                    $weight_type = json_decode($product->weight_type);
                                    $gem_price = json_decode($product->price);
                                @endphp
                             
                                @if(gettype($gem_type) == 'array')

                                    <label for="gem_section" style="font-weight: 700;">Gem section</label>

                                    <fieldset class="scheduler-border">

                                    @for($i = 0 ; $i < count($gem_type); $i++)
                                    
                                        <div id="gem-section">
                                           
                                                <div class="row border mx-1 my-2 py-2 gem-row" id="row_{{$i+1}}">
                                                    <div class="col-md-2 mb-3">
                                                        <label for="gem_type" style="font-weight: 700">Type:</label>
                                                        <input type="text" name="gem_type[]"
                                                            class="@error('gem_type') is-invalid @enderror form-control py-1" required
                                                            value="{{ old("gem_type",$gem_type[$i]) }}" id="gem_type_{{$i+1}}">
                                                        @error('gem_type')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    
                                                    <div class="col-md-2 mb-3">
                                                        <label for="quantity" style="font-weight: 700">Quantity:</label>
                                                        <input type="text" name="quantity[]" id="quantity_{{$i+1}}"
                                                            class="@error('quantity') is-invalid @enderror form-control py-1" required
                                                            value="{{ old('quantity',$gem_quantity[$i]) }}">
                                                        @error('quantity')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="weight" style="font-weight: 700">Weight:</label>
                                                        <input type="text" name="weight[]" id="weight_{{$i+1}}"
                                                            class="@error('weight') is-invalid @enderror form-control py-1" required
                                                            value="{{ old('weight',$gem_weight[$i]) }}">
                                                        @error('weight')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <label for="weight_type" style="font-weight: 700"></label>
                                                        <select class="form-select" onchange="calculation()" name="weight_type[]" id="weight_type_{{$i+1}}">
                                                            <option  name="weight_type[]" value=1   {{ old("weight_type",$weight_type[$i]) == 1 ? "selected" : "" }} >Carat</option>
                                                            <option  name="weight_type[]" value=2  {{ old("weight_type",$weight_type[$i]) == 2 ? "selected" : "" }}>Ratti</option>
                                                        </select>    
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="price" style="font-weight: 700">Price:</label>
                                                        <div class="d-flex">
                                                            <input type="text" name="price[]" id="price_{{$i+1}}"
                                                            class="@error('price') is-invalid @enderror form-control py-1" 
                                                            value="{{ old('price',$gem_price[$i]) }}">
                                                            @if($i == 0)
                                                            <button class="ms-3 btn btn-secondary" id="add_new_gem_section" type="button">+</button>
                                                            <button class="ms-3 btn btn-danger" type="button" onclick="removeGemSection()">X</button>
                                                            @endif
                                                        </div>
                                                        @error('price')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                        </div>
                                    @endfor
                                    </fieldset>

                                @else

                                <label for="gem_section" style="font-weight: 700;">Gem section</label>

                                <fieldset class="scheduler-border">
                                    <div id="gem-section">
                                        <div class="row border mx-1 my-2 py-2 gem-row" id="row_1">
                                            <div class="col-md-2 mb-3">
                                                <label for="gem_type" style="font-weight: 700">Type:</label>
                                                <input type="text" name="gem_type[]" id="gem_type_1"
                                                    class="@error('gem_type') is-invalid @enderror form-control py-1" required
                                                    value="{{ old("gem_type",$product->gem_type) }}">
                                                @error('gem_type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                
                                            <div class="col-md-2 mb-3">
                                                <label for="quantity" style="font-weight: 700">Quantity:</label>
                                                <input type="text" name="quantity[]"
                                                    class="@error('quantity') is-invalid @enderror form-control py-1" required
                                                    value="{{ old('quantity',$product->quantity) }}" id="quantity_1">
                                                @error('quantity')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="weight" style="font-weight: 700">Weight:</label>
                                                <input type="text" name="weight[]" id="weight_1"
                                                    class="@error('weight') is-invalid @enderror form-control py-1" required
                                                    value="{{ old('weight',$product->weight) }}">
                                                @error('weight')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-md-2 mb-3">
                                                <label for="weight_type" style="font-weight: 700"></label>
                                                <select class="form-select" onchange="calculation()" name="weight_type[]" id="weight_type_1">
                                                    <option  value=1   {{ old("weight_type",$product->weight_type) == 1 ? "selected" : "" }} >Carat</option>
                                                    <option  value=2  {{ old("weight_type",$product->weight_type) == 2 ? "selected" : "" }}>Ratti</option>
                                                </select>    
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <label for="price" style="font-weight: 700">Price:</label>
                                                <div class="d-flex">

                                                    <input type="text" name="price[]" id="price_1"
                                                        class="@error('price') is-invalid @enderror form-control py-1" required
                                                        value="{{ old('price',$product->price) }}">
                                                        <button class="ms-3 btn btn-secondary" id="add_new_gem_section" type="button">+</button>
                                                        <button class="ms-3 btn btn-danger" type="button" onclick="removeGemSection()">X</button>
                                                </div>
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                @endif
                            <div class="col-md-3 mb-3">
                                <label for="gold_quantity_k" style="font-weight: 700">Gold Quantity(K):</label>
                                <input type="text" name="gold_quantity_k" id="gold_quantity_k"
                                    class="@error('gold_quantity_k') is-invalid @enderror form-control py-1" 
                                    value="{{ old('gold_quantity_k',$product->gold_quantity_k) }}">
                                @error('gold_quantity_k')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="gold_quantity_p" style="font-weight: 700">Gold Quantity(P):</label>
                                <input type="text" name="gold_quantity_p" id="gold_quantity_p"
                                    class="@error('gold_quantity_p') is-invalid @enderror form-control py-1" required
                                    value="{{ old('gold_quantity_p',$product->gold_quantity_p) }}">
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
                                    value="{{ old('gold_quantity_y',$product->gold_quantity_y) }}">
                                @error('gold_quantity_y')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="gold_price" style="font-weight: 700">Gold Price:</label>
                                <input type="text" name="gold_price" id="gold_price"
                                    class="@error('gold_price') is-invalid @enderror form-control py-1" required
                                    value="{{ old('gold_price',$product->gold_price) }}">
                                @error('gold_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ad_gold_quantity_k" style="font-weight: 700">AD Gold Quantity(K):</label>
                                <input type="text" name="ad_gold_quantity_k" id="ad_gold_quantity_k"
                                    class="@error('ad_gold_quantity_k') is-invalid @enderror form-control py-1" 
                                    value="{{ old('ad_gold_quantity_k',$product->ad_gold_quantity_k) }}">
                                @error('ad_gold_quantity_k')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ad_gold_quantity_p" style="font-weight: 700">AD Gold Quantity(P):</label>
                                <input type="text" name="ad_gold_quantity_p" id="ad_gold_quantity_p"
                                    class="@error('ad_gold_quantity_p') is-invalid @enderror form-control py-1" required
                                    value="{{ old('ad_gold_quantity_p',$product->ad_gold_quantity_p) }}">
                                @error('ad_gold_quantity_p')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ad_gold_quantity_y" style="font-weight: 700">AD Gold Quantity(Y):</label>
                                <input type="text" name="ad_gold_quantity_y" id="ad_gold_quantity_y"
                                    class="@error('ad_gold_quantity_y') is-invalid @enderror form-control py-1" required
                                    value="{{ old('ad_gold_quantity_y',$product->ad_gold_quantity_y) }}">
                                @error('ad_gold_quantity_y')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="ad_gold_price" style="font-weight: 700">AD Gold Price:</label>
                                <input type="text" name="ad_gold_price" id="ad_gold_price"
                                    class="@error('ad_gold_price') is-invalid @enderror form-control py-1" required
                                    value="{{ old('ad_gold_price',$product->ad_gold_price) }}">
                                @error('ad_gold_price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="net_weight" style="font-weight: 700">Net Weight:</label>
                                <input type="text" name="net_weight" id="net_weight"
                                    class="@error('net_weight') is-invalid @enderror form-control py-1" required
                                    value="{{ old('net_weight',$product->net_weight) }}">
                                @error('net_weight')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="service_charges" style="font-weight: 700">Service Charges:</label>
                                <input type="text" name="service_charges" id="service_charges"
                                    class="@error('service_charges') is-invalid @enderror form-control py-1" required
                                    value="{{ old('service_charges',$product->service_charges) }}">
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
                                    value="{{ old('total_price',$product->total_price) }}">
                                @error('total_price')
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

@section('script')
<script>
    $(document).ready(function(){
        $("#quantity_1,#price_1,#weight_1,#quantity_2,#price_2,#weight_2,#quantity_3,#price_3,#weight_3,#quantity_4,#price_4,#weight_4,#quantity_5,#price_5,#weight_5,#gold_quantity_k,#gold_quantity_p,#gold_quantity_y,#ad_gold_quantity_k ,#ad_gold_quantity_p , #ad_gold_quantity_y,#service_charges").keyup(function(){
        calculation();
        
     });
    });
    function calculation(){
    var today_g_price = Number($("#today_g_price").val());
     var quantity_1 = Number($("#quantity_1").val());
     var quantity_2 = Number($("#quantity_2").val());
     var quantity_3 = Number($("#quantity_3").val());
     var quantity_4 = Number($("#quantity_4").val());
     var quantity_5 = Number($("#quantity_5").val());

     var price_1 = Number($("#price_1").val());
     var price_2 = Number($("#price_2").val());
     var price_3 = Number($("#price_3").val());
     var price_4 = Number($("#price_4").val());
     var price_5 = Number($("#price_5").val());

     var weight_1 = Number($("#weight_1").val());
     var weight_2 = Number($("#weight_2").val());
     var weight_3 = Number($("#weight_3").val());
     var weight_4 = Number($("#weight_4").val());
     var weight_5 = Number($("#weight_5").val());

     var service_charges = Number($("#service_charges").val());
     var ad_gold_price = Number($("#ad_gold_price").val());
     var gold_price = Number($("#gold_price").val());

     var weight_type_1 = $("#weight_type_1").val();
     var weight_type_2 = $("#weight_type_2").val();
     var weight_type_3 = $("#weight_type_3").val();
     var weight_type_4 = $("#weight_type_4").val();
     var weight_type_5 = $("#weight_type_5").val();

     var total_gem_price_1 = weight_type_1 == 1?  (price_1 * weight_1) :   (price_1 * weight_1) * 1.1;
     var total_gem_price_2 = weight_type_2 == 1?  (price_2 * weight_2) :   (price_2 * weight_2) * 1.1;
     var total_gem_price_3 = weight_type_3 == 1?  (price_3 * weight_3) :   (price_3 * weight_3) * 1.1;
     var total_gem_price_4 = weight_type_4 == 1?  (price_4 * weight_4) :   (price_4 * weight_4) * 1.1;
     var total_gem_price_5 = weight_type_5 == 1?  (price_5 * weight_5) :   (price_5 * weight_5) * 1.1;
     
      var gold_quantity_k = Number($("#gold_quantity_k").val());
     var gold_quantity_p = Number($("#gold_quantity_p").val());
     var gold_quantity_y = Number($("#gold_quantity_y").val());
     var ad_gold_quantity_k = Number($("#ad_gold_quantity_k").val());
     var ad_gold_quantity_p = Number($("#ad_gold_quantity_p").val());
     var ad_gold_quantity_y = Number($("#ad_gold_quantity_y").val());
     
   //  var gold_price_total =  (gold_quantity_k + gold_quantity_y/128 + gold_quantity_p/16) * today_g_price;
    // var ad_gold_price_total =  (ad_gold_quantity_k + ad_gold_quantity_y/128 + ad_gold_quantity_p/16)  * today_g_price;
    var gold_price_total =   (today_g_price* gold_quantity_k) + ((today_g_price/16) * gold_quantity_p) + ((today_g_price/128) * gold_quantity_y);
     var ad_gold_price_total =  (today_g_price* ad_gold_quantity_k) + ((today_g_price/16) * ad_gold_quantity_p) + ((today_g_price/128) * ad_gold_quantity_y);
     
     var total = total_gem_price_1 + (isNaN(total_gem_price_2) ? 0 : total_gem_price_2) +
     (isNaN(total_gem_price_3) ? 0 : total_gem_price_3) +
     (isNaN(total_gem_price_4) ? 0 : total_gem_price_4) +
     (isNaN(total_gem_price_5) ? 0 : total_gem_price_5) +
     gold_price_total + ad_gold_price_total;
     total = total + ( (service_charges / 100) * total);
        $("#total_price").val(Math.round(total));
        $("#gold_price").val(Math.round(gold_price_total));
        $("#ad_gold_price").val(Math.round(ad_gold_price_total));
    }
    // function previewImageFile(input){
    //     var file = $("input[type=file]").get(0).files[0];
    //     if(file){
    //      $("#blah").attr("src",  URL.createObjectURL(file) );
    //     }
    // }
    var previewImageFile = function(event) {
            for(var i =0; i< event.target.files.length; i++){
                var src = URL.createObjectURL(event.target.files[i]);
                $("#images").append("<img id='myImg"+i+"'   src="+src+" class='rounded shadow-sm p-1' style='transition: 0.4s; height: 100px; width: 100px' style='margin:4px;width:100px;border-radius:5px;cursor:pointer;' alt='img' />");
            }
        };



        $("#add_new_gem_section").off('click').on('click', function() {
            var count_gem_row = $("#gem-section .gem-row").length;
            var row_id = count_gem_row + 1;
            // console.log(count_gem_row);

            var html = '<div class="row border mx-1 my-2 py-2 gem-row" id="row_' + row_id + '">' +
                        '<div class="col-md-2 mb-3">' +
                        '<label for="gem_type" style="font-weight: 700">Gem type:</label>'+
                        '<input type="text" name="gem_type[]" class="@error("gem_type") is-invalid @enderror form-control py-1"  value="{{ old("gem_type") }}">' +
                        '@error("gem_type")'+
                        '<span class="invalid-feedback" role="alert">' +
                        '<strong>{{ $message }}</strong>' + 
                        ' </span>' +
                        '@enderror' +
                        '</div>' +
                        '<div class="col-md-2 mb-3">' +
                        '<label for="quantity" style="font-weight: 700">Gem Quantity:</label>' +
                        '<input type="text" name="quantity[]" id="quantity_' +row_id + '" class="@error("quantity") is-invalid @enderror form-control py-1"  value="{{ old("quantity") }}">' +
                        '@error("quantity")'+
                        '<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>'+
                        '@enderror'+
                        '</div>'+
                        '<div class="col-md-2 mb-3">' +
                        '<label for="weight" style="font-weight: 700">Gem weight:</label>'+
                        '<input type="text" name="weight[]" id="weight_' + row_id + '" class="@error("weight") is-invalid @enderror form-control py-1"  value="{{ old("weight") }}">' +
                        '@error("weight")'+
                        '<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong> </span>' +              
                        '@enderror'+
                        '</div>'+
                        '<div class="col-md-2 mb-3">' +
                        '<label for="weight_type" style="font-weight: 700"></label>' +
                        '<select class="form-select" onchange="calculation()" name="weight_type[]" id="weight_type_'+row_id + '" name="weight_type[]">' +
                        '<option  name="weight_type[]" value=1>Carat</option>' +
                        '<option  name="weight_type[]" value=2>Ratti</option>' +
                        '</select>'+  
                        '</div>' +
                        '<div class="col-md-4 mb-3">'+
                        '<label for="price" style="font-weight: 700">Gem price:</label>'+
                        '<div class="d-flex">'+
                         '<input type="text" name="price[]" id="price_' + row_id + '" class="@error("price") is-invalid @enderror form-control py-1"  value="{{ old("price") }}" onkeyup="calculation()">'+
                         '</div>'+
                        '@error("price")'+
                        '<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>'+           
                        '@enderror'+
                        '</div>'+
                        '</div>';


             $("#gem-section #row_"+count_gem_row).after(html);
             
            });

            function removeGemSection(){
                var count_gem_row = $("#gem-section .gem-row").length;
                if(count_gem_row > 1){
                    $("#gem-section #row_"+count_gem_row).remove();
                    calculation();
                }
        };
</script>

@endsection