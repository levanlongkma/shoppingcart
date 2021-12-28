{{-- Modal thêm mới todo --}}
<div class="modal fade" id="modal-add">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="" data-url="{{ route('admin.user.store') }}" id="form-add" method="POST" role="form">
				@csrf
				<div class="modal-header d-flex">
					<h5 class="modal-title font-weight-bold">Create new category</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<div class="form-group">
						<label for="name-add">Category's Name:</label>
						<input name="name" type="text" class="form-control" id="name-add" placeholder="Enter here...">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Add</button>
				</div>
			</form>
		</div>
	</div>
</div>
