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

@push('search-js')
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