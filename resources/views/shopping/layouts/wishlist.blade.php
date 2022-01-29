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
                                @php
                                    $userFavoriteItems = NULL;
                                    if(isset(auth()->user()->id)) {
                                        $userFavoriteItems = App\Models\Favorite::with('favoriteProducts')->where('user_id', auth()->user()->id)->get();
                                    }
                                @endphp
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

