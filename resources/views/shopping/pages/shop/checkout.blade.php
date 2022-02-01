@extends('shopping.index')

@push('title')
    Checkout | E-Shopper
@endpush

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Trang</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Nhập địa chỉ giao hàng</h2>
            <form id="form-order-info">
                @csrf
                <div class="row">
                    <input type="hidden" name="total_price"/>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Họ và tên: <label style="font-weight:bolder;color:black">{{Auth::guard('web')->user()->name}}</label></label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Số điện thoại: <label style="font-weight:bolder;color:black" id="phonenumber">@if(Auth::guard('web')->user()->phone_number == null) <a href="" style="color: red">Cập nhật số điện thoại</a> @else {{Auth::guard('web')->user()->phone_number}} @endif</label></label>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Tỉnh / Thành phố<span>*</span></label>
                            <select class="form-control" name="province" id="provinces" required>
                                <option value="-1" selected="selected">Chọn ...</option>
                                @foreach ($provinces as  $province)
                                    <option value="{{$province->id}}">{{$province->name}}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback text-danger" id="errorProvince">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Quận / Huyện<span>*</span></label>
                            <select class="form-control" name="district" id="districts" required>
                                <option value="-1" selected="selected">Chọn ...</option>
                            </select>
                            <div class="invalid-feedback text-danger" id="errorDistrict">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Xã / Phường<span>*</span></label>
                            <select class="form-control" name="ward" id="wards" required>
                                <option value="-1" selected="selected">Chọn ...</option>
                            </select>
                            <div class="invalid-feedback text-danger" id="errorWard">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="form-group">
                            <label>Cụ thể<span>*</span></label>
                            <input class="form-control" type="text" name="detailsAddress" placeholder="Số nhà, tên đường, ..." required>
                            <div class="invalid-feedback text-danger" id="errorDetails">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        
        <div class="review-payment">
            <h2>Kiểm tra và Thanh toán</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Sản phẩm</td>
                        <td class="description"></td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Tổng</td>
                        <td></td>
                    </tr>
                </thead>
                @php
                    $total = 0;
                @endphp
                <tbody>
                    @if (session('cart'))
                            @foreach (session('cart') as $id => $details)
                                @php
                                    $cart = [];
                                    $total += $details['price'] * $details['quantity'];
                                @endphp
                                <tr data-id="{{ $id }}">
                                    <td class="cart_product">
                                        <a href=""><img width="100px" height="100px" src="{{ $details['image'] ? Storage::url($details['image']->image) : "https://vnpi-hcm.vn/wp-content/uploads/2018/01/no-image-800x600.png"}}" alt=""></a>
                                    </td>
                                    <td class="cart_description">
                                        <h4>{{ $details['name'] }}</h4>
                                        <p>Mã sản phẩm: {{ $details['id'] }}</p>
                                    </td>
                                    <td class="cart_price">
                                        <p>{{ number_format($details['price']) . ' đ'  }}</p>
                                    </td>
                                    <td class="cart_quantity">
                                        <div class="cart_quantity_button">
                                            <p>{{ $details['quantity'] }}</p>
                                        </div>
                                    </td>
                                    <td class="cart_total">
                                        <p class="cart_total_price">
                                            {{ number_format($details['price'] * $details['quantity']) . ' đ' }}</p>
                                    </td>
                                    <td class="cart_delete">

                                        <button class="btn btn-danger btn-sm remove-from-cart">X</button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Tổng tiền</td>
                                    <td class="text-right">{{ number_format($total). " đ" }}</td>
                                </tr>
                                <tr>
                                    @php
                                        $vat = $total*10/100
                                    @endphp
                                    <td>VAT</td>
                                    <td class="text-right">{{ number_format($vat). " đ" }}</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Phí vận chuyển</td>
                                    <td class="text-right">Free</td>										
                                </tr>
                                <tr>
                                    <td><label>Thanh toán</label></td>
                                    <td class="text-right"><span>{{ number_format( $total + $vat ) . " đ"}}</span></td>
                                    <input type="hidden" id="total_price" value="{{ $total + $vat }}" />
                                </tr>
                                <tr>
                                    <td><label>Hình thức thanh toán</label></td>
                                </tr>
                                
                            </table>
                            <table>
                                <select class="form-control" name="payment" required>
                                    <option  value="cod" selected>
                                        Thanh toán khi nhận hàng (COD)
                                    </option>
                                    <option value="online">
                                        Thanh toán cổng thanh toán online
                                    </option>
                                </select>
                            </table>
                            <hr>
                            <table>
                                <div class="single-widget payement text-center">
                                    <div class="content">
                                        <img src="{{asset('images/shop/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                            </table>
                            <hr>
                            <table>
                                <div class="text-right">
                                    <a id="btn_order" class="btn btn-warning">Đặt hàng</a>
                                </div>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection

@push('js')
{{-- Flash messages --}}
@if (session()->has('success'))
    <script>
        toastr.success("{{session()->get('success')}}")
    </script>
@endif
@if (session()->has('error'))
    <script>
        toastr.error("{{session()->get('error')}}")
    </script>
@endif
{{-- Location 4 delivery --}}
<script>
    $(document).ready(function(){
        $(document).on('change', '#provinces', function() {
            $("#errorProvince").text("")

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('shopping.getDistricts') }}",
                data: { province_id: $('#provinces').find(":selected").val() },
                success: function(data) {
                    $('#districts').empty()
                    $('#districts').prepend(`<option value="-1" selected="selected">Chọn ...</option>`)
                    $('#wards').empty()
                    $('#wards').prepend(`<option value="-1" selected="selected">Chọn ...</option>`)
                    
                    if (data.status) {
                        Object.keys(data.districts).forEach(key => {
                            $('#districts').append(`
                                <option value="`+data.districts[key]['id']+`">`+data.districts[key]['name']+`</option>
                            `)
                        })
                    }
                    else {
                        toastr.error('Không thể tải lên dữ liệu vị trí, hãy thửu lại')
                    }
                },
                error: function(xhr) {

                }
            })
        })
    })
    $(document).ready(function() {
        $(document).on('change', '#districts', function() {
            $("#errorDistrict").text("")

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('shopping.getWards') }}",
                data: { district_id: $('#districts').find(":selected").val() },
                success: function(data) {
                    $('#wards').empty()
                    $('#wards').prepend(`<option value="-1" selected="selected">Chọn ...</option>`)
                    
                    if (data.status) {
                        Object.keys(data.wards).forEach(key => {
                            $('#wards').append(`
                                <option value="`+data.wards[key]['id']+`">`+data.wards[key]['name']+`</option>
                            `)
                        })
                    }
                    else {
                        toastr.error('Không thể tải lên dữ liệu vị trí, hãy thửu lại')
                    }
                },
                error: function(xhr) {

                }
            })
        })
    })

    $(document).ready(function() {
        $(document).on('change','#wards', function() {
            $("#errorWard").text("")
        })
        $(document).on('keydown', 'input[name=detailsAddress]',function() {
            $("#errorDetails").text("")
        })
    })
</script>
{{-- Click order --}}
<script>
    $(document).ready(function() {
        $('#btn_order').click(function() {
            let total = $('#total_price').val()
            $('[name="total_price"]').val(total)
            let formData = new FormData($('#form-order-info')[0]) 
            let count = 0;

            $detailAddress = $('input[name=detailsAddress]')
            let $province = $('#provinces')
            let $district = $('#districts')
            let $ward = $('#wards')
            let $phonenumber = $('#phonenumber').text();

            if ($province.val() == '-1'){
                $("#errorProvince").text("Trường này không được để trống") 
            } else {
                $("#errorProvince").text("")
                count +=1
            }

            if ($district.val() == '-1'){
                $("#errorDistrict").text("Trường này không được để trống") 
            } else {
                $("#errorDistrict").text("")
                count +=1
            }

            if ($ward.val() == '-1'){
                $("#errorWard").text("Trường này không được để trống") 
            } else {
                $("#errorWard").text("")
                count +=1
            }

            if ($detailAddress.val() == ''){
                $("#errorDetails").text("Trường này không được để trống") 
            } else {
                $("#errorDetails").text("")
                count +=1
            }

            if ($.isNumeric($phonenumber)){
                count+=1
            }
            
            if (count == 5) {
                if ($('[name="payment"]').find(":selected").val() == "cod") {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{route('shopping.payments.cod')}}",
                        data: formData,
                        processData: false,
                        contentType: false, 
                        success: function(data) {
                            if (data.status) {
                                toastr.success('Đơn hàng đã được gửi và đang được xử lý!')
                                setTimeout(function() {
                                    window.location.assign("{{url('/')}}")
                                }, 2000);
                            }
                            else {
                                toastr.error('Đã có lỗi xảy ra với đơn hàng của bạn, hãy thử lại!')
                            }
                        },
                        error: function(xhr) {

                        }
                    })
                } else {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{route('shopping.payments.vnpaycreate')}}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            window.location.assign(data.link)
                        },
                        error: function(xhr) {
                            
                        }
                    })
                }
            } else {
                toastr.error('Đã xảy ra lỗi, vui lòng kiểm tra các trường ở trên!')
            }
        })
    })
</script>
@endpush