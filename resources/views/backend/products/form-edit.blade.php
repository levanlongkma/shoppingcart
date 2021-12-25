@extends('backend.layouts.main')
@section('content')

<div class="container">
    @foreach ($products as $product)
<form method="POST" action="/admin/update-product/{{ $product->id }}" enctype="multipart/form-data" >
    @csrf
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Description</label>
        <textarea  name="description"  id="" cols="30" rows="10" >{{ old('description', $product->description) }}</textarea>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{  old('slug', $product->slug) }}" id="exampleInputPassword1">
        
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Quantity</label>
        <input type="number" name="quantity" class="form-control" value="{{  old('quantity', $product->quantity) }}" id="exampleInputPassword1">
        @error('quantity')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Image</label>
        <input type="file" name="image" class="form-control" value="{{  old('image', $product->image) }}" id="exampleInputPassword1">
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        {{-- <img src="{{ Storage::disk('product_image')->url($product->product_image) }}" > --}}
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
    
</form>
@endforeach
</div>

@endsection
@push('script')
<script>
tinymce.init({ selector:'textarea' });
</script>
@endpush