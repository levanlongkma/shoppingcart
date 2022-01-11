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
                                        <a href="javascript:;" class="loadAll">
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
                        
                        <div class="search-product">
                            <h2>Tìm kiếm</h2>
                            <div class="well text-center">
                                <input type="text" class="form-control search searchAll" placeholder="Nhập tên sản phẩm"/>
                            </div>
                        </div>
                        <div class="price-range"><!--price-range-->
                            <h2>Khoảng giá</h2>
                            <div class="well text-center">
                                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="{{ $highestPrice }}" data-slider-step="5" data-slider-value="[0,{{ $highestPrice }}]" id="sl2" ><br />
                                <b class="pull-left">$ 0</b> <b class="pull-right">$ {{ $highestPrice }}</b>
                                <a href="javascript:;" data-highest-price="" data-lowest-price="" data-categoryid=""><span>Apply Filter</span></a>
                            </div>
                        </div><!--/price-range-->
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">
                            Sản phẩm
                        </h2>
                        {!! $products !!}
                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>
@endsection

@push('js')
{{-- Click on category --}}
<script>
    $(document).ready(function(){
        $('.loadProducts').click(function(){
            $('.loadProducts').removeClass('active')
            $(this).addClass('active')
            $('input.search').removeClass('searchInCategory searchAll')
            $('input.search').addClass('searchInCategory')
            $('input.searchInCategory').data("category_id", $(this).data('categoryid'))
            ajaxGetProducts({'category_id': $(this).data('categoryid')})
            $('.searchInCategory').on('keyup', function(){
                ajaxGetProducts({search: $(this).val(), category_id: $(this).data("category_id")})
            })
        })
    })
</script>

{{-- Click on all --}}
<script>
    $(document).ready(function(){
        $('.loadAll').click(function(){
            $('.loadProducts').removeClass('active')
            $(this).addClass('active')
            $('input.search').removeClass('searchInCategory searchAll')
            $('input.search').addClass('searchAll')
            ajaxGetProducts()
            $('.searchAll').on('keyup', function(){
                ajaxGetProducts({search: $(this).val()})
            })
        })
    })
</script>

{{-- Search All --}}
<script>
    $(document).ready(function(){
        $('.searchAll').on('keyup', function(){
            ajaxGetProducts({search: $(this).val()})
        })
    })
</script>
{{-- Function --}}
<script>
    function resetFiltersAndProducts(data) {
        // Load products
        $('.features_items').empty()
        $('.features_items').append(`<h2 class="title text-center">Sản phẩm</h2>`)
        if(data.status) 
        {
            $('.features_items').append(data.output)
            // Load price range
            $('.price-range').empty()
            $('.price-range').prepend(`<h2>Khoảng giá</h2>`)
            $('.price-range').append(`
                <div class="well text-center">
                    <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="`+data.highestPrice+`" data-slider-step="5" data-slider-value="[0,{{ $highestPrice }}]" id="sl2" ><br />
                    <b class="pull-left">$ 0</b> <b class="pull-right">$ `+data.highestPrice+`</b>
                    <a href="javascript:;" data-highest-price="" data-lowest-price="" data-categoryid=""><span>Apply Filter</span></a>
                </div>
            `)
            // Make price slider
            $('#sl2').slider();
        }
        else {
            $('.features_items').append(`<div><p>Shit, no product</p></div>`)
        }
    }
</script>

<script>
    function ajaxGetProducts (d) {
        var promise = $.ajax({
            type: "POST",
            dataType: "json",
            url:"{{route('shopping.productsOnCategory')}}",
            data : d,
            success: function(data)  {
                resetFiltersAndProducts(data)
            },
            error: function(xhr) {
            }
        })
    }
</script>
@endpush
