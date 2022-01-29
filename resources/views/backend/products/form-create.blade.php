@extends('backend.layouts.main')
@section('content')

    <div class="container">
        <form method="POST" action="{{ route('admin.create_product') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mô tả</label>
                <textarea name="description" id="mytextarea" cols="30" rows="10"></textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Số lượng</label>
                <input type="number" min="1" name="quantity" class="form-control" id="exampleInputPassword1">
                @error('quantity')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Giá</label>
                <input type="number" min="1" name="price" class="form-control" id="exampleInputPassword1">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Danh mục</label>
                
                <select class="form-control" name="category_id" id="cars">
                    <option>--Chọn danh mục--</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hình ảnh</label>
                <input type="file" name="image[]" class="form-control" id="exampleInputPassword1" multiple>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Thêm mới</button>
        </form>
    </div>
    @if ($errors->has('message_error'))
        <script>
            toastr.error("{{ message_error }}");
        </script>
    @endif


@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        tinymce.init({
            selector: "#mytextarea"
        });
    </script>
@endpush
