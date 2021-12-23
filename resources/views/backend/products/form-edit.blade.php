@extends('backend.layouts.main')
@section('content')

<div class="container">
    @foreach ($products as $product)
<form method="POST" action="/admin/update-product/{{ $product->id }}" enctype="multipart/form-data" >
    @csrf
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" id="exampleInputEmail1" aria-describedby="emailHelp">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <input type="text" name="description" class="form-control" value="{{ $product->description }}" id="exampleInputPassword1">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $product->slug }}" id="exampleInputPassword1">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" id="exampleInputPassword1">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <input type="file" name="product_image" class="form-control" value="{{ $product->product_image }}" id="exampleInputPassword1">
        
        {{-- <img src="{{ Storage::disk('product_image')->url($product->product_image) }}" > --}}
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
    
</form>
@endforeach
</div>

@endsection