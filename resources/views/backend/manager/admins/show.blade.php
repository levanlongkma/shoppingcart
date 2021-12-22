@extends('backend.forms.template')
@section('content')
<main class="main-content  mt-0">
	<section>
		<div class="page-header min-vh-75">
		<div class="container">
			<div class="row">
			<div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
				<div class="card card-plain mt-7">
					<div class="card-header pb-0 text-left bg-transparent">
						<h3 class="font-weight-bolder text-info text-gradient">Detail admin information of {{ $admin->name }}</h3>
					</div>
					<div class="card-body">
						<form role="form" method="POST">
							<label>Name</label>
							<div class="mb-3">
								<input type="text" class="form-control" disabled placeholder="Name" aria-label="Name" aria-describedby="name-addon" name="name" value="{{ $admin->name }}">
							</div>
							<label>Email</label>
							<div class="mb-3">
								<input type="email" class="form-control" disabled placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" value="{{ $admin->email }}">
							</div>
							<label>Email Verified At</label>
							<div class="mb-3">
								<input type="email" class="form-control" disabled placeholder="Email" aria-label="Email" aria-describedby="email-addon" name="email" value="{{ $admin->email_verified_at }}">
							</div>
							<label>Role</label>
							<div class="mb-3">
								<input type="number" disabled class="form-control" placeholder="Role" aria-label="Role" aria-describedby="role-addon" name="role" value="{{ $admin->role }}">
							</div>
							<div class="text-center">
								<a href="/admin/manager/admins" class="btn bg-gradient-info w-100 mt-4 mb-0">Wanna go back?</a>
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
