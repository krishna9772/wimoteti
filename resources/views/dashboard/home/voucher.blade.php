@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('homepage')}}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    
    @if($voucherFilter)
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Product Image</h5>
                </div>
                <div class="card-body my-2">
                    <div class="row">
                        @foreach ($voucherFilter->positem as $item)
                        <div class="col-md-2">
                            <img src="{{asset('/storage/'.$item->image)}}" alt="" class="w-100" style="height: 120px;">
                            <div class="text-center fw-bold">Code: <span>{{$item->code}}</span></div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
               
                <div id="divCon" class="w-100">
                    
                    <div style="padding: 20px ;background-color:rgb(245, 199, 207);">
            
            
                    
                    <table style="text-align: center; width: 100%;
                    border-collapse: collapse;">
                        <tr>
                            <td>
                                <span style="font-weight:bold;color:rgb(161, 82, 82);">
                                    ဗုဒ္ဓံ ၊ ဓမ္မံ ၊ သံဃံ ၊ ပူဇေမိ ။
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                @if($voucherFilter->payment_status == "paid")
                                <span style="border:3px solid rgb(55, 55, 110);padding:15px 30px;font-size:25px;font-weight:bold;color:rgb(55, 55, 110);float: left;opacity:0;">PAID</span>
                                @endif
                                <span style="font-size: 4rem;vertical-align: middle;
                                border:3px solid rgb(161, 82, 82);
                                padding:0px 5px;font-weight:700;margin-right:20px;color:rgb(161, 82, 82);">V</span>
                                <span style="vertical-align: middle;font-size: 2rem;font-weight:700;margin-right:5px;color:rgb(161, 82, 82);">ဝိမုတ္တိခေတ်</span>
                                <span style="vertical-align: middle;font-size: 1.4rem;font-weight:700;color:rgb(161, 82, 82);">စိန်ရတနာဆိုင်</span>
                                <span style="font-size: 4rem;vertical-align: middle;
                                border:3px solid rgb(161, 82, 82);
                                padding:0px 5px;font-weight:700;margin-left:20px;color:rgb(161, 82, 82);">V</span>
                               @if($voucherFilter->payment_status == "paid")
                               <span style="border:3px solid rgb(55, 55, 110);padding:15px 30px;font-size:25px;font-weight:bold;color:rgb(55, 55, 110);float: right;">PAID</span>
                               @endif
                            </td>     
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size: 1.4rem;font-weight:700;margin-right:5px;color:rgb(161, 82, 82);">Vimukti Uga </span>
                                 <span style="font-size:1.3rem;color:rgb(161, 82, 82);">Jewellery</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size:1.3rem; font-weight: bold;color:rgb(161, 82, 82);">( C - ၂၁၆ / ၂၁၇ / ၂၁၈ ) ပထမထပ် ၊ Time City ၊ ကျွန်းတောလမ်း ၊ ရန်ကုန် ။</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size:1.3rem;font-weight:bold;color:rgb(161, 82, 82);">09 795372480 [ Shop ] , 09 250357584 [ Shop ] , 09 4500 26751 [ Online Order ]</span>
                            </td>
                        </tr>
                    </table>
                    <p>
                        <span style="font-size: 1.1rem;font-weight:bold;color:rgb(161, 82, 82);">ဝယ်သူအမည် - {{$voucherFilter->customer->name}}</span>
                        <span style="font-size: 1.1rem;font-weight:bold;float: right;color:rgb(161, 82, 82);">နေ့စွဲ - {{date_format($voucherFilter->created_at,'d.m.y')}}</span>
                    </p>
                    <p>
                        <span style="font-size: 1.1rem;font-weight:bold;color:rgb(161, 82, 82);">နေရပ်လိပ်စာ - {{$voucherFilter->customer->address}}</span>
                        <span style="font-size: 1.1rem;font-weight:bold;float: right;color:rgb(161, 82, 82);">ဖုန်းနံပါတ် - {{$voucherFilter->customer->ph_no}}</span>
                    </p>
                    <table style=" width: 100%;
                    border-collapse: collapse;">
                        <tr >
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:7%;text-align:center;">No</th>
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:19%;text-align:center;">Product Code</th>
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:18%;text-align:center;">Gem Type</th>
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:18%;text-align:center;">Gold Weight</th>
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:20%;text-align:center;">Quantity</th>
                            {{-- <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:15%;">Net Weight</th> --}}
                            <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;width:18%;text-align:center;">Amount</th>
                        </tr>
                        @php 
                            $no = 1;
                            $count = count($voucherFilter->positem);
                           
                        @endphp
            
                       @for ($x = 0; $x < $count; $x++)
                       <tr style="text-align: center;">
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$no++}}</td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$voucherFilter->positem[$x]->code}}</td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$voucherFilter->positem[$x]->gem_type}}</td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$voucherFilter->positem[$x]->gold_quantity_p}}.{{$voucherFilter->positem[$x]->gold_quantity_y}}</td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$voucherFilter->positem[$x]->quantity}}</td>
                            {{-- <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$voucherFilter->positem[$x]->net_weight}}</td> --}}
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{number_format($voucherFilter->positem[$x]->total_price)}}</td>
                        </tr>
                       @endfor
                       @for ($y = $count ; $y <= 9; $y++)
                       <tr style="text-align: center;">
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                            {{-- <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td> --}}
                            <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;"></td>
                        </tr>
                       @endfor
                       
            
                       <tr>
                            <td colspan="4" style="border : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <li style="padding: 0px 20px;">
                                    မည်သည့်လက်ဝတ်ရတနာထည်များကိုမဆိုလဲလှယ်/
                                    ရောင်းလိုပါက လဲ(၅%) ၊ (၁၀%)
                                    ပြန်လည်လက်ခံယူပါသည်။ 
                                </li>
                            </td>
                            <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);height: 50px;">
                                <div style="border: 2px solid white;padding:13px 0px;">
                                    Discount Amount
                                </div>
                            </td>
                            <td colspan="1" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;text-align:center;">@if($voucherFilter->discount == null)0 Ks @else {{number_format($voucherFilter->discount)}} @endif</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <li style="padding: 0px 20px;">
                                    ဘောက်ချာ၌ပြင်ရာ၊ဖျက်ရာပါပါက
                                    နောက်တစ်ရွက်တောင်းယူပါ။
                                </li>
                             </td>
                             <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">
                                
                                <div style="border: 2px solid white;padding:13px 0px;color:white;">
                                    Total Amount
                                </div>
                            </td>
                            <td  colspan="1" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px; text-align:center;">{{number_format($voucherFilter->total_price)}} Ks</td>
                        </tr>
                    
                        <tr>
                            <td colspan="4" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <li style="padding: 0px 20px;">
                                    ရောင်း/လဲဲလိုပါက ဘောက်ချာနှင့်တကွ
                                    ယူဆောင်လာပါရန် မေတ္တာရပ်ခံအပ်ပါသည်။
                                </li>
                            </td>
                            <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);height: 50px;">
                                <div style="border: 2px solid white;padding:13px 0px;">
                                    Advance
                                </div>
                            </td>
                            <td colspan="1" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;text-align:center;">@if($voucherFilter->advance == null)0 Ks @else {{number_format($voucherFilter->advance)}} Ks @endif</td>
                        </tr>
                        <tr>
                            <td colspan="4" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <li style="padding: 0px 20px;">
                                    ဘောက်ချာမပါပါကပြန်လည်ဝယ်ယူ/
                                    လဲဲလှယ်ပေးမည်မဟုတ်ပါ။
                                  </li>
                            </td>
                            <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);height: 50px;">
                                <div style="border: 2px solid white;padding:13px 0px;">
                                    Balance
                                </div>
                            </td>
                            <td colspan="1" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;text-align:center;">@if($voucherFilter->balance == null)0 Ks @else {{number_format($voucherFilter->balance)}} Ks @endif</td>
                        </tr>
            
                        <tr>
                            <td colspan="4" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <li style="padding: 0px 20px;">
                                    တစ်ပတ်အတွင်းအခမဲ့လဲလှယ်ပေးသည်။
                                    (အော်ဒါအပ်ထည်မပါဝင်ပါ)။
                                  </li>
                            </td>
                            <td colspan="3" style="text-align:justify;font-weight:bold;color:rgb(161, 82, 82);height: 50px;text-align:center;">
                                <span style="padding: 0px 30px;"> * စိန် နှင့်ရတနာ အထည်များ ကို စံ ၁၃ ပဲရည်
                                 အသုံးပြု၍ သေသပ်သောလက်ရာ ၊ မှန်ကန်သော စျေးနှုန်းတို့ဖြင့် ရောင်းချပေးလျှက်ရှိပါသည်။ *</span>
                             </td>
                        </tr>
                        
                        <tr>
                            <td colspan="4" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                                <span style="padding: 0px 20px;">ငွေလက်ခံသူ လက်မှတ် &nbsp;&nbsp;..................................</span>
                            </td>
                            <td colspan="3" style="font-weight:bold;color:rgb(161, 82, 82);height: 50px;text-align:end;">
                                <span style="padding: 0px 20px;">* ဝယ်ယူအားပေးမှုကို ကျေးဇူးတင်ပါသည်။ *</span>
                            </td>
                        </tr>
            
                    </table>
                </div>
            
            </div>
            

        </div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <span class="text-muted">Voucher Not Found!!</span>
            </div>
        </div>
    </div>
    @endif
@endsection
