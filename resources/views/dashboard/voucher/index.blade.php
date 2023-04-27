<!DOCTYPE html>
<html lang="en">
<head>
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Voucher</title>
    <style>

        
       .headContainer{
            width: 100%;
            display: flex;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color:#333134;
       }

       .backbtn{
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-color:#EFBC4F;
            margin-right: 10px;
            margin-left: 10px;
       }
       
       .backbtn:hover {
        background:#EFBC4F;
        color: white;
        }

        .printbtn{
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-color: #EFBC4F;
       }
       
       .printbtn:hover {
        background: #EFBC4F;
        color: white;
        }
       
    </style>
    
</head>
<body>
    <div class="headContainer">
        <a href="{{route('pos')}}" class="backbtn">Back</a>
        <button class="printbtn" onclick="printDivContent()">Print</button>
    </div>
    <hr>
   
    <div id="divCon">
        <div style="background: #333134;padding:30px;">
            <table>
                <tr>
                    <td rowspan="2">
                        <span style="font-size: 5rem;vertical-align: middle;
                        border:3px solid #EEEEEE;padding:0px 5px;font-weight:700;
                        color:#EEEEEE;">V</span>
                    </td>
                    @if($pos->payment_status == 'paid')
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

        <div style="width: 100%;background:#EEEEEE;">
           
                <table style="width:100%;padding:50px;">
                    <tr>
                        <td style="font-weight: bold;font-size:1.3rem;width:60%;">To:</td>
                        <td style="font-weight: bold;font-size:1.3rem;">INVOICE</td>
                    </tr>
                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Name: </span>{{$pos->customer != null ? $pos->customer->name : ""}}</td>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Voucher No: </span>{{$pos->voucher_no}}</td>
                    </tr>

                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Address: </span>{{$pos->customer != null ? $pos->customer->address : ""}}</td>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Date: </span>{{date_format($pos->created_at,'d/M/Y')}}</td>
                    </tr>

                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Phone: </span>{{$pos->customer != null ? $pos->customer->ph_no : ""}}</td>
                        
                    </tr>
                </table>
           
            
        </div>
        <div>
            <table style="width: 100%;">
                <tr>
                    <th style="background: #EFBC4F;color:#333134;padding:20px 0px;width:50%;">ITEM DESCRIPTION</th>
                    <th style="background: #333134;color:#EEEEEE;">PRICE</th>
                    <th style="background: #333134;color:#EEEEEE;">QTY</th>
                    <th style="background: #333134;color:#EEEEEE;">TOTAL</th>
                </tr>
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">Product Code : {{$pos->positem[0]->code}}</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{number_format($pos->positem[0]->total_price)}}</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{$pos->positem[0]->quantity}}</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">{{number_format($pos->total_price)}}</td>
                </tr>
                @php
                    $gem_weight = json_decode($pos->positem[0]->weight);
                    $gem_type = json_decode($pos->positem[0]->gem_type);
                    $gem_quantity = json_decode($pos->positem[0]->gem_quantity);
                    $weight_type = json_decode($pos->positem[0]->weight_type);
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
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">Gold - @if($pos->positem[0]->gold_quantity_k){{$pos->positem[0]->gold_quantity_k}} k @endif @if($pos->positem[0]->gold_quantity_k){{$pos->positem[0]->gold_quantity_p}} p @endif @if($pos->positem[0]->gold_quantity_k){{$pos->positem[0]->gold_quantity_y}} y @endif</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">[Nw-{{$pos->positem[0]->net_weight}}]</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
            </table>
        </div>
        <div style="display:flex;">
            <div style="width: 55%;">
                @if($pos->is_can_return == 1)
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
                        {{number_format($pos->total_price)}}
                    </div>
                </div>

                <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;background:#EFBC4F;">
                    <div >
                        Grand Total : 
                    </div>
                    <div>
                        {{number_format($pos->total_price)}}
                    </div>
                </div>
        
            </div>
        </div>

        <div style="display: flex;justify-content:space-between;@if($pos->is_can_return == 1) margin-top:50px; @else margin-top:100px; @endif">
            <div>
                <span style="padding: 0px 20px;">* ဝယ်ယူအားပေးမှုကို ကျေးဇူးတင်ပါသည်။ *</span>
            </div>
            <div>
                <span style="padding: 0px 20px;">ငွေလက်ခံသူ လက်မှတ် &nbsp;&nbsp;..................................</span>
            </div>
        </div>
       
    </div>
</body>
</html>

<script>
    function printDivContent() {
        var contentOfDiv = document.getElementById("divCon").innerHTML;
        var newWin = window.open('', '', 'height=1000, width=1000');
        newWin.document.write(contentOfDiv);
        newWin.document.write('');
        newWin.document.close();
        newWin.print();
    }
</script>