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
				<div class="card card-plain mt-8">
					<div class="card-header pb-0 text-left bg-transparent">
						<h3 class="font-weight-bolder text-info text-gradient">Let's create an admin account</h3>
						<p class="mb-0">Enter the following information to proceed</p>
					</div>
					<div class="card-body">
						<form role="form" method="POST">
							@csrf
							<label>Email</label>
							<div class="mb-3">
								<input type="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" value=" {{ old('email') }} ">
							</div>
							<label>Password</label>
							<div class="mb-3">
								<input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon" name="password">
							</div>
							<div class="text-center">
								<button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Sign in</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="oblique position-absolute top-0 h-100 d-md-block d-none">
				<div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0" style="background-image:url('{{asset('backend/assets/img/key.png')}}')"></div>
				</div>
			</div>
			</div>
		</div>
		</div>
	</section>
	</main>
@endsection
