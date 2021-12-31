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
                                        <a href="#" data-bs-target="#updateModal" data-bs-toggle="modal" data-name="{{ $category->name }}" data-id="{{ $category->id }}" >
                                            <i class="menu-icon fa  fa-pencil-square-o"></i>
                                        </a>
                                        <a href="#" data-bs-target="#confirmDeleteModal" data-bs-toggle="modal" data-name="{{ $category->name }}" data-id="{{ $category->id }}">
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
            @include('backend.categories.edit')
            @include('backend.categories.delete')
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

{{-- Create --}}
<script>
    $(document).ready(function(){
        $("#buttonCreate").click(function() 
        {
            let formData = new FormData($('#createCategoryForm')[0]);
            
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
                        toastr.error('Cannot create, please try again !');
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

{{-- Data for update --}}
<script>
    $('#updateModal').on('show.bs.modal', function (event) 
    {
        var button = $(event.relatedTarget) //Button that show the modal
        // Extract info from data-* attributes
        var name = button.data('name') 
        var id = button.data('id')
        var modal = $(this)

        modal.find('input[name="name"]').val(name)
        modal.find('input[name="updateId"]').val(id)
    })
</script>

{{-- Update --}}
<script>
    $(document).ready(function()
    {
        $('#buttonUpdate').click(function(){
            
            let formData = new FormData($('#updateCategoryForm')[0])

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/admin/categories/"+$("input[name=updateId]").val()+"/update",
                data: formData,
                processData: false,
                contentType: false,
                
                success: function(data) {
                    if (data.status) {
                        window.location.reload()
                    }
                    else {
                        toastr.error('Cannot update this category!')
                    }
                },
                error: function(xhr) {
                    console.log(xhr)
                    Object.keys(xhr.responseJSON.errors).foreach(key => {
                        $('#error_' + key).text(xhr.responseJSON.errors[key][0])
                    })
                }
            })
        })
    })
</script>

{{-- Delete --}}
<script>
    $('#confirmDeleteModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) 
    var id = button.data('id')
    var name = button.data('name')
    var modal = $(this)
    modal.find('#message_delete').text('Do you want to delete '+name+'?')
    modal.find('input[name=deleteId]').val(id)
    });
</script>

<script>
    $(document).ready(function()
    {
        $("#buttonConfirmDelete").click(function()
        {
            $.ajax(
            {
                type: "POST",
                dataType: "json",
                url: "/admin/categories/"+$("input[name=deleteId]").val()+"/delete",
                success: function(data){
                    if (data.status) {
                    window.location.reload()
                    }
                    else {
                        toastr.error('Cannot delete the category!')
                    }
                }  
            });
        })
    });

</script>
@endpush