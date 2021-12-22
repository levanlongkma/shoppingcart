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
						<h3 class="font-weight-bolder text-success text-gradient">Edit {{ $admin->name }}'s information</h3>
					</div>
					<div class="card-body">
						<form role="form" method="POST">
							@csrf
							<label>Name</label>
							<input type="text" class="form-control" hidden placeholder="ID" aria-label="id" aria-describedby="id-addon" name="id" value="{{ $admin->id }}">
							<div class="mb-3">
								<input type="text" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="name-addon" name="name" value="{{ $admin->name }}">
							</div>
							@error('name')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							<label>Email</label>
							<div class="mb-3">
								<input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" value="{{ $admin->email }}">
							</div>
							@error('email')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							<label>Role</label>
							<div class="mb-3">
								<input type="number" class="form-control" placeholder="Role" aria-label="Role" aria-describedby="role-addon" name="role" value="{{ $admin->role }}">
							</div>
							@error('role')
								<p class="text-danger text-xs"> {{ $message }} </p>
							@enderror
							<div class="text-center">
								<button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Update Information!</button>
							</div>
							
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
				<div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('{{asset('backend/assets/img/curved-images/curved8.jpg')}}')"></div>
				</div>
			</div>
			</div>
		</div>
		</div>
	</section>
	</main>
@endsection
