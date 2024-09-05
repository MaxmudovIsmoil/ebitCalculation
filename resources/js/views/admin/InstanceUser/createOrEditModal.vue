<template>
      <div class="modal fade" id="customModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="customModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customModalLabel">Your Title Here</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="stage" class="form-label">{{ $t('stage') }}</label>
                            <input type="number" class="form-control" id="stage" required>
                        </div>
                        <div class="mb-3">
                            <label for="instance" class="form-label">Instance</label>
                            <input type="text" class="form-control" id="instance" required>
                        </div>
                        <div class="mb-3">
                            <label for="selectField" class="form-label">Select Item</label>
                            <multiselect
                                            v-model="selectedValues"
                                            :options="options"
                                            multiple
                                            placeholder="Select options" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
  </template>
<script>
export default {
  props: {
    title: {
      type: String,
      required: true
    },
  },
  data() {
    return {
      formData: {
        stage: null,
        instance: '',
      },
      selectedValues: [],
      options: ['Item 1', 'Item 2', 'Item 3', 'Item 4'] 
    };
  },
  methods: {
    handleSubmit() {
      console.log('Form Data:', this.formData);
      console.log('Selected Items:', this.selectedItems);
      this.closeModal();
    }
  }
};
</script>

