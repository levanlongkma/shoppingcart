<div class="modal fade" id="updateContactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-info" id="exampleModalLabel"><strong>Change Category's Info</strong></h3>
            </div>
            <div class="modal-body">
                <form method="POST" id="updateCategoryForm">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Company's Name">
                        <span class="text-danger small" id="error_name"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="phonenumber" placeholder="Your phonenumber is ...">
                        <span class="text-danger small" id="error_phonenumber"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="fax" placeholder="Your fax is ...">
                        <span class="text-danger small" id="error_fax"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="address" placeholder="Your address is ...">
                        <span class="text-danger small" id="error_address"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Your email is ...">
                        <span class="text-danger small" id="error_email"></span>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-info" id="buttonUpdate">Confirm changes?</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>