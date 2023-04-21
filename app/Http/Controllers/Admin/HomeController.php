<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Pos;

use Carbon\Carbon;



class HomeController extends Controller
{
    public function index()
    {
        $product_in = Product::select('id','code')
        ->where("status",1)
        ->whereDate("created_at",now()->today())->paginate(3);
        $product_out = Product::select('id','code')
        ->where("status",1)->where("product_in",0)
        ->whereDate("updated_at",now()->today())->paginate(3);
        $total_sale_count = Pos::where("status",1)
        ->where("payment_status","paid")
        ->where("is_return",0)->count();
        $total_sale_price = Pos::where("status",1)
        ->where("payment_status","paid")
        ->where("is_return",0)->sum("total_price");
        // return $total_sale_price;

        return view('dashboard.home.index',compact("product_in","product_out","total_sale_count","total_sale_price"));
    }

    public function handle()
    {
        $filename = "backup-" . Carbon::now()->format('Y-m-d') . ".gz";
        $command = "mysqldump --user=" . env('DB_USERNAME') ." --password=" . env('DB_PASSWORD') . " --host=" . env('DB_HOST') . " " . env('DB_DATABASE') . "  | gzip > D:/backups/Vimukti_Uga/" . $filename;
        $returnVar = NULL;
        $output  = NULL;
        exec($command, $output, $returnVar);
    }
}
