<template>
<div class="container">
    <div class="modal fade" id="customModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">   </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="mb-3">
                            <label for="orderType" class="form-label">{{ $t('order_type') }} *</label>
                            <input type="text" class="form-control" id="orderType"  required>
                        </div>
                        <div class="mb-3">
                            <label for="instance" class="form-label">{{ $t('instance') }} *eeeeeeeeeeeeee</label>
                            <input type="text" class="form-control" id="instance"  required>
                        </div>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="fullName" >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" >
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" >
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="language" class="form-label">Language</label>
                            <input type="text" class="form-control" id="language" >
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="canCreateOrder" >
                            <label class="form-check-label" for="canCreateOrder">Can create order</label>
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="showUpdateOrderDetail" >
                            <label class="form-check-label" for="showUpdateOrderDetail">Show update order detail</label>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary me-1">Save changes</button>
                            <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
props: {
    title: String,
    visible: Boolean
}
};
</script>
  