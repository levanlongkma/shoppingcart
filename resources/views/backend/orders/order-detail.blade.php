@extends('backend.layouts.main')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">

                    <div class="page-title">
                        <h1>Đơn hàng</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
            </div>
            <div class="col-sm-4 ">
                <div class="form-inline page-header float-right ">
                    
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong class="card-title text-dark">Chi tiết đơn hàng</strong>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5>From</h5>
                                <p style="font-size: 12px"> Lê Văn Tưởng <br>
                                    Phone: 0972630235 <br>
                                    Email: vantuongno1@gmail.com <br>
                                    Add: Mê Linh - Hà Nội <br>
                                </p>
                                
                                
                            </div>  
                                
                            <div class="col">
                                <h5>To</h5>
                                <p style="font-size: 12px">{{ $order->name }} <br>
                                    Phone: {{ $order->phone_number }} <br>
                                    Add: {{ $order->ward."-".$order->district."-".$order->city }} <br>
                                    Detail: {{ $order->details_address }}
                                </p>
                            </div>

                            <div class="col">
                                <h5>Order-ID: {{ $order->order_id }}</h5>
                                <p style="font-size: 12px">
                                    Subtotal: {{ number_format($order->subtotal)." đ" }} <br>
                                    Payment Type: {{ $order->payment_type }} <br>
                                    Payment Status: Completed! <br>
                                    Note: {{ $order->note_shipping }}
                                </p>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <thead>
                                    
                                    <th>Mã đơn hàng</th>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </thead>
                            </thead>
                            <tbody>
                                @foreach ($orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->order_id }}</td>
                                        <td>{{ $orderDetail->products_id }}</td>
                                        <td>{{ $orderDetail->name }}</td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td>{{ number_format($orderDetail->total)." đ " }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>
@endsection