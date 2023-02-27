@extends('layouts.app')
@section('title', 'Exchange & Return Edit')
@section('content')
    <div class="pagetitle">
        <h1>Exchange & Return Page</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('exchange-return') }}">Exchange & Return</a></li>
            </ol>
        </nav>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Exchange & Return</h5>
                        <form action="{{ route('exchange-return.update',$exchange_return->id) }}" method="POST" novalidate enctype="multipart/form-data"
                            class="needs-validation">
                            @csrf
                            @method("PUT")
                            <div class="row">
                               
                                <div class="col-md-4 mb-3">
                                    <label for="pos_id" style="font-weight: 700">Voucher No:</label>
                                    <select class="form-select" aria-label="Default select example" name="pos_id" onchange="getPosData()" id="pos_id">
                                        <option value="">Select Voucher No</option>
                                        @foreach ($pos as $voucher)
                                            <option name="pos_id" value="{{ $voucher->id }}"  @if($voucher->id  == $exchange_return->pos_id) selected @endif>{{ $voucher->voucher_no }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="type" style="font-weight: 700">Type:</label>
                                    <select class="form-select" aria-label="Default select example" name="type">
                                        <option value="">Select Type</option>
                                        <option name="type" value="exchange" @if($exchange_return->type == "exchange") selected @endif>Exchange</option>
                                        <option name="type" value="full-return" @if($exchange_return->type == "full-return") selected @endif>Return</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="percentage" style="font-weight: 700">Percentage:</label>
                                    <select class="form-select" aria-label="Default select example" name="percentage" id="percentage" onchange="getPercentage()">
                                        <option value="">Select Percentage</option>
                                        <option name="percentage" value="0" @if($exchange_return->percentage == 0) selected @endif>0 %</option>
                                        <option name="percentage" value="5" @if($exchange_return->percentage == 5) selected @endif>5 %</option>
                                        <option name="percentage" value="10" @if($exchange_return->percentage == 10) selected @endif>10 %</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="extra_charges" style="font-weight: 700">Extra Charges:</label>
                                    <input type="text" name="extra_charges"
                                        class="@error('extra_charges') is-invalid @enderror form-control py-1" required
                                        value="{{ old('extra_charges',$exchange_return->extra_charges) }}" id="extra_charges">
                                    @error('extra_charges')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="final_amount" style="font-weight: 700">Total:</label>
                                    <input type="text" name="final_amount"
                                        class="@error('final_amount') is-invalid @enderror form-control py-1" required
                                        value="{{ old('final_amount',$exchange_return->final_amount) }}" id="final_amount">
                                    @error('final_amount')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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

@section('script')
 <script>
    function getPosData()
  {
    var pos_id = $("#pos_id").val();

  
    
        $.ajax({
            url: "/auth/exchange-return/" + pos_id + "/get-pos/",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log(data.total_price);
               
                getPrice(data.total_price);
                // $("#price_"+row_id).val(data.price);
                // var quantity = Number($("#quantity_"+row_id).val());
                // var price = data.price;
                // var amount = quantity * price;
                // $("#amount_"+row_id).val(amount);
                // getTotal(row_id);
            }
        });

};

        function getPercentage(){
            // var pos_total = Number($("#pos_total").val());
            // console.log(pos_total);
            // getPrice(pos_total);
            getPosData();
        }

    function getPrice(total){
        
       var percentage = Number($("#percentage").val());
    //    console.log(typeof(percentage));
       var extra_charges = total * percentage/100;
        var final_amount = total - extra_charges ;
       $("#extra_charges").val(extra_charges);
       $("#final_amount").val(final_amount);
    }
 </script>
@endsection