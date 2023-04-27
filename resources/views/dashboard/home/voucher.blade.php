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
                        <div class="col-md-12">
                        <div  class="row" for="image"> 
                            @php
                                $images = explode("~%" , $item->image) ;
                            @endphp
                            @foreach ($images as $img)
                                @if($img != "")
                                <div class="col-md-2">
                                <img src="{{asset('/storage/'. $img)}}" alt=""  style="width: 120px; height: 120px;">
                                </div>
                                @endif
                            @endforeach
                        </div>
                     
                        <div class=" fw-bold">Code: <span>{{$item->code}}</span></div> 
                    </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
               
            <div id="divCon">
                <div style="background: #333134;padding:30px;">
                    <table>
                        <tr>
                            <td rowspan="2">
                                <span style="font-size: 5rem;vertical-align: middle;
                                border:3px solid #EEEEEE;padding:0px 5px;font-weight:700;
                                color:#EEEEEE;">V</span>
                            </td>
                            @if($voucherFilter->payment_status == 'paid')
                            <span style="border:3px solid #EEEEEE;;padding:15px 30px;font-size:25px;font-weight:bold;color:#EFBC4F;float: right;">PAID</span>
                            @endif
                            <td>
                                <span style="vertical-align: middle;font-size: 2rem;font-weight:700;margin: 0px 5px;color:#EEEEEE;">ဝိမုတ္တိခေတ်</span>
                                <span style="vertical-align: middle;font-size: 1.4rem;font-weight:700;color:#EEEEEE;">စိန်ရတနာဆိုင်</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size: 1.4rem;font-weight:700;margin:0px 5px;color:#EEEEEE;">Vimukti Uga </span>
                                <span style="font-size:1.3rem;color:#EEEEEE;">Jewellery</span>
                            </td>
                        </tr>
                    </table>
                    <table style="margin-top: 10px;">
                        <tr>
                            <td>
                                <span style="font-size:1.3rem; font-weight: bold;color:#EEEEEE;">( C - ၂၁၆ / ၂၁၇ / ၂၁၈ ) ပထမထပ် ၊ Time City ၊ ကျွန်းတောလမ်း ၊ ရန်ကုန် ။</span>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span style="font-size:1.3rem;font-weight:bold;color:#EEEEEE;">09 795372480 [ Shop ] , 09 250357584 [ Shop ] , 09 4500 26751 [ Online Order ]</span>
                            </td>
                        </tr>
                    </table>
                </div>
        
                <div style="width: 100%;background:#EEEEEE;padding:50px;">
                   
                        <table style="width:100%;">
                            <tr>
                                <td style="font-weight: bold;font-size:1.3rem;width:60%;">To:</td>
                                <td style="font-weight: bold;font-size:1.3rem;">INVOICE</td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;font-size:1.3rem;">Name: </span>{{$voucherFilter->customer != null ? $voucherFilter->customer->name : ""}}</td>
                                <td><span style="font-weight: bold;font-size:1.3rem;">Voucher No: </span>{{$voucherFilter->voucher_no}}</td>
                            </tr>
        
                            <tr>
                                <td><span style="font-weight: bold;font-size:1.3rem;">Address: </span>{{$voucherFilter->customer != null ? $voucherFilter->customer->address : ""}}</td>
                                <td><span style="font-weight: bold;font-size:1.3rem;">Date: </span>{{date_format($voucherFilter->created_at,'d/M/Y')}}</td>
                            </tr>
        
                            <tr>
                                <td><span style="font-weight: bold;font-size:1.3rem;">Phone: </span>{{$voucherFilter->customer != null ? $voucherFilter->customer->ph_no : ""}}</td>
                                
                            </tr>
                        </table>
                   
                    
                </div>
                <div>
                    <table style="width: 100%;">
                        <tr>
                            <th style="background: #EFBC4F;color:#333134;padding:20px 0px;width:50%;text-align:center;">ITEM DESCRIPTION</th>
                            <th style="background: #333134;color:#EEEEEE;text-align:center;">PRICE</th>
                            <th style="background: #333134;color:#EEEEEE;text-align:center;">QTY</th>
                            <th style="background: #333134;color:#EEEEEE;text-align:center;">TOTAL</th>
                        </tr>
                        <tr style="background:#EEEEEE;">
                            <td style="padding:20px 0px;text-align:center;font-weight:bold;">Product Code : {{$voucherFilter->positem[0]->code}}</td>
                            <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{number_format($voucherFilter->positem[0]->total_price)}}</td>
                            <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{$voucherFilter->positem[0]->quantity}}</td>
                            <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{number_format($voucherFilter->total_price)}}</td>
                        </tr>
                        @php
                    $gem_weight = json_decode($voucherFilter->positem[0]->weight);
                    $gem_type = json_decode($voucherFilter->positem[0]->gem_type);
                    $gem_quantity = json_decode($voucherFilter->positem[0]->gem_quantity);
                    $weight_type = json_decode($voucherFilter->positem[0]->weight_type);
                    $length = count($gem_type);
                @endphp
                @for($i = 0 ; $i < count($gem_type); $i++)
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{$gem_type[$i]}}-{{$gem_weight[$i]}} @if($weight_type[$i] == 1) Carat @else Ratti @endif [{{$gem_quantity[$i]}}-pcs]</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                @endfor
                
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">Gold - @if($voucherFilter->positem[0]->gold_quantity_k){{$voucherFilter->positem[0]->gold_quantity_k}} k @endif @if($voucherFilter->positem[0]->gold_quantity_k){{$voucherFilter->positem[0]->gold_quantity_p}} p @endif @if($voucherFilter->positem[0]->gold_quantity_k){{$voucherFilter->positem[0]->gold_quantity_y}} y @endif</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">[Nw-{{$voucherFilter->positem[0]->net_weight}}]</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                    </table>
                </div>
                <div style="display:flex;">
                    <div style="width: 55%;">
                        @if($voucherFilter->is_can_return == 1)
                        <ul>
                            <li>
                                မည်သည့်လက်ဝတ်ရတနာထည်များကိုမဆိုလဲလှယ်/
                                ရောင်းလိုပါက လဲ(၅%) ၊ (၁၀%)
                                ပြန်လည်လက်ခံယူပါသည်။ 
                            </li>
                            <li>
                                ဘောက်ချာ၌ပြင်ရာ၊ဖျက်ရာပါပါက
                                နောက်တစ်ရွက်တောင်းယူပါ။
                            </li>
                            <li>
                                ရောင်း/လဲဲလိုပါက ဘောက်ချာနှင့်တကွ
                            ယူဆောင်လာပါရန် မေတ္တာရပ်ခံအပ်ပါသည်။
                            </li>
                            <li>
                                ဘောက်ချာမပါပါကပြန်လည်ဝယ်ယူ/
                                လဲဲလှယ်ပေးမည်မဟုတ်ပါ။
                            </li>
                            <li>
                                တစ်ပတ်အတွင်းအခမဲ့လဲလှယ်ပေးသည်။
                                (အော်ဒါအပ်ထည်မပါဝင်ပါ)။
                            </li>
                        </ul>
                        @endif
                    </div>
                    <div style="width: 15%;"></div>
                    <div style="width: 30%;">
                        <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;">
                            <div >
                                Sub Total : 
                            </div>
                            <div>
                                {{number_format($voucherFilter->total_price)}}
                            </div>
                        </div>
        
                        <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;background:#EFBC4F;">
                            <div >
                                Grand Total : 
                            </div>
                            <div>
                                {{number_format($voucherFilter->total_price)}}
                            </div>
                        </div>
                
                    </div>
                </div>
        
                <div style="display: flex;justify-content:space-between;@if($voucherFilter->is_can_return == 1) margin-top:50px; @else margin-top:100px; @endif">
                    <div>
                        <span style="padding: 0px 20px;">* ဝယ်ယူအားပေးမှုကို ကျေးဇူးတင်ပါသည်။ *</span>
                    </div>
                    <div>
                        <span style="padding: 0px 20px;">ငွေလက်ခံသူ လက်မှတ် &nbsp;&nbsp;..................................</span>
                    </div>
                </div>
               
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
