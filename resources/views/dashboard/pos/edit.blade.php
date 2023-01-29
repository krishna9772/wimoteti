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
        <form action="{{route('pos.update',$pos->id)}}" method="POST">
        @csrf
        @method("PUT")
        <div class="row">
            @php 
                $date = $pos->created_at->format('y-m-d');
                $datetime = strtotime($date);
                $datenow = date('Y-m-d',$datetime);
            @endphp
            
            <div class="col-md-4">
                <label for="name" style="font-weight: 700" class="mb-2">Enter Customer Name:</label>
                <select class="form-select" aria-label="Default select example" name="name" id="customer_name">
                    <option value="0"></option>
                    @foreach ($customers as $customer)
                        <option name="name" value="{{$customer->id}}" @if($customer->id  == $pos->customer->id) selected @endif>{{ $customer->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4">
                <label for="ph_no" style="font-weight: 700" class="mb-2">Phone Number:</label>
                <input type="text" name="ph_no" id="ph_no"
                    class="@error('ph_no') is-invalid @enderror form-control py-1" required
                    value="{{ old('ph_no',$pos->customer->ph_no) }}">
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
                <textarea name="address" id="address" cols="30" rows="4" class="@error('address') is-invalid @enderror form-control"  required>{{ $pos->customer->address}}</textarea>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <table class="table table-bordered border-dark" id="product_info_table">
                    <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Product</th>
                          <th scope="col">Quantity</th>
                          <th scope="col">Rate</th>
                          {{-- <th scope="col">Discount</th> --}}
                          <th scope="col">Amount</th>
                          <th scope="col">
                            <button type="button" class="btn btn-outline-dark" id="add_row">+</button>
                          </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1 ;@endphp
                        @foreach($pos->positem as $positem)
                        <tr id="row_{{$no}}">
                            <th scope="row" id="num">{{$no}}</th>
                            <td>
                                <select class="form-select product"  name="code[]"  data-row-id="row_{{$no}}" id="product_{{$no}}" onchange="getProductData({{$no}})" required>
                                    <option value=""></option>
                                    @foreach ($products as $product)
                                        <option  value="{{$product->id}}" @if($product->id  == $positem->product_id) selected @endif>{{ $product->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantity[]" id="quantity_{{$no}}"
                                class="form-control py-1" required value="{{$positem->quantity}}" onkeyup="getTotal({{$no}})">
                            </td>
                            <td>
                                <input type="text" name="price[]" id="price_{{$no}}"
                                class="form-control py-1" value="{{$positem->total_price}}" required>
                            </td>
                            <td>
                                <input type="text" name="total[]" id="amount_{{$no}}"
                                class="form-control py-1"  value="{{$positem->total_price * $positem->quantity}}" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-dark" onclick="removeRow({{$no}})">x</button>
                            </td>
                        </tr>
                        @php $no++;@endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-12 d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                    <button type="submit" class="btn btn-primary me-3">Update Pos</button>
                    <button class="btn btn-primary">Back</button>
                </div>
                <div class="d-flex align-items-center ">
                    <label for="discount" class="text-nowrap form-label mb-0">Discount</label>
                    <input type="text" name="discount" id="discount" class="form-control ms-3" onkeyup="getTotal()" value="{{$pos->discount}}">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <div class="d-flex align-items-center ">
                    <label for="netAmount" class="text-nowrap form-label mb-0">Net Amount</label>
                    <input type="text" name="netAmount" id="netAmount" class="form-control ms-3" style="width: 230px !important;" value="{{$pos->total_price}}">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <div class="d-flex align-items-center">
                    <label for="netAmount" class="text-nowrap form-label">Paid Status</label>
                    <select class="form-select ms-3"  name="paid_status" id="paid_status" style="width: 230px !important;" required>
                        <option value="">-- Select --</option>
                        <option  value="paid" @if($pos->payment_status == 'paid') selected @endif>Paid</option>
                        <option  value="unpaid" @if($pos->payment_status == 'unpaid') selected @endif>Unpaid</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
       

    </section>

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function(){
        $('#customer_name').on('change', function() {
            var customer_id = $('#customer_name').val();
            
            $.ajax({
                url: "/auth/pos/" + customer_id + "/get-customer/",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                   
                    // console.log(data);
                    $("#ph_no").val(data.ph_no);
                    $("#address").val(data.address);
                }
            });
  
        });



  	  $("#add_row").off('click').on('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      if(count_table_tbody_tr > 7){

          alert('Maximum rows 8');

      }else{

      var row_id = count_table_tbody_tr + 1;
     
      var html = '<tr id="row_'+row_id+'">'+
                 '<th scope="row">'+row_id+ '</th>'+
                 '<td>'+
                 '<select class="form-select product"  name="code[]"  data-row-id="'+row_id+'" id="product_'+row_id+'" onchange="getProductData('+row_id+')" required>'+
                 '<option value=""></option>'+
                 '@foreach ($products as $product)'+
                 '<option  value="{{ $product->id }}">{{ $product->code }} </option>'+
                 '@endforeach'+
                 '</select>'+
                 '</td>'+
                 '<td>'+
                 '<input type="number" name="quantity[]" id="quantity_'+row_id+'" class="form-control py-1" onkeyup="getTotal('+row_id+')" required value="1">' +
                 '</td>'+
                 '<td>'+
                 '<input type="number" name="price[]" id="price_'+row_id+'" class="form-control py-1" required>' +
                 '</td>'+
                 '<td>'+
                 '<input type="number" name="total[]" id="amount_'+row_id+'" class="form-control py-1" required>' +
                 '</td>'+
                 '<td>'+
                 '<button type="button" class="btn btn-outline-dark" onclick="removeRow('+row_id+')">x</button>' +
                 '</td>'+
                 '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

          

    }

    });



   
    });

    function removeRow(tr_id)
  {
    // console.log(tr_id);
    var count_table_tbody_tr = $("#product_info_table tbody tr").length;
    if(count_table_tbody_tr > 1){
        $("#product_info_table tbody tr#row_"+tr_id).remove();
        getTotal();
    }
   
    // subAmount();
  };


//Get Product Data
function getProductData(row_id)
  {
    
    var product_id = $("#product_"+row_id).val();   
    console.log(product_id); 
    if(product_id == "") {
      $("#quantity_"+row_id).val("1");
      $("#price_"+row_id).val("");          
      $("#amount_"+row_id).val("");  
      

    } else {
        $.ajax({
            url: "/auth/pos/" + product_id + "/get-product/",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                
                console.log(data);
                $("#price_"+row_id).val(data.price);
                var quantity = Number($("#quantity_"+row_id).val());
                var price = data.price;
                var amount = quantity * price;
                $("#amount_"+row_id).val(amount);
                getTotal(row_id);
            }
        });
    }

};

//Get Product Data End


//sub amount
function subAmount(row){
    var quantity = Number($("#quantity_"+row).val());
    var amount = Number($("#amount_"+row).val());
    var price = Number($("#price_"+row).val());
    var total = (quantity * price);
    $("#amount_"+row).val(total);
};

//sub amount end

//Get Total Price

function getTotal(row = null) {
    subAmount(row);
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var discount = Number($("#discount").val());
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
      if(discount == 100){
        alert('Discount Percentage Should be less than 100 !!');
        $("#discount").val("");
      };
      if(discount < 100){
        lastTotal = Number(totalSubAmount) - (Number(totalSubAmount)/100)*discount;
      }else{
        lastTotal = totalSubAmount - discount;
      }
      
    } 
    $("#netAmount").val(lastTotal)
    
};


//Get Total Price End

   
   

</script>

@endsection

