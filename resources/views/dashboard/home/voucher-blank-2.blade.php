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
        <a href="{{route('homepage')}}" class="backbtn">Back</a>
        <button class="printbtn" onclick="printDivContent()">Print</button>
    </div>
    <hr>
   
    <div id="divCon">
        {{-- <div style="background: #333134;padding:30px;">
            <table>
                <tr>
                    <td rowspan="2">
                        <span style="font-size: 5rem;vertical-align: middle;
                        border:3px solid #EEEEEE;padding:0px 5px;font-weight:700;
                        color:#EEEEEE;">V</span>
                    </td>
                   
                    <span style="border:3px solid #EEEEEE;;padding:15px 30px;font-size:25px;font-weight:bold;color:#EFBC4F;float: right;">PAID</span>
                   
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
        </div> --}}
        <div style="background: #333134;padding:30px;">
            <div style="display: flex;justify-content:space-between;">
                <div style="margin: auto;display: flex;">
                    <div style="margin-right: 10px;">
                        <span style="font-size: 5rem;vertical-align: middle;
                            border:3px solid #EEEEEE;padding:0px 5px;font-weight:700;
                            color:#EEEEEE;">V</span>
                    </div>
                    <div>
                        <span style="vertical-align: middle;font-size: 2rem;font-weight:700;margin: 0px 5px;color:#EEEEEE;">ဝိမုတ္တိခေတ်</span>
                        <span style="vertical-align: middle;font-size: 1.4rem;font-weight:700;color:#EEEEEE;">စိန်ရတနာဆိုင်</span>
                        <br>
                        <span style="font-size: 1.4rem;font-weight:700;margin:0px 5px;color:#EEEEEE;">Vimukti Uga </span>
                        <span style="font-size:1.3rem;color:#EEEEEE;">Jewellery</span>
                    </div>
                </div>
                
                <div style="">
                    <span style="border:3px solid #EEEEEE;;padding:15px 30px;font-size:25px;font-weight:bold;color:#EFBC4F;float: right;">PAID</span>
                </div>
                
            </div>
            <div style="display:flex;justify-content:center;margin-top: 20px;">
                <span style="font-size:1.3rem; font-weight: bold;color:#EEEEEE;">( C - ၂၁၆ / ၂၁၇ / ၂၁၈ ) ပထမထပ် ၊ Time City ၊ ကျွန်းတောလမ်း ၊ ရန်ကုန် ။</span>
            </div>
            <div style="display:flex;justify-content:center;">
                <span style="font-size:1.3rem;font-weight:bold;color:#EEEEEE;">09 795372480 [ Shop ] , 09 250357584 [ Shop ] , 09 4500 26751 [ Online Order ]</span>
            </div>
        </div>

        <div style="width: 100%;background:#EEEEEE;">
           
                <table style="width:100%;padding:50px;">
                    <tr>
                        <td style="font-weight: bold;font-size:1.3rem;width:60%;">To:</td>
                        <td style="font-weight: bold;font-size:1.3rem;">INVOICE</td>
                    </tr>
                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Name: </span></td>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Voucher No: </span></td>
                    </tr>

                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Address: </span></td>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Date: </span></td>
                    </tr>

                    <tr>
                        <td><span style="font-weight: bold;font-size:1.3rem;">Phone: </span></td>
                        
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
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                </tr>
                <tr style="background:#D0D1D3;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                <tr style="background:#D0D1D3;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
                <tr style="background:#EEEEEE;">
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;color:#EEEEEE;">.</td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                    <td style="padding:20px 0px;text-align:center;font-weight:bold;"></td>
                </tr>
            </table>
        </div>
        <div style="display:flex;">
            <div style="width: 55%;">
              
               
               
            </div>
            <div style="width: 15%;"></div>
            <div style="width: 30%;">
                <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;">
                    <div >
                        Discount : 
                    </div>
                    <div>
                        .
                    </div>
                </div>
                <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;">
                    <div >
                        Service Charges : 
                    </div>
                    <div>
                        .
                    </div>
                </div>
                <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;">
                    <div >
                        Sub Total : 
                    </div>
                    <div>
                       .
                    </div>
                </div>

                <div style="padding:20px 20px;font-weight:bold;display:flex;justify-content:space-between;background:#EFBC4F;">
                    <div >
                        Grand Total : 
                    </div>
                    <div>
                        .
                    </div>
                </div>
        
            </div>
        </div>

        <div style="display: flex;justify-content:space-between;margin-top:100px;">
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