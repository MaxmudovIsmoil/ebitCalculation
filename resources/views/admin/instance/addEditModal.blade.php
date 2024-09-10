<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">{{ __('Добавить инстанция') }}</h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-5 form-group">
                            <label for="name_ru">{{ __('Инстанция') }} RU<span class="text-danger">*</span></label>
                            <input type="text" name="name_ru" class="form-control js_name_ru" id="name_ru" />
                            <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                        </div>

                        <div class="col-md-4 form-group pl-0 pr-0">
                            <label for="name_en">{{ __('Инстанция') }} EN<span class="text-danger">*</span></label>
                            <input type="text" name="name_en" class="form-control js_name_en" id="name_en" />
                            <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                        </div>

                        <div class="col-md-3 form-group">
                            <label for="time_line">{{ __('Лента новостей') }}<span class="text-danger">*</span></label>
                            <input type="number" name="time_line" class="form-control js_time_line" id="time_line" />
                            <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saveBtn">{{ __('Сохранять') }}</button>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Закрыть') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
