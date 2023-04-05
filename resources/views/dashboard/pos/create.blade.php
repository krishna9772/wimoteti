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
                <label for="name" style="font-weight: 700" class="mb-2">Customer Name:</label>
               <div class="d-flex">
                <select class="form-select"  name="name" id="customer_name" required>
                    <option value="0" disabled>-- Customers --</option>
                    @foreach ($customers as $customer)
                        <option name="name" value="{{ $customer->id }}">{{ $customer->name }}
                        </option>
                    @endforeach
                </select>
               
                <button class="btn btn-outline-primary btn-sm ms-2" type="button" 
                    data-bs-toggle="modal" data-bs-target="#addCustomer">
                    <span class="px-1 py-0">+</span>
                </button>
               </div>
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
                <label for="address" style="font-weight: 700" class="mb-2">Customer Address:</label>
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
                <label for="description" style="font-weight: 700" class="mb-2">Description:</label>
                <textarea name="description" id="description" cols="30" rows="4" class="@error('description') is-invalid @enderror form-control"></textarea>
                @error('description')
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
                          <th scope="col">Amount</th>
                          <th scope="col">
                            <button type="button" class="btn btn-outline-dark" id="add_row">+</button>
                          </th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <tr id="row_1">
                            <th scope="row" id="num">1</th>
                            <td>
                                <select class="form-select product js-example-basic-single"  name="code[]"  data-row-id="row_1" id="product_1" onchange="getProductData(1)" required>
                                    <option value="" disabled>-- Products --</option>
                                    @foreach ($products as $product)
                                        <option  value="{{ $product->id }}">{{ $product->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="quantity[]" id="quantity_1"
                                class="form-control py-1" required value="1" onkeyup="getTotal(1)">
                            </td>
                            <td>
                                <input type="text" name="price[]" id="price_1"
                                class="form-control py-1"  required>
                            </td>
                            <td>
                                <input type="text" name="total[]" id="amount_1"
                                class="form-control py-1" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-outline-dark" onclick="removeRow('1')">x</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="col-md-12 d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                    <button type="submit" class="btn btn-primary me-3">Create Pos</button>
                    <a href="{{ route('pos') }}" class="btn btn-primary">Back</a>
                </div>
                <div class="d-flex align-items-center ">
                    <label for="discount" class="text-nowrap form-label mb-0">Discount</label>
                    <input type="text" name="discount" id="discount" class="form-control ms-3" onkeyup="getTotal()">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <div class="d-flex align-items-center ">
                    <label for="netAmount" class="text-nowrap form-label mb-0">Total Amount</label>
                    <input type="text" name="netAmount" id="netAmount" class="form-control ms-3" style="width: 230px !important;">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <div class="d-flex align-items-center ">
                    <label for="advance" class="text-nowrap form-label mb-0">Advance</label>
                    <input type="text" name="advance" id="advance" class="form-control ms-3" style="width: 230px !important;">
                </div>
            </div>
            <div class="col-md-12 d-flex justify-content-end mt-3">
                <div class="d-flex align-items-center">
                    <label for="netAmount" class="text-nowrap form-label">Paid Status</label>
                    <select class="form-select ms-3"  name="paid_status" id="paid_status" style="width: 230px !important;" required>
                        <option value="">-- Select --</option>
                        <option  value="paid">Paid</option>
                        <option  value="unpaid">Unpaid</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
       

    <!-- Add Customer Modal -->
        <div class="modal fade" id="addCustomer" tabindex="-1" aria-labelledby="addCustomerLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addCustomerLabel">
                            Add Customer Form
                            <small class="font-weight-bold text-success ml-1 d-none" style="font-size: 16px" id="successMessage">
                                <i class="bi bi-check-circle"></i>
                                success!
                            </small>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route("customer.add") }}" method="post" id="customerAddForm">
                            <input type="text" name="name" class="form-control py-1 my-2" placeholder = "Name" required>
                            <input type="text" name="ph_no" class="form-control py-1 my-2" placeholder = "Phone Number" required>
                            <textarea name="address" id="" cols="30" rows="5"  class="form-control py-1 my-2" placeholder="Address" required></textarea>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="customerAddBtn" form="customerAddForm">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('script')

<script type="text/javascript">

$(document).ready(function() {
    $('#customer_name').select2();
});

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});



$(document).ready(function () {

var customerAddForm = $("#customerAddForm");

$("#customerAddBtn").click(function (e) {
    e.preventDefault();

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $.ajax({
        url: customerAddForm.attr('action'),
        type: customerAddForm.attr('method'),
        _token : "{{ csrf_token() }}",
        data: customerAddForm.serialize(),
        dataType: 'json',
        success:function(response) {

            console.log(response);

            if (response.status == 422){

                // if (response.message.name){
                //     $("#name").addClass("is-invalid")
                //     $("#nameError").html(response.message.name)
                // }

                // if (response.message.email){
                //     $("#email").addClass("is-invalid")
                //     $("#emailError").html(response.message.email)
                // }

                // if (response.message.password){
                //     $("#password").addClass("is-invalid")
                //     $("#passwordError").html(response.message.password)
                // }
                console.log("fail");

            }

            if (response.status == 200){
                $("#successMessage").removeClass("d-none")
                location.reload();

            }


        },
        error: function(e){
            console.log(e.responseText);
        }
    });

})

})



    $(document).ready(function(){
        $('#customer_name').on('change', function() {
            var customer_id = $('#customer_name').val();
            
            $.ajax({
                url: customer_id+"/get-customer",
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
      if(count_table_tbody_tr > 9){

          alert('Maximum rows 10');

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

function removeRow(tr_id){
    var count_table_tbody_tr = $("#product_info_table tbody tr").length;
    if(count_table_tbody_tr > 1){
        $("#product_info_table tbody tr#row_"+tr_id).remove();
        getTotal();
    }
};


//Get Product Data
function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      $("#quantity_"+row_id).val("1");
      $("#price_"+row_id).val("");          
      $("#amount_"+row_id).val("");  

    } else {
        $.ajax({
            url:  product_id+"/get-product/",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                
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

