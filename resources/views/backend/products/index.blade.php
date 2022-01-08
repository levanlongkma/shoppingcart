@extends('backend.layouts.main')

@section('content')
    {{-- <button class="search-trigger"><i class="fa fa-search"></i></button> --}}
    
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">

                        <div class="page-title">
                            <h1>Products</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4 d-flex align-items-center">
                    <div class="form-inline  ">
                        <form method="GET" action="{{ route('admin.product') }}" class="search-form">
                            <input class="form-control mr-sm-2" type="text" name="search" value="{{ $search }}"
                                placeholder="Search ..." aria-label="Search">
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
                                <strong class="card-title">Products List</strong>
                            </div>
                            <div class="float-right">
                                <a href="{{ route('admin.create_form_product') }}" class="btn btn-primary">
                                    Add New Product
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="productTable" class="table table-striped ">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Quantity</th>
                                        <th>Slug</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Created at</th>
                                        <th>Updated at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($products->isNotEmpty())
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->description }}</td>
                                                <td>{{ $product->quantity }}</td>
                                                <td>{{ $product->slug }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ data_get($product, 'category.name') }}</td>
                                                <td>
                                                    @if ($product->productImages->first() != NULL)
                                                        <img src=" /storage/{{ $product->productImages->first()->image }} " alt="No image" >  
                                                    @endif
                                                </td>
                                                <td>{{ $product->created_at }}</td>
                                                <td>{{ $product->updated_at }}</td>
                                                <td>

                                                    <a href="{{ route('admin.edit_product', $product->id) }}">
                                                        <i class="menu-icon fa  fa-pencil-square-o"></i>
                                                    </a>
                                                    <button type="button" data-id="{{ $product->id }}"
                                                        class="deleteProduct"><i class="fas fa-trash"></i></button>
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
                        title: "Are you sure?",
                        text: "Once deleted, you will not be able to recover this imaginary file!",
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
                                    swal("Poof! Your imaginary file has been deleted!", {
                                        icon: "success",
                                    });
                                },
                            });
                        } else {
                            swal("Your imaginary file is safe!");
                        }
                    });
            })
        })
    </script>
@endpush
