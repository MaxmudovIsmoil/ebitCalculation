<template>
   <div class="modal fade" id="customModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nameRu" class="form-label">{{$t('order_type')}} ({{ $t('russian') }})</label>
                        <input type="text" class="form-control" name="nameRU" aria-label="nameRu" required>
                    </div>
                    <div class="mb-3">
                        <label for="nameEn" class="form-label">{{ $t('order_type') }} ({{ $t('english') }})</label>
                        <input type="text" class="form-control" name="nameEN" aria-label="nameEn" required>
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
