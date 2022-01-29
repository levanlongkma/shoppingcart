@extends('backend.layouts.main')

@section('content')
    {{-- <button class="search-trigger"><i class="fa fa-search"></i></button> --}}
    
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">

                        <div class="page-title">
                            <h1>Sản phẩm</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4 ">
                    <div class="form-inline page-header float-right ">
                        <form method="GET" action="{{ route('admin.product') }}" class="search-form">
                            <input class="form-control mr-sm-2" type="text" name="search" value="{{ $search }}"
                                placeholder="Tìm kiếm" aria-label="Search">
                            <button name="submit" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-left">
                                <strong class="card-title text-dark">Quản lý sản phẩm</strong>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('admin.create_form_product') }}" class="btn btn-primary">
                                    Thêm sản phẩm mới
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="productTable" class="table table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th class="small font-weight-bold text-center">#</th>
                                        <th class="small font-weight-bold text-center">Tên </th>
                                        <th class="small font-weight-bold text-center">Mô tả</th>
                                        <th class="small font-weight-bold text-center">Số lượng</th>
                                        <th class="small font-weight-bold text-center">Slug</th>
                                        <th class="small font-weight-bold text-center">Giá</th>
                                        <th class="small font-weight-bold text-center">Danh mục</th>
                                        <th class="small font-weight-bold text-center">Hình ảnh</th>
                                        <th class="small font-weight-bold text-center">Khởi tạo</th>
                                        <th class="small font-weight-bold text-center">Cập nhật</th>
                                        <th class="small font-weight-bold text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="small text-center">{{ $product->id }}</td>
                                                <td class="small text-center">{{ $product->name }}</td>
                                                <td class="small text-center">{{ $product->description }}</td>
                                                <td class="small text-center">{{ $product->quantity }}</td>
                                                <td class="small text-center">{{ $product->slug }}</td>
                                                <td class="small text-center">{{ $product->price }}</td>
                                                <td class="small text-center">{{ data_get($product, 'category.name') }}</td>
                                                <td class="small text-center">
                                                    @if ($product->productImages->first() != NULL)
                                                        <img style="width:70; height:80" src="{{ Storage::url($product->productImages->first()->image) }} " alt="No image" >  
                                                    @endif
                                                </td>
                                                <td class="small text-center">{{ $product->created_at }}</td>
                                                <td class="small text-center">{{ $product->updated_at }}</td>
                                                <td class="small text-center">

                                                    <a class="text-primary" href="{{ route('admin.edit_product', $product->id) }}">
                                                        <i class="menu-icon fa  fa-pencil-square-o"></i>
                                                    </a>
                                                    <a href="#" class="deleteProduct text-danger" data-id="{{ $product->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="clearfix"></div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
crossorigin="anonymous"></script>
{{-- <script>
    $(function() {
        $('.create-product').click(function(e){
        
            let data = {
                name: $('#name').val(),
                description: tinyMCE.activeEditor.getContent(),
                quantity: $('#quantity').val(),
                image: $('#image').val(),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $("input[name=_token]").val()
                }
            });
            let inputFile = $("#file_upload")[0];

            let formData = new FormData();
            formData.append('data', JSON.stringify(data));

            if (inputFile.files) {
                for (let i = 0; i < inputFile.files.length; i++) {
                    let file = inputFile.files[i];

                    formData.append('files[]', file);
                }
            }

            $.ajax({
                url: "{{ route('admin.create_product') }}",
                type:'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    if (response.status) {
                        
                    } else {
                    }
                },
                error: function(xhr, status, error){
                    let errors = xhr.responseJSON.errors
                    Object.keys(errors).forEach(item => {
                        $('#error_' + item).text(errors[item][0]);
                    });
                    
                }
            })
        })
    })
</script> --}}
@push('js')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script>
        $(function() {
            $(".deleteProduct").click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var id = $(this).data("id");
                swal({
                        title: "Bạn có chắc chắn xóa?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: "/admin/delete-product/" + id,
                                type: "GET",
                                dataType: "json",
                                data: {
                                    "id": id,
                                },
                                success: function(response) {

                                    window.location.reload();
                                    swal("Bạn đã xóa thành công !", {
                                        icon: "success",
                                    });
                                },
                            });
                        } else {
                            swal("Sản phẩm vẫn tồn tại !");
                        }
                    });
            })
        })
    </script>
@endpush
