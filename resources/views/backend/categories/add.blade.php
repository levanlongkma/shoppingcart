<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Add category</h5>
			</div>
			<div class="modal-body">
			<form method="POST" id="createForm">
				@csrf
				<div class="mb-3">
					<label for="confirmPasswordDelete" class="col-form-label"><h6>Category's Name:</h6></label>
					<input type="text" class="form-control" id="nameCreateCategory" name="name">
					<div class="invalid-feedback" id="errorCreateName">
					</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
				<button type="button" class="btn btn-success" id="buttonCreate">Create</button>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>