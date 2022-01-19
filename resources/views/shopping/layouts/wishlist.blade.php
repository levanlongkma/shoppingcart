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
                                    <td class="small text-center">{{ $userFavoriteItems[$key]->favoriteProducts->first()->name }}</td>
                                    <td class="small text-center">{{ $userFavoriteItems[$key]->favoriteProducts->first()->price }}</td>
                                    <td class="small text-center">1</td>
                                    <td class="small text-center"><a href="{{ route('shopping.add_to_cart', $userFavoriteItems[$key]->favoriteProducts->first()->id) }}"><i class="fas fa-cart-plus"></i></a></td>
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

@push('wishlist-js')
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
                            <tr class="favorite-item">
                                <td class="small text-center"><img src="{{asset('storage/`+data.product.product_images[0].image+`')}}" alt="favorite product" style="width:30px; height:30px"></td>
                                <td class="small text-center">`+data.product['name']+`</td>
                                <td class="small text-center">`+data.product['price']+`</td>
                                <td class="small text-center">1</td>
                                <td class="small text-center"><a href="/add-to-cart/`+data.product['id']+`"><i class="fas fa-cart-plus"></i></a></td>
                                <td class="small text-center"><a href="javascript:;" class="remove-from-wishlist" data-product-id="`+data.product['id']+`"><i class="fas fa-trash-alt"></i></a></td>
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
    // Remove from wishlist
    $(document).ready(function() {
        $(document).on('click', '.remove-from-wishlist', function() {
            console.log('hello')
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
                },
                error: function(xhr) {
                    
                }
            })
        })
    })
</script>
@endpush
