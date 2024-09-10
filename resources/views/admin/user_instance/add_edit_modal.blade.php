<div class="modal fade text-left" id="add_edit_modal" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33"></h4>
            </div>
            <form action="" method="POST" class="js_add_edit_form">
                @csrf
                <input type="hidden" name="order_type_id" class="js_order_type_id" value="" />
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-2 form-group">
                            <label for="stage">{{ __('Стадия') }}<span class="text-danger">*</span></label>
                            <input type="number" name="stage" class="form-control js_stage" id="stage" />
                            <div class="invalid-feedback">{{ __('Поле обязательно для заполнения.') }}</div>
                        </div>

                        <div class="col-md-10 form-group">
                            <label for="instance">{{ __('Инстанция') }}<span class="text-danger">*</span></label>
                            <select name="instance_id" class="form-control js_instance" id="instance">
                                <option value="">---</option>
                                @foreach ($instances as $i)
                                    <option value="{{ $i->id }}">@if($lang =='en') {{ $i->name_en }} @else {{ $i->name_ru }} @endif</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 form-group">
                            <label for="user_ids">{{ __('Пользователи') }}<span class="text-danger">*</span></label>
                            <select name="user_ids[]" class="form-control js_user_ids" id="user_ids"
                                multiple="multiple">
                                <option value="">---</option>
                                @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->full_name }}</option>
                                @endforeach
                            </select>
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
