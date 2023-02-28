@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-md-12">
                <div class="row">

                    <!-- Sales Card -->
                    <div class="col-md-4">
                        <div class="card info-card sales-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Sales</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{$total_sale_count}}</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card info-card revenue-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title">Revenue</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{number_format($total_sale_price)}}Ks</h6>
                                    </div>
                                  
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- End Sales Card -->
                    @php 
                    $date = \Carbon\Carbon::now()->format('y-m-d');
                    $datetime = strtotime($date);
                    $datenow = date('D,M d,Y',$datetime);
                     @endphp
                    <div class="col-md-8">
                       <div class="card">
                            <div class="card-title border-bottom text-center">
                                <span class="fs-3">Today ({{$datenow}})</span>
                            </div>
                            <div class="card-body">
                               <div class="row">
                                    <div class="col-md-6">
                                        <table class="table border">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="border">No</th>
                                                    <th class="border">Products (IN)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i = ($product_in->currentpage() - 1) * $product_in->perpage() + 1 ?>
                                                @foreach($product_in as $p_in)
                                                <tr class="text-center">
                                                    <td class="border">{{$i++}}</td>
                                                    <td class="border"><a href="{{route('product.detail',$p_in->id)}}">{{$p_in->code}}</a></td>  
                                                </tr>
                                                @endforeach
                                                @if(count($product_in) == 0)
                                                    <tr>
                                                        <td colspan="2" class="text-center text-muted">No Product In Today</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-center">{{ $product_in->links() }}</div>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table border">
                                            <thead>
                                                <tr class="text-center">
                                                    <th class="border">No</th>
                                                    <th class="border">Products (OUT)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $o = ($product_out->currentpage() - 1) * $product_out->perpage() + 1 ?>
                                                @foreach($product_out as $p_out)
                                                <tr class="text-center">
                                                    <td class="border">{{$o++}}</td>
                                                    <td class="border"><a href="{{route('product.detail',$p_out->id)}}">{{$p_out->code}}</a></td>  
                                                </tr>
                                                @endforeach
                                                @if(count($product_out) == 0)
                                                    <tr>
                                                        <td colspan="2" class="text-center text-muted">No Product Out Today</td>
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
    </section>
@endsection
