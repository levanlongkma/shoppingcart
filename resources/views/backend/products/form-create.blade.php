@extends('backend.layouts.main')
@section('content')

<div class="container">
<form method="POST" action="{{ route('admin.create_product') }}" enctype="multipart/form-data" >
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" id="exampleInputPassword1">
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" id="exampleInputPassword1">
        @error('slug')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Quantity</label>
        <input type="number" min="1" name="quantity" class="form-control" id="exampleInputPassword1">
        @error('quantity')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <input type="file" name="product_image" class="form-control" id="exampleInputPassword1">
        @error('product_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Create</button>
</form>
</div>

@endsection