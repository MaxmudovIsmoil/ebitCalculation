<template>
  <div>
    <div class="modal fade" id="uploadModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="fileUploadModalLabel">{{ $t('upload') }} {{ $t('file') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form @submit.prevent="handleSubmit">
              <div class="mb-3">
                <label for="fileInput" class="form-label">{{ $t('select_file') }}</label>
                <input type="file" id="fileInput" class="form-control" ref="fileInput" @change="handleFileChange">
              </div>
              <button type="submit" class="btn btn-primary">{{ $t('upload') }}</button>
            </form>

            <div class="mt-4">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{ $t('department') }}</th>
                    <th>{{ $t('user') }}</th>
                    <th>{{ $t('file') }}</th>
                    <th>{{ $t('upload_time') }}</th>
                    <th>{{ $t('actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(file, index) in uploadedFiles" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ getRandomText() }}</td>
                    <td>{{ getRandomText() }}</td>
                    <td>
                      <a :href="file.url" target="_blank">{{ file.name }}</a>
                    </td>
                    <td>{{ file.uploadTime }}</td>
                    <td class="text-center">
                      <button class="btn btn-primary btn-sm me-2" @click="downloadFile(file.url)">
                        <font-awesome-icon :icon="['fas', 'fa-download']" />
                      </button>
                      <button class="btn btn-danger btn-sm" @click="deleteFile(index)">
                        <font-awesome-icon :icon="['fas', 'fa-trash']" />
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('close') }}</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      file: null,
      uploadedFiles: [],
    };
  },
  methods: {
    handleFileChange(event) {
      this.file = event.target.files[0];
    },
    handleSubmit() {
      if (this.file) {
        const fileUrl = URL.createObjectURL(this.file);
        this.uploadedFiles.push({
          name: this.file.name,
          url: fileUrl,
          uploadTime: new Date().toLocaleString(),
        });
        this.$refs.fileInput.value = '';
        this.file = null;
      }
    },
    getRandomText() {
      const texts = ['Department A', 'Department B', 'Department C'];
      return texts[Math.floor(Math.random() * texts.length)];
    },
    deleteFile(index) {
      this.uploadedFiles.splice(index, 1); 
    },
  },
};
</script>

<style scoped>
.modal-dialog {
  max-width: 70vw;
}
</style>
