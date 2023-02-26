@extends('layouts.app')
@section('title', 'Product Detail')
@section('content')
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
                                <img id="blah" src="{{ asset("storage/".$product->image ? "storage/".$product->image : 'assets/img/images.jpg') }}"
                                class="rounded shadow-sm p-1"
                                style="transition: 0.4s; height: 100px; width: 100px" />
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
                                        <th scope="row">Gem Type</th>
                                        <td>{{$product->gem_type}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gem Quantity</th>
                                        <td>{{$product->quantity}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gem Weight</th>
                                        <td>{{$product->gem_weight}} @if($product->weight_type == 0) Carat  @else Ratti @endif</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gem Price</th>
                                        <td>{{$product->price}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gold Quantity</th>
                                        <td>{{$product->gold_quantity_p}}.{{$product->gold_quantity_y}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Gold Price</th>
                                        <td>{{$product->gold_price}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">AD Gold Quantity</th>
                                        <td>{{$product->ad_gold_quantity_p}}.{{$product->ad_gold_quantity_y}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">AD Gold Price</th>
                                        <td>{{$product->ad_gold_price}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Service Charges</th>
                                        <td>{{$product->service_charges}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total Price</th>
                                        <td>{{$product->total_price}}</td>
                                    </tr>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection