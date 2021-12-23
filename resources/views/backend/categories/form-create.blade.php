@extends('backend.layouts.main')
@section('content')

<div class="container">
<form method="POST" action="{{ route('admin.create_category') }}"  >
    @csrf
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        @error('name')
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
    <button type="submit" name="submit" class="btn btn-primary">Create</button>
</form>
</div>

@endsection