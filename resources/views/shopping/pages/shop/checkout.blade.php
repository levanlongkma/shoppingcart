@extends('shopping.index')

@push('title')
    Checkout | E-Shopper
@endpush

@section('content')
    <form method="POST" action="{{ route('shopping.order_detail') }}">
        @csrf
        <section id="cart_items">
            <div class="container">
                <div class="breadcrumbs">
                    <ol class="breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li class="active">Check out</li>
                    </ol>
                </div>
                <!--/breadcrums-->
                <div class="register-req">
                    <p>Vui lòng điền thông tin cá nhân và địa chỉ </p>
                </div>
                <!--/register-req-->
                <div class="shopper-informations">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="bill-to">
                                <p>Thông tin người nhận</p>

                                <input style="margin-bottom: 10px" name="name" class="form-control" type="text"
                                    placeholder="Họ và tên*">

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input style="margin-bottom: 10px" name="phone_number" class="form-control" type="text"
                                    placeholder="Điện thoại*">

                                @error('phone_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                                <input style="margin-bottom: 10px" name="email" class="form-control" type="email"
                                    placeholder="Email">

                                <textarea class="form-control" name="note_shipping" placeholder="Ghi chú"
                                    rows="10"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-4 clearfix">
                            <div class="bill-to">
                                <p>Địa chỉ</p>
                                <div class="shopper-info ">
                                    <select name="city" style="margin-bottom: 10px" id="city-dropdown"
                                        class="form-control">
                                        <option>-- Thành phố --</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                
                                    @error('city')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <select style="margin-bottom: 10px" name="district" id="district-dropdown"
                                        class="form-control">
                                        <option value="" selected="selected">--Quận / Huyện--</option>
                                    </select>

                                    @error('district')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <select style="margin-bottom: 10px" name="ward" id="ward-dropdown"
                                        class="form-control">
                                        <option value="" selected="selected">--Phường / Xã / Thị trấn--</option>
                                    </select>

                                    @error('ward')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <textarea class="form-control" name="details_address" placeholder="Địa chỉ cụ thể *"
                                        rows="10"></textarea>

                                    @error('details_address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4">

                        </div>

                    </div>
                </div>
                <div class="review-payment">
                    <h2>Review & Payment</h2>
                </div>

                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">Hình ảnh</td>
                                <td>Tên sản phẩm</td>
                                <td class="price">Giá</td>
                                <td class="quantity">Số lượng</td>
                                <td class="total">Thành tiền</td>
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
                                            <a href=""><img width="100px" height="100px"
                                                    src="{{ $details['image'] ? Storage::url($details['image']->image) : 'https://vnpi-hcm.vn/wp-content/uploads/2018/01/no-image-800x600.png' }}"
                                                    alt=""></a>
                                        </td>
                                        <td class="cart_description">
                                            <h4>{{ $details['name'] }}</h4>
                                            <p>Mã sản phẩm: {{ $details['id'] }}</p>
                                        </td>
                                        <td class="cart_price">
                                            <p>{{ number_format($details['price']) . ' đ' }}</p>
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
                                            <td>{{ number_format($total) . ' đ' }}</td>
                                        </tr>
                                        <tr>
                                            @php
                                                $vat = ($total * 10) / 100;
                                            @endphp
                                            <td>VAT</td>
                                            <td>{{ number_format($vat) . ' đ' }}</td>
                                        </tr>
                                        <tr class="shipping-cost">
                                            <td>Phí vận chuyển</td>
                                            <td>Free</td>
                                        </tr>
                                        <tr>
                                            <td>Thanh toán</td>
                                            @php
                                                $subtotal = $total + $vat
                                            @endphp
                                            <td><span >{{ number_format($subtotal) . ' đ' }}</span></td>
                                            <input type="hidden" name="subtotal" value="{{ $subtotal }}">
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>


                <div class="payment-options">
                    <span>
                        <label><input type="checkbox"> Direct Bank Transfer</label>
                    </span>
                    <span>
                        <label><input type="checkbox"> Check Payment</label>
                    </span>
                    <span>
                        <label><input type="checkbox"> Paypal</label>
                    </span>
                    <span>
                        <div>
                            <a class="btn btn-primary" href="{{ route('shopping.cart') }}">Quay lại giỏ hàng</a>
                            <button type="submit" name="submit" class="btn btn-primary">Thanh toán</button>
                        </div>
                    </span>

                </div>

            </div>

        </section>
        <!--/#cart_items-->
    </form>
@endsection

@push('js')
    {{-- Flash messages --}}
    @if (session()->has('success'))
        <script>
            toastr.success("{{ session()->get('success') }}")
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            toastr.error("{{ session()->get('error') }}")
        </script>
    @endif
    @if (session()->has('error_checkout'))
        <script>
            toastr.error("{{ session()->get('error_checkout') }}")
        </script>
    @endif
    {{-- Location 4 delivery --}}
    <script>
        $(function() {
            $("#city-dropdown").on('change', function() {
                var matp = this.value;
                $("#district-dropdown").html(" ");
                $('#district-dropdown').prepend(
                    `<option value="-1" selected="selected">--Quận / Huyện--</option>`)
                $.ajax({
                    url: "{{ route('shopping.getDistricts') }}",
                    type: "POST",
                    data: {
                        matp: matp,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(data) {

                        Object.keys(data.districts).forEach(key => {
                            $('#district-dropdown').append(`
                                <option value="` + data.districts[key]['maqh'] + `">` + data.districts[key]['name'] + `</option>
                            `)
                        })

                    }
                })
            });

            $("#district-dropdown").on('change', function() {
                var maqh = $(this).val();

                $("#ward-dropdown").html(" ");
                $('#ward-dropdown').prepend(
                    `<option value="-1" selected="selected">--Phường / Xã / Thị trấn--</option>`)
                $.ajax({
                    url: "{{ route('shopping.getWards') }}",
                    type: "POST",
                    data: {
                        maqh: maqh,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: "json",
                    success: function(data) {

                        Object.keys(data.wards).forEach(key => {
                            $('#ward-dropdown').append(`
                                <option value="` + data.wards[key]['id'] + `">` + data.wards[key]['name'] + `</option>
                            `)
                        })

                    }
                })
            });
        })
    </script>



    {{-- Click order --}}
    {{-- <script>
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
</script> --}}
@endpush
