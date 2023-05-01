@extends('layouts.app')
@section('title', 'Report')

@section('content')
    <div class="d-flex align-items-center justify-content-between">
        <div class="pagetitle">
            <h1>Report Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Home</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Report List </h5>
                        <div class="float-right">
                            <?php echo '<div class="float-right font-weight-bold" style="float:right;"> <strong>Product In:  </strong>  '.number_format($product_in_total_price).'</div>';?><br/>
                            <?php echo '<div class="float-right font-weight-bold" style="float:right;"> <strong>Product Out:  </strong>  '.number_format($product_out_total_price).'</div>';?>

                        </div>
                        <div class="row">
                            <div class="col-lg-12 my-3">
                                
                                   <form action="{{route('report.filter')}}" method="POST" class="row">
                                    @csrf
                                        <div class="col-lg-4">
                                            <label for="from_date" style="font-weight: 700" class="mb-2">Date (From)</label>
                                            <input type="date" class="form-control" name="from_date">
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="to_date" style="font-weight: 700" class="mb-2">Date (To)</label>
                                            <input type="date" class="form-control" name="to_date">
                                        </div>
                                        <div class="col-lg-4" style="margin-top: 30px;">
                                            <button class="btn btn-primary" type="submit">Filter</button>
                                            <a href="{{route('report')}}" class="btn btn-secondary">Clear</a>
                                        </div>
                                   </form>
                               
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover border" id="reportTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border">#</th>
                                                <th scope="col" class="border">Product In</th>
                                                <th scope="col" class="border">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = ($product_in->currentpage() - 1) * $product_in->perpage() + 1 ?>
                                            @foreach($product_in as $p_in)
                                            <tr>
                                                <td class="border">{{$i++}}</td>
                                                <td class="border">{{$p_in->code}}</td>
                                                <td class="border">{{number_format($p_in->total_price)}}</td>
                                            </tr>
                                            @endforeach
                                            @if(count($product_in) == 0)
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">No product in these days.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>

                                    <div class="pagination justify-content-center">{{ $product_in->links() }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover border" id="reportTable">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="border">#</th>
                                                <th scope="col" class="border">Product Out</th>
                                                <th scope="col" class="border">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $o = ($product_out->currentpage() - 1) * $product_out->perpage() + 1 ?>
                                            <?php $total = 0 ;?>

                                            @foreach($product_out as $p_out)

                                            <tr>
                                                <td class="border">{{$o++}}</td>
                                                <td class="border" >{{$p_out->code}}</td>
                                                <td class="border">{{number_format($p_out->total_price)}}</td>
                                                <?php $total += $p_out->total_price; ?>

                                            </tr>
                                            @endforeach


                                            @if(count($product_out) == 0)
                                                <tr>
                                                    <td colspan="3" class="text-center text-muted">No product out these days.</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                        
                                    </table>


                                    <div class="pagination justify-content-center">{{ $product_out->links() }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection