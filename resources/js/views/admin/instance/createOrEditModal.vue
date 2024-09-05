<template>
   <div class="modal fade" id="customModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="mb-2">
                        <label for="instanceRU" class="form-label">{{ $t('instance') }} ({{ $t('russian') }})</label>
                        <input type="text" class="form-control" name="nameRu" aria-label="instanceRU" required>
                    </div>
                    <div class="mb-2">
                        <label for="instanceEN" class="form-label">{{ $t('instance') }} ({{ $t('english') }})</label>
                        <input type="text" class="form-control" name="nameEn" aria-label="instanceEN" required>
                    </div>
                    <div class="mb-2">
                        <label for="timeline" class="form-label">{{ $t('period_of_consideration')}}*</label>
                        <input type="number" class="form-control" name="timeLine" aria-label="timeline" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary me-1">{{ $t('apply') }}</button>
                    <button type="button" class="btn btn-secondary ms-1" data-bs-dismiss="modal">{{ $t('close') }}</button>
                </div>
            </form>

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
