@extends('backend.layouts.main')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Contacts Info</h1>
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="card-title">Contacts List</strong>
                        </div>
                        <div>
                            <a href="#" data-bs-target="#createModal"
                            data-bs-toggle="modal"><button type="button" class="btn btn-primary">Add new contacts</button></a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phonenumber</th>
                                    <th>Fax</th>
                                    <th>Address</th>
                                    <th>Email</th>
                                    <th>Created at</th>
                                    <th>Updated at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @isset ($contacts)
                                @foreach ($contacts as $contact)
                                <tr>
                                    <td>{{ $contact->id }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td>{{ $contact->phonenumber }}</td>
                                    <td>{{ $contact->fax }}</td>
                                    <td>{{ $contact->address }}</td>   
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->created_at }}</td>
                                    <td>{{ $contact->updated_at }}</td>
                                    
                                    <td>
                                        <a 
                                            href="#" 
                                            data-id={{ $contact->id}} 
                                            data-name="{{ $contact->name }}" 
                                            data-phonenumber="{{ $contact->phonenumber }}" 
                                            data-fax="{{ $contact->fax }}" 
                                            data-email="{{ $contact->email }}"
                                            data-bs-target="#updateContactModal"
                                            data-bs-toggle="modal"
                                        >
                                            <i class="menu-icon fa  fa-pencil-square-o"></i>
                                        </a>

                                        <a href="#" data-id="{{ $contact->id}}" class="deleteContactLink">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                        
                        @isset($contacts)
                        {{ $contacts->links() }}
                        @endisset
                        @include('backend.contacts.add')
                        @include('backend.contacts.edit')
                    </div>
                </div>
            </div>
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
    $(document).ready(function() {
        $("#buttonCreate").click(function() {
            let formData = new FormData($('#createContactForm')[0]);
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('admin.contacts.store') }}",
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
    $('#updateContactModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget) //Button that show the modal
        // Extract info from data-* attributes
        var name = button.data('name')
        var phonenumber = button.data('phonenumber')
        var fax = button.data('fax')
        var address = button.data('address')
        var email = button.data('email')
        var id = button.data('id')
        var modal = $(this)

        modal.find('input[name="name"]').val(name)
        modal.find('input[name="phonenumber"]').val(phonenumber)
        modal.find('input[name="fax"]').val(fax)
        modal.find('input[name="address"]').val(address)
        modal.find('input[name="email"]').val(email)
        modal.find('input[name="updateId"]').val(id)
    })
</script>

{{-- Update --}}
<script>
    $(document).ready(function() {
        $('#buttonUpdate').click(function() {

            let formData = new FormData($('#updateCategoryForm')[0])

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "/admin/categories/update/" + $("input[name=updateId]").val(),
                data: formData,
                processData: false,
                contentType: false,

                success: function(data) {
                    if (data.status) {
                        window.location.reload()
                    } else {
                        toastr.error('Cannot update this category!')
                    }
                },
                error: function(xhr) {
                    Object.keys(xhr.responseJSON.errors).forEach(key => {
                        $('#error_update_' + key).text(xhr.responseJSON.errors[key][0]);
                    });
                }
            })
        })
    })
</script>

{{-- Delete --}}
<script>
    $(document).ready(function() {
        $(".deleteContactLink").click(function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "/admin/contacts/delete/" + $(this).data('id'),
                        success: function(data) {
                            if (data.status) {
                                Swal.fire(
                                'Deleted!',
                                'The category has been deleted.',
                                'success'
                                )
                                setTimeout(function() {
                                    window.location.reload(true)
                                }, 2000);
                            } else {
                                toastr.error('Cannot delete the category!')
                            }
                        }
                    });
                    
                }
                })
            
        })
    });
</script>
@endpush