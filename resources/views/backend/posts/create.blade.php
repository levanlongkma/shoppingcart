@extends('backend.forms.template')
@section('content')
<main class="main-content  mt-0">
	<section>
		<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">
			<div class="col-12 d-flex flex-column mx-auto">
				<div class="card card-plain">
					<div class="card-header pb-0 text-left bg-transparent">
						<h3 class="font-weight-bolder text-dark text-gradient">Let's create a new post</h3>
					</div>
					<div class="card-body">
						<form role="form" method="POST">
							@csrf
							<label>Category ID</label>
							<div class="mb-3">
								<select class="form-control" name="post_category_id" id="">
									@foreach ($categories as $category)
										<option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
									@endforeach
								</select>
							</div>
							@error('post_category_id')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							
							<label>Title</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Title" name="title" value="{{ old('title') }}">
							</div>
							@error('title')
								<p class="text-danger  text-xs"> {{ $message }} </p>
							@enderror

							<label>Description</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Description" name="description" value="{{ old('description') }}">
							</div>
							@error('description')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							<textarea name="body"></textarea>
							@error('body')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							<div class="text-center">
								<button type="submit" class="btn bg-gradient-dark w-100 mt-4 mb-0">Create new post!</button>
							</div>
							<div class="text-center">
								<a href='/admin/posts' class="btn bg-gradient-light w-100 mt-4 mb-0">Back</a>
							</div>
							
						</form>
					</div>
				</div>
			</div>
		</div>
		</div>
	</section>
	</main>
	<script>
		CKEDITOR.replace( 'body' );
	</script>
@endsection
