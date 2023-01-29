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
            background-color: rgb(161, 82, 82);
       }

       .backbtn{
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-color: #65afec;
            margin-right: 10px;
            margin-left: 10px;
       }
       
       .backbtn:hover {
        background: #65afec;
        color: white;
        }

        .printbtn{
            border: 2px solid black;
            background-color: white;
            color: black;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
            border-color: #2196F3;
       }
       
       .printbtn:hover {
        background: #2196F3;
        color: white;
        }

       

        /* table {
        width: 100%;
        border-collapse: collapse;
        } */


        /* th,td{
            height: 50px;
        } */

       

        

    </style>
    
</head>
<body>
    <div class="headContainer">
        <a href="{{route('pos')}}" class="backbtn">Back</a>
        <button class="printbtn" onclick="printDivContent()">Print</button>
    </div>
    <hr>
   
    <div id="divCon">
        
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
                    <span style="font-size: 4rem;vertical-align: middle;
                    border:3px solid rgb(161, 82, 82);
                    padding:0px 5px;font-weight:700;margin-right:20px;color:rgb(161, 82, 82);">V</span>
                    <span style="vertical-align: middle;font-size: 2rem;font-weight:700;margin-right:5px;color:rgb(161, 82, 82);">ဝိမုတ္တိခေတ်</span>
                    <span style="vertical-align: middle;font-size: 1.4rem;font-weight:700;color:rgb(161, 82, 82);">စိန်ရတနာဆိုင်</span>
                    <span style="font-size: 4rem;vertical-align: middle;
                    border:3px solid rgb(161, 82, 82);
                    padding:0px 5px;font-weight:700;margin-left:20px;color:rgb(161, 82, 82);">V</span>
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
            <span style="font-size: 1.1rem;font-weight:bold;color:rgb(161, 82, 82);">ဝယ်သူအမည် - {{$pos->customer->name}}</span>
            <span style="font-size: 1.1rem;font-weight:bold;float: right;color:rgb(161, 82, 82);">နေ့စွဲ - {{date_format($pos->created_at,'d.m.y')}}</span>
        </p>
        <p>
            <span style="font-size: 1.1rem;font-weight:bold;color:rgb(161, 82, 82);">နေရပ်လိပ်စာ - {{$pos->customer->address}}</span>
            <span style="font-size: 1.1rem;font-weight:bold;float: right;color:rgb(161, 82, 82);">ဖုန်းနံပါတ် - {{$pos->customer->ph_no}}</span>
        </p>
        <table style=" width: 100%;
        border-collapse: collapse;">
            <tr >
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">No</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Product Code</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Gem Type</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Gold Weight</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Quantity</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Net Weight</th>
                <th style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;white-space: nowrap;">Amount</th>
            </tr>
            @php $no = 1; @endphp
           @foreach ($pos->positem as $item)
           <tr style="text-align: center;">
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$no++}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->code}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->gem_type}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->gold_quantity_p}}.{{$item->gold_quantity_y}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->quantity}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->net_weight}}</td>
                <td style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;">{{$item->price}}</td>
            </tr>
           @endforeach
           
            <tr>
                <td colspan="3" style="border : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                 -> မည်သည့်လက်ဝတ်ရတနာထည်များကိုမဆို<br>
                 လဲလှယ်/ရောင်းလိုပါက  [ လဲ(၅%) ၊ (၁၀%) ]<br>
                  ပြန်လည်လက်ခံယူပါသည်။ 
                </td>
                <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);height: 50px;" colspan="2">
                    <div style="border: 2px solid white;padding:13px 0px;">
                        Discount Amount
                    </div>
                </td>
                <td colspan="2" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;text-align:center;">@if($pos->discount == null)0 Ks @else {{$pos->discount}} @endif</td>
            </tr>
            <tr>
                <td colspan="3" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                   -> ရောင်း/လဲဲလိုပါက ဘောက်ချာနှင့်တကွ<br>
                   ယူဆောင်လာပါရန် မေတ္တာရပ်ခံအပ်ပါသည်။
                </td>
                <td style="text-align:center;color:white;background-color: rgb(161, 82, 82); border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px;" colspan="2">
                    
                    <div style="border: 2px solid white;padding:13px 0px;color:white;">
                        Total Amount
                    </div>
                </td>
                <td  colspan="2" style="border: 3px solid rgb(161, 82, 82);color:rgb(161, 82, 82);height: 50px; text-align:center;">{{$pos->total_price}} Ks</td>
            </tr>
            <tr>
                <td colspan="3" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                   -> ဘောက်ချာမပါပါကပြန်လည်ဝယ်ယူ/<br>
                   လဲဲလှယ်ပေးမည်မဟုတ်ပါ။ <br>
                   ->တစ်ပတ်အတွင်းအခမဲ့လဲလှယ်ပေးသည်။<br>
                   (အော်ဒါအပ်ထည်မပါဝင်ပါ)။
                </td>
                <td colspan="4" style="text-align:justify;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                    * စိန် နှင့်ရတနာ အထည်များ ကို စံ ၁၃ ပဲရည် <br>
                     အသုံးပြု၍ သေသပ်သောလက်ရာ ၊ မှန်ကန်သော <br> စျေးနှုန်းတို့ဖြင့် ရောင်းချပေးလျှက်ရှိပါသည်။ *
                </td>
            </tr>

            <tr>
                <td colspan="3" style="border-style : none!important;font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                    ငွေလက်ခံသူ လက်မှတ် - {{$created_by->name}}
                </td>
                <td colspan="4" style="font-weight:bold;color:rgb(161, 82, 82);height: 50px;">
                    * ဝယ်ယူအားပေးမှုကို ကျေးဇူးတင်ပါသည်။ *
                </td>
            </tr>
        </table>
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
