@extends('backend.layouts.main')

@section('content')
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
                            <a href="#"><button type="button" class="btn btn-primary">Add a new product</button></a>
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
                                        <a href="#">
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
                                <tr>
                                    <td>1</td>
                                    <td>T-shirt</td>
                                    <td>Lorem iplsum </td>
                                    <td>t-shirt</td>
                                    <td>Datetime</td>
                                    <td>Datetime</td>
                                    <td>
                                        <a href="#">
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
                                <tr>
                                    <td>1</td>
                                    <td>T-shirt</td>
                                    <td>Lorem iplsum </td>
                                    <td>t-shirt</td>
                                    <td>Datetime</td>
                                    <td>Datetime</td>
                                    <td>
                                        <a href="#">
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
                                <tr>
                                    <td>1</td>
                                    <td>T-shirt</td>
                                    <td>Lorem iplsum </td>
                                    <td>t-shirt</td>
                                    <td>Datetime</td>
                                    <td>Datetime</td>
                                    <td>
                                        <a href="#">
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