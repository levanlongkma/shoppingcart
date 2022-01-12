@extends('shopping.index')
@push('title')
Home | E-Shop
@endpush


@section('content')  
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            @foreach ($slides as $key => $value)
                            @if ($key == 0)
                            <li data-target="#slider-carousel" data-slide-to="{{$key}}" class="active"></li>
                            @else
                            <li data-target="#slider-carousel" data-slide-to="{{$key}}" class=""></li>
                            @endif
                            @endforeach
                        </ol>
                        
                        <div class="carousel-inner">
                            @foreach ($slides as $key => $value)
                                @if ($key == 0)
                                <div class="item active">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Product description</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
                                        <img src="{{Storage::url($value->image)}}" class="girl img-responsive" alt="" />
                                    </div>
                                </div>
                                @else
                                <div class="item">
                                    <div class="col-sm-6">
                                        <h1><span>E</span>-SHOPPER</h1>
                                        <h2>Product description</h2>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>
                                        <button type="button" class="btn btn-default get">Get it now</button>
                                    </div>
                                    <div class="col-sm-6">
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
    </section><!--/slider-->

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title text-center">
                                        <a href="/">
                                            Tất cả
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            @foreach ($categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title text-center">
                                        <a href="{{ route('shopping.home',['category' => $category->slug]) }}">
                                            {{ $category->name }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <div class="search-product">
                            <h2>Tìm kiếm</h2>
                            <div class="well text-center">
                                <form action="{{ route('shopping.home') }}" >
                                    <input type="hidden" class="form-control" name="category" value={{ request()->category }}>
                                    <input type="text" class="form-control" name="search" placeholder="Nhập tên sản phẩm" value=""/>
                                </form>
                            </div>
                        </div>

                        <div class="price-range">
                            <h2>Khoảng giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="{{ $highestPrice }}" data-slider-step="5" data-slider-value="[0,{{ $highestPrice }}]" id="sl2" ><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ {{ $highestPrice }}</b>
                            </div>
                        </div>

                        <div class="apply-filter">
                            <h2>Áp dụng bộ lọc</h2>
                            <div class="well text-center">
                                <form action="{{ route('shopping.home') }}">
                                    <input type="hidden" class="form-control" name="category" value={{ request()->category }}>
                                    <input type="hidden" class="price-from " name="price-from">
                                    <input type="hidden" class="price-to" name="price-to">
                                    <input type="hidden" class="price-range-value">
                                    <input type="hidden" class="form-control" name="search"/>
                                    <button class="btn btn-warning">Lọc sản phẩm</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items">
                        <h2 class="title text-center">
                            {{ $categoryName }}
                        </h2>
                        @isset($products)
                            <div class="text-center">{{ $products->appends(request()->input())->links() }}</div>
                        @endisset
                        @forelse ($products as $product)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{Storage::url($product->productImages->first()->image)}}" alt="" />
                                            <h2>$ {{$product->price}}</h2>
                                            <p>{{$product->name}}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$ {{$product->price}}</h2>
                                                <p>{{$product->name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
                                    </ul>
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
<script>
    $(document).ready(function() {
        //setup before functions
        var typingTimer;                //timer identifier
        var doneTypingInterval = 1000;  //time in ms (5 seconds)
        $('.search-product input[name="search"]').on('keyup', function() { 
            clearTimeout(typingTimer);
            if ($('.search-product input[name="search"]').val()) {
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            }
        })
        function doneTyping() {
            var val = $('.search-product input[name="search"]').val()
            $('.apply-filter input[name="search"]').val(val)
        }
    })
</script>
@endpush
