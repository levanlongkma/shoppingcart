@extends('backend.layouts.main')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-4 d-flex align-items-center">
                <div class="form-inline  ">
                    <form method="GET" action="{{ route('admin.search_category') }}" class="search-form">
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
                            <strong class="card-title">Products Categories</strong>
                        </div>
                        <div class="float-right">
                            <a href="{{ route('admin.create_form_category') }}"><button type="button" class="btn btn-primary">Add a new category</button></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    
                                
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug}} </td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <a href="/admin/edit-category/{{ $category->id }}">
                                            <i class="menu-icon fa  fa-pencil-square-o"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure?')" href="/admin/delete-category/{{ $category->id }}">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
    <div class="animated fadeIn">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong class="card-title">Post Categories</strong>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary">Create a new category</button>
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
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>T-shirt</td>
                                    <td>Lorem iplsum </td>
                                    <td>t-shirt</td>
                                    <td>Datetime</td>
                                    <td>Datetime</td>
                                    <td>
                                        <a href="sdfsdfssd#">
                                            <i class="menu-icon fa  fa-eye"></i>
                                        </a>
                                        <a href="#">
                                            <i class="menu-icon fa  fa-pencil-square-o"></i>
                                        </a>
                                        <a href="#">
                                            <i class="menu-icon fa  fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>
@endsection