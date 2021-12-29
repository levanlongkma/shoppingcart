@extends('backend.layouts.main')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-lg-8">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Categories</h1>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 d-flex align-items-center justify-content-lg-end">
                <div class="form-inline  ">
                    <form method="GET" action="{{ route('admin.categories') }}" class="search-form">
                        <input class="form-control mr-sm-2" type="text" name="search" value="{{ $search }}" placeholder="Search ..." aria-label="Search">
                    </form>
                </div>
            </div> --}}

        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div>
                            <strong class="card-title">Products Categories</strong>
                        </div>
                        <div>
                            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">Add a new category</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-bordered">
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
                                        <a href="#" data-target="#modal-edit" data-toggle="modal">
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
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
            {{-- Modal create --}}
            @include('backend.categories.add')
            {{-- @include('backend.categories.edit') --}}
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
<div class="clearfix"></div>
@endsection
@push('js')
@if (session()->has('messages_success'))
    <script>
        toastr.success("{{session()->get('messages_success')}}");
    </script>
@endif
<script>
    $(document).ready(function(){
        $("#buttonCreate").click(function() {
            let form = $('#createCategoryForm');
            let formData = new FormData(form[0]);

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.categories.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status) {
                        window.location.reload()
                    } else {
                        toastr.error('khong thanh cong !');
                    }
                },
                error: function(xhr) {
                    Object.keys(xhr.responseJSON.errors).forEach(key => {
                        $('#error_' + key).text(xhr.responseJSON.errors[key][0]);
                    });
                }
            })
        })
    })
</script>
@endpush