@extends('backend.forms.template')
@section('content')
<main class="main-content  mt-0">
	<section>
		@if (request()->session()->has('message'))
		<div x-data="{ show: true }"
			x-init="setTimeout(() => show = false, 4000)"
			x-show="show"
			class="bg-gradient-primary text-white py-3 text-center h4">
			{{ request()->session()->get('message') }}
		</div>
		@endif
		<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">
			<div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
				<div class="card card-plain mt-7">
					<div class="card-header pb-0 text-left bg-transparent">
						<h3 class="font-weight-bolder text-info text-gradient">ADD NEW USER!</h3>
					</div>
					<div class="card-body">
						<form role="form" method="POST">
							@csrf
							<label>Name</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="name-addon" name="name" value="{{ old('name') }}">
							</div>
							@error('name')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror

							<label>Email</label>
							<div class="mb-3">
								<input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" value="{{ old('email') }}">
							</div>
							@error('email')
								<p class="text-danger  text-xs"> {{ $message }} </p>
							@enderror

							<label>Phonenumber</label>
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Phonenumber" aria-label="Phonenumber" aria-describedby="phonenumber-addon" name="phonenumber" value="{{ old('phonenumber') }}"/>
							</div>
							@error('phonenumber')
								<p class="text-danger  text-xs"> {{ $message }} </p>
							@enderror
							
							<label>Password</label>
							<div class="mb-3">
								<input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
							</div>
							@error('password')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror

							<div class="text-center">
								<button type="submit" class="btn bg-gradient-info w-100 mt-1 mb-0">Create new user!</button>
							</div>
							<div class="text-center">
								<a href='/admin/manager/users' class="btn bg-gradient-light w-100 mt-2 mb-0">Back</a>
							</div>
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n4">
				<div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n8" style="background-image:url('{{asset('backend/assets/img/bg.png')}}')"></div>
				</div>
			</div>
			</div>
		</div>
		</div>
	</section>
	</main>
@endsection
