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
                    <form method="GET" action="{{ route('admin.search_product') }}" class="search-form">
                        <input class="form-control mr-sm-2" type="text" name="search" placeholder="Search ..." aria-label="Search">
                        <button  name="submit" type="submit"><i class="fas fa-search"></i></button>
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
                            <a href="{{ route('admin.create_form_product') }}"><button type="button" class="btn btn-primary">Add a new product</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Slug</th>
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
                                    <td>{{ $product->slug }}</td>   
                                    <td><img src="{{ Storage::disk('product_image')->url($product->product_image) }}"/></td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>{{ $product->updated_at }}</td>
                                    <td>
                                        {{-- <a href="/admin/show/{{ $product->id }}">
                                            <i class="menu-icon fa  fa-eye"></i>
                                        </a> --}}
                                        <a href="/admin/edit-product/{{ $product->id }}">
                                            <i class="menu-icon fa  fa-pencil-square-o"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure?')" href="/admin/delete-product/{{ $product->id }}">
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