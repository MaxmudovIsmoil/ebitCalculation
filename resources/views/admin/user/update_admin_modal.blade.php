<div class="modal fade text-left" id="admin_update_modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">{{ __('Обновление администратора') }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin_update') }}" method="POST" class="js_admin_update_form">
                @csrf

                <div class="modal-body">

                    <div class="form-group">
                        <label for="email1">{{ __('Эл. адрес') }} <span class="text-red">*</span></label>
                        <input type="email" name="email" class="form-control js_email" id="email1" value="{{ Auth::guard('user')->user()->email }}"/>
                        <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                    </div>

                    <div class="form-group">
                        <label for="username">{{ __('Имя пользователя') }} <span class="text-red">*</span></label>
                        <input type="text" name="username" class="form-control js_username" id="username" value="{{ Auth::guard('user')->user()->username }}"/>
                        <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Пароль') }} <span class="text-red">*</span></label>
                        <input type="password" name="password" class="form-control js_password" value=""/>
                        <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                    </div>

                    <div class="form-group">
                        <label>{{ __('Пароль') }} {{ __('Подтвердить') }} <span class="text-red">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control js_password_confirmation" />
                        <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="saveBtn">{{ __('Сохранять') }}</button>

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Закрыть') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
