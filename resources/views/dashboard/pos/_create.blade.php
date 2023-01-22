@extends('layouts.app')
@section('title', 'Pos Create')
@section('content')
    <div class="pagetitle">
        <h1>Pos Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pos') }}">Pos</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <form action="{{route('pos.store')}}" method="POST">
        @csrf
        <div class="row">
            @php 
                $date = \Carbon\Carbon::now()->format('y-m-d');
                $datetime = strtotime($date);
                $datenow = date('Y-m-d',$datetime);
            @endphp
            
            <div class="col-md-4">
                <label for="name" style="font-weight: 700" class="mb-2">Enter Customer Name:</label>
                <select class="form-select" aria-label="Default select example" name="name" id="customer_name">
                    <option value="0"></option>
                    @foreach ($customers as $customer)
                        <option name="name" value="{{ $customer->id }}">{{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="ph_no" style="font-weight: 700" class="mb-2">Phone Number:</label>
                <input type="text" name="ph_no" id="ph_no"
                    class="@error('ph_no') is-invalid @enderror form-control py-1" required
                    value="{{ old('ph_no') }}">
                @error('ph_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="date" style="font-weight: 700" class="mb-2">Date:</label>
                <input type="date" name="date"
                    class="@error('date') is-invalid @enderror form-control py-1" required
                    value="{{ old('date',$datenow) }}" readonly>
                @error('date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <label for="address" style="font-weight: 700" class="mb-2">Enter Customer Address:</label>
                <textarea name="address" id="address" cols="30" rows="4" class="@error('address') is-invalid @enderror form-control" required></textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-bordered border-dark">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Rate</th>
                          <th scope="col">Discount</th>
                          <th scope="col">Amount</th>
                          <th scope="col">
                            <button class="btn btn-outline-dark" id="add_pos_item" onclick="BtnAdd()">+</button>
                          </th>
                        </tr>
                    </thead>
                    <tbody id="TBody">
                        <tr id="TRow" class="d-none">
                            <th scope="row" id="num">1</th>
                            <td>
                                <select class="form-select" name="code[]" id="product">
                                    <option value="0"></option>
                                    @foreach ($products as $product)
                                        <option  value="{{ $product->id }}">{{ $product->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantity[]" id="quantity"
                                class="form-control py-1" required value="1">
                            </td>
                            <td>
                                <input type="text" name="price[]" id="price"
                                class="form-control py-1" required disabled>
                            </td>
                            <td>
                                <input type="text" name="discount[]" id="discount"
                                class="form-control py-1">
                            </td>
                            <td>
                                <input type="text" name="total[]" id="amount"
                                class="form-control py-1">
                            </td>
                            <td>
                                <button class="btn btn-outline-dark" onclick="BtnRemove(this)">x</button>
                            </td>
                        </tr>
                        <tr id="TRow">
                            <th scope="row" id="num">1</th>
                            <td>
                                <select class="form-select"  name="code[]" id="product">
                                    <option value="0"></option>
                                    @foreach ($products as $product)
                                        <option  value="{{ $product->id }}">{{ $product->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantity[]" id="quantity"
                                class="form-control py-1" required value="1">
                            </td>
                            <td>
                                <input type="text" name="price[]" id="price"
                                class="form-control py-1" required disabled>
                            </td>
                            <td>
                                <input type="text" name="discount[]" id="discount"
                                class="form-control py-1">
                            </td>
                            <td>
                                <input type="text" name="total[]" id="amount"
                                class="form-control py-1">
                            </td>
                            <td>
                                <button class="btn btn-outline-dark" onclick="BtnRemove(this)">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>

        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-between">
                <div>
                    <button class="btn btn-primary" type="submit">Create</button>
                    <button class="btn btn-primary">Back</button>
                </div>
                <div>
                    <label for="netAmount" class="">Net Amount</label>
                    <input type="text" name="netAmount" id="netAmount" class="">
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-end">
            <div class="col-md-4 d-flex">
                <label for="netAmount" class="form-label mr-3">Paid Status</label>
                <select class="form-select w-50"  name="paid_status" id="paid_status">
                    <option value="">-- Select --</option>
                    <option  value="paid">Paid</option>
                    <option  value="unpaid">Unpaid</option>
                </select>
            </div>
        </div>
    </form>
       

    </section>

@endsection

@section('script')

<script>
    $(document).ready(function(){
        $('#customer_name').on('change', function() {
            var customer_id = $('#customer_name').val();
            
            $.ajax({
                url: customer_id + "/get-customer/",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                   
                    // console.log(data);
                    $("#ph_no").val(data.ph_no);
                    $("#address").val(data.address);
                }
            });
  
        });

        $('#product').on('change', function() {
            var customer_id = $('#product').val();
            
            $.ajax({
                url: customer_id + "/get-product/",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                   
                    // console.log(data);
                    $("#price").val(data.price);
                    var quantity = Number($("#quantity").val());
                    var price = data.price;
                    var amount = quantity * price;
                    $("#amount").val(amount);
                }
            });
  
        });


        $("#quantity").keyup(function(){

            var quantity = Number($("#quantity").val());
            var discount = Number($("#discount").val());
            var amount = Number($("#amount").val());
            var price = Number($("#price").val());
            var total = (quantity * price) - discount;
            $("#amount").val(total);

        });

        $("#discount").keyup(function(){

        var quantity = Number($("#quantity").val());
        var discount = Number($("#discount").val());
        var amount = Number($("#amount").val());
        var price = Number($("#price").val());
        var total = (quantity * price) - discount;
        $("#amount").val(total);

        });

        
       

    });
    var num = 1;
    function BtnAdd(){
        $("#num").text(++num);
           var v = $("#TRow").clone().appendTo("#TBody");
           $(v).find("input").val('');
           $(v).removeClass("d-none");
    };

    function BtnRemove(v){
        $(v).parent().parent().remove();
        $("#num").text(--num);
    };

</script>

@endsection

