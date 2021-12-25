@extends('backend.layouts.main')
@section('content')

<div class="container">
    @foreach ($categories as $category)
<form method="POST" action="/admin/update-category/{{ $category->id }}"  >
    @csrf
    
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" value="{{ $category->name }}" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Slug</label>
        <input type="text" name="slug" class="form-control" value="{{ $category->slug }}" id="exampleInputPassword1">
        
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Update</button>
    
</form>
@endforeach
</div>

@endsection