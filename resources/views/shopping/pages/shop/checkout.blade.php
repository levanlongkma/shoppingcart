@extends('shopping.index')

@push('title')
    Checkout | E-Shopper
@endpush

@section('content')
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
                            <form>
                                <input style="margin-bottom: 10px" class="form-control" type="text"
                                    placeholder="Họ và tên*">
                                <input style="margin-bottom: 10px" class="form-control" type="text"
                                    placeholder="Điện thoại*">
                                <input style="margin-bottom: 10px" class="form-control" type="email" placeholder="Email">

                                <textarea class="form-control" name="message" placeholder="Ghi chú" rows="10"></textarea>
                            </form>
                            <a class="btn btn-primary" href="{{ route('shopping.cart') }}">Quay lại giỏ hàng</a>
                            <a class="btn btn-primary" href="">Thanh toán</a>
                        </div>
                    </div>
                    <div class="col-sm-4 clearfix">
                        <div class="bill-to">
                            <p>Địa chỉ</p>
                            <div class="shopper-info ">
                                <form>

                                    <select style="margin-bottom: 10px" class="form-control">
                                        <option>-- Thành phố --</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->matp }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                    <select style="margin-bottom: 10px" class="form-control">
                                        <option>-- Quận/Huyện --</option>
                                        @foreach ($cities as $city)
                                            <option value=""></option> 
                                            {{-- câu này cho ra 1 city nhưng có 1 đống quận, thì sẽ k chọn đc, dùng javascipt để load  --}}
                                        @endforeach
                                    </select>
                                    <select style="margin-bottom: 10px" class="form-control">
                                        <option>-- Xã/Phường --</option>
                                        <option>United States</option>
                                        <option>Bangladesh</option>
                                        <option>UK</option>
                                        <option>India</option>
                                        <option>Pakistan</option>
                                        <option>Ucrane</option>
                                        <option>Canada</option>
                                        <option>Dubai</option>
                                    </select>

                                    <textarea class="form-control" name="address" placeholder="Địa chỉ cụ thể"
                                        rows="10"></textarea>
                                </form>
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
                                        <td><span>{{ number_format($total + $vat) . ' đ' }}</span></td>
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
            </div>
        </div>
    </section>
    <!--/#cart_items-->

@endsection

@push('js')
{{-- Ví dụ --}}
{{-- $(document).ready(function(){
    $(document).on('change', '#provinces', function() {
        
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
}) --}}
@endpush
