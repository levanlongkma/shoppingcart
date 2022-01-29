@extends('shopping.index')
@push('title')
Trang Chủ | E-Shop
@endpush


@section('content')
    <section id="slider">
        <!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($slides as $key => $value)
                                @if ($key == 0)
                                    <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                                        class="active"></li>
                                @else
                                    <li data-target="#slider-carousel" data-slide-to="{{ $key }}"
                                        class=""></li>
                                @endif
                            @endforeach
                        </ol>

                        <div class="carousel-inner">
                            @foreach ($slides as $key => $value)
                            @if ($key == 0)
                            <div class="item active">
                                <div class="col-sm-12">
                                    <img src="{{Storage::url($value->image)}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            @else
                            <div class="item">
                                <div class="col-sm-12">
                                    <img src="{{Storage::url($value->image)}}" class="girl img-responsive" alt="" />
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>

                        <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                @include('shopping.layouts.left-sidebar')
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">
                            {{ $categoryName }}
                        </h2>
                        @foreach ($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <form>
                                            @csrf
                                            <div class="productinfo text-center">
                                                @php
                                                    $productImage = $product->productImages()->first();
                                                    $imageDefault = 'https://vnpi-hcm.vn/wp-content/uploads/2018/01/no-image-800x600.png';
                                                @endphp
                                                <input type="hidden" class="product_id_{{ $product->id }}"
                                                    value="{{ $product->id }}">
                                                <input type="hidden" class="product_name_{{ $product->id }}"
                                                    value="{{ $product->name }}">
                                                <input type="hidden" class="product_description_{{ $product->id }}"
                                                    value="{{ $product->description }}">
                                                <input type="hidden" class="product_quantity_{{ $product->id }}"
                                                    value="{{ $product->quantity }}">
                                                <input type="hidden" class="product_image_{{ $product->id }}"
                                                    value="{{ $productImage ? $productImage->image : '' }}">
                                                <input type="hidden" class="product_price_{{ $product->id }}"
                                                    value="{{ $product->price }}">

                                                <img src="{{ $productImage ? Storage::url($productImage->image) : $imageDefault }}"
                                                    alt="" />
                                                <h2>{{ $product->price }}</h2>
                                                <p>{{ $product->name }}</p>
                                                <a href="{{ route('shopping.add_to_cart', $product->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                                
                                            </div>
                                            <div class="product-overlay">
                                                <div class="overlay-content">
                                                    <h2>{{ $product->price }}</h2>
                                                    <p>{{ $product->name }}</p>
                                                    <a href="{{ route('shopping.add_to_cart', $product->id) }}"
                                                        class="btn btn-default add-to-cart"><i
                                                            class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div>Không thấy sản phẩm</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session()->has('success_add'))
        <script>
            swal.("{{ session()->get('success_add') }}")
        </script>
    @endif
@endpush
