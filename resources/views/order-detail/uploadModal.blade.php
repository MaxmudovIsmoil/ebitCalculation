<div class="modal fade" id="uploadModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="fileUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileUploadModalLabel">@lang('text.Upload file')</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form @submit.prevent="handleSubmit">
                    <div class="mb-3">
                        <label for="file" class="form-label">@lang('text.File')</label>
                        <input type="file" name="file" class="form-control" aria-label="file">
                    </div>
                    <button type="submit" class="btn btn-primary">@lang('text.Upload')</button>
                </form>

                <div class="mt-4">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('text.Instance')</th>
                            <th>@lang('text.Position')</th>
                            <th>@lang('text.User')</th>
                            <th>@lang('text.File')</th>
                            <th>@lang('text.Time')</th>
                            <th>@lang('text.Action')</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Instance</td>
                                <td>position</td>
                                <td>User</td>
                                <td>
                                    <a href="file.url" target="_blank">File</a>
                                </td>
                                <td>uploadTime</td>
                                <td class="text-center">
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash-alt"></i> @lang('delete')
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang('text.Close')</button>
            </div>
        </div>
    </div>
</div>
