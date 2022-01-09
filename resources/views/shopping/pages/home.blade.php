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
                                        {{-- <img src="/images/home/pricing.png"  class="pricing" alt="" /> --}}
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
                                        {{-- <img src="/images/home/pricing.png"  class="pricing" alt="" /> --}}
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
                                        <a href="javascript:;" data-products="{{$products}}"
                                        class="loadAll">
                                            Tất cả
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            @foreach ($categories as $category)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title text-center">
                                        <a href="javascript:;" 
                                        data-categoryid="{{ $category->id }}" 
                                        class="loadProducts">
                                            {{ $category->name }}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                            @endforeach
                        </div><!--/category-products-->

                        
                        <div class="price-range"><!--price-range-->
                            <h2>Khoảng giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                            </div>
                        </div><!--/price-range-->
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">
                            Sản phẩm
                        </h2>
                        @foreach ($products as $product)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ Storage::url($product->productImages()->first()->image) }}" alt="" />
                                            <h2>{{ $product->price }}</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>{{ $product->price }}</h2>
                                                <p>{{ $product->name }}</p>
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
                        @endforeach
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
{{-- Click category --}}
<script>
    $(document).ready(function(){
        $('.loadProducts').click(function(){
            $('.loadProducts').removeClass('active')
            $(this).addClass('active')
            $('.features_items').empty()
            $('.features_items').append(`<h2 class="title text-center">Products</h2>`)
            
            $.ajax({
                type: "POST",
                dataType: "json",
                data: { id: $(this).data('categoryid') },
                url:"{{route('shopping.productsOnCategory')}}",

                success: function(data)  {
                    console.log(data)
                    let count = 0;
                    data.forEach(product => {
                        let image = product['product_images'][0].image;
                        let price = product['price'];
                        let name = product['name']
                        console.log(price)
                        $('.features_items').append(`
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ Storage::url("`+image+`") }}" alt="" />
                                            <h2>`+price+`</h2>
                                            <p>`+name+`</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>`+price+`</h2>
                                                <p>`+name+`</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>`)
                        count += 1
                    })
                },

                error: function(xhr) {

                }
            })
        })
    })
</script>
{{-- Click all --}}
<script>
    $(document).ready(function(){
        $('.loadAll').click(function(){
            $('.loadProducts').removeClass('active')
            $(this).addClass('active')
            $('.features_items').empty()
            $('.features_items').append(`<h2 class="title text-center">Products</h2>`)
            $.ajax({
                type: "POST",
                dataType: "json",
                data: { id: $(this).data('categoryid') },
                url:"{{route('shopping.allProducts')}}",

                success: function(data)  {
                    console.log(data)
                    let count = 0;
                    data.forEach(product => {
                        let image = product['product_images'][0].image;
                        let price = product['price'];
                        let name = product['name']
                        console.log(price)
                        $('.features_items').append(`
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ Storage::url("`+image+`") }}" alt="" />
                                            <h2>`+price+`</h2>
                                            <p>`+name+`</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>`+price+`</h2>
                                                <p>`+name+`</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>`)
                        count += 1
                    })
                },

                error: function(xhr) {

                }
            })
        })
    })
</script>
@endpush
