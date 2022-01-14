@extends('shopping.index')
@push('title')
Trang Chủ | E-Shop
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
                                        <li><a href="javascript:;" class="add-to-wishlist" data-product-id="{{$product->id}}" data-user-id="{{ isset(auth()->user()->id) ? auth()->user()->id : ""  }}"><i class="fa fa-plus-square"></i>Thêm vào wishlist</a></li>
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
    <section>
        <div class="modal fade" id="wishlist" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title text-info text-center" id="exampleModalLabel"><strong>Wishlist của bạn</strong></h3>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="small font-weight-bold text-center">Ảnh</th>
                                        <th class="small font-weight-bold text-center">Tên sản phẩm</th>
                                        <th class="small font-weight-bold text-center">Giá tiền</th>
                                        <th class="small font-weight-bold text-center">Số lượng</th>
                                        <th class="small font-weight-bold text-center">Thêm vào giỏ hàng</th>
                                        <th class="small font-weight-bold text-center">Xóa</th>
                                    </tr>
                                </thead>
                                <tbody class="favorite-table-body">
                                    @if($userFavoriteItems!= null)
                                    @foreach ($userFavoriteItems as $key => $userFavoriteItem)
                                    <tr class="favorite-item">
                                        <td class="small text-center"><img src="{{Storage::url($userFavoriteItems[$key]->favoriteProducts->first()->productImages->first()->image)}}" alt="favorite product" style="width:30px; height:30px"></td>
                                        <td class="small text-center">{{ $userFavoriteItems[$key]->favoriteProducts->first()->name}}</td>
                                        <td class="small text-center">{{ $userFavoriteItems[$key]->favoriteProducts->first()->price}}</td>
                                        <td class="small text-center">1</td>
                                        <td class="small text-center"><a href="javascript:;">Add to cart</a></td>
                                        <td class="small text-center"><a href="javascript:;" class='remove-from-wishlist' data-product-id="{{ $userFavoriteItems[$key]->favoriteProducts->first()->id}}"><i class="fas fa-trash-alt"></i></a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        </div>
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
{{-- Wishlist --}}
<script>
    $(document).ready(function() {
        $('.add-to-wishlist').click(function() {
            if ($(this).data('user-id') == '') {
                Swal.fire({
                    text: 'Vui lòng đăng nhập để thực hiện chức năng này',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đến trang đăng nhập',
                    cancelButtonText: 'Hủy thao tác'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('shopping.login') }}";
                    }
                })
            }
            else {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{route('shopping.favorites.addToFavorite')}}",
                    data: {product_id : $(this).data('product-id')},

                    success: function(data) {
                        if (data.status) {
                            toastr.success('Đã thêm vào wishlist của bạn!')

                            $('.favorite-table-body').append(`
                            <tr>
                                <td class="small text-center"><img src="{{asset('storage/`+data.product.product_images[0].image+`')}}" alt="favorite product" style="width:30px; height:30px"></td>
                                <td class="small text-center">`+data.product['name']+`</td>
                                <td class="small text-center">`+data.product['price']+`</td>
                                <td class="small text-center">1</td>
                                <td class="small text-center"><a href="javascript:;">Add to cart</a></td>
                                <td class="small text-center"><a href="javascript:;"><i class="fas fa-trash-alt"></i></a></td>
                            </tr>
                            `)
                        }
                        else {
                            toastr.info('Sản phẩm đã tồn tại trong wishlist')
                        }
                    },
                    error: function(xhr) {
                        toastr.warning('Opps! Đã xảy ra lỗi, hãy thử lại lần sau!')
                    }
                })
            }
        })
    })
</script>
{{-- Remove from wishlist --}}
<script>
    $(document).ready(function() {
        $('.remove-from-wishlist').click(function() {
            $(this).closest('.favorite-item').remove()  

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('shopping.favorites.removeFromFavorite') }}",
                data: {product_id:$(this).data('product-id')},
                success: function(data) {
                    console.log(data.status)
                    if (data.status) {
                        $(this).closest('.favorite-item').remove()  
                        toastr.success('Đã xóa sản phẩm!')
                    }
                    else {
                        toastr.error('Không thể xóa sản phẩm!')
                    }
                }
            })

            
        })
    })
</script>
@endpush
