@extends('layouts.app')

@push('style')
    <link rel="stylesheet" href="{{ asset('assets/css/order-detail-document.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between">
            <div class="d-flex">
                <a href="{{ route('order.index') }}" class="btn btn-secondary mb-2 me-2">
                    <i class="fas fa-arrow-left"></i> &nbsp; @lang('Back')
                </a>

                @if(\App\Helpers\Helper::checkOrderActionComment($order))
                    <div class="me-2">
                        <button type="button" class="btn btn-success js_reply_btn"
                                data-status=2
                                data-text="@lang('text.Agreed')">
                            <i class="fas fa-circle-check"></i> @lang('text.Agreed')
                        </button>
                    </div>
                    <div>
                        <button type="button" class="btn btn-danger js_reply_btn"
                                data-status=3
                                data-text="@lang('text.Declined')">
                            <i class="fas fa-times-circle"></i> @lang('text.Declined')
                        </button>
                    </div>
                @endif
            </div>
            <div class="d-flex">
                <div class="me-3 mt-2"><strong>@lang('Construction work'): ETC</strong></div>
                <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#uploadModal">
                    <i class="fas fa-paperclip"></i> @lang('attachFile')
                </button>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="text-center"><strong>№ - {{ $order['id'] }}</strong></div>
                <div class="my-3">
                    <div class="d-flex justify-content-center">
                        @include('order-detail.document')
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>@lang('actions_under_order')</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th width="3%">№</th>
                            <th>@lang('stage')</th>
                            <th>@lang('Instance')</th>
                            <th>@lang('User')</th>
                            <th>@lang('Status')</th>
                            <th>@lang('Comment')</th>
                            <th>@lang('Time')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderActions as $orderAction)
                            <tr>
                                <td>{{ ++$loop->index }}</td>
                                <td>{{ $orderAction['stage'] }}</td>
                                <td>{{ $orderAction['instanceName'] }}</td>
                                <td>{{ $orderAction['userName'] }}</td>
                                <td>
                                    @if($orderAction['status'] == 2)
                                        @lang('Agreed')
                                    @elseif($orderAction['status'] == 3)
                                        @lang('Declined')
                                    @endif
                                </td>
                                <td>{{ $orderAction['comment'] }}</td>
                                <td>{{ date('d.m.Y H:i', strtotime($orderAction['created_at'])) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{--        <div class="card shadow-sm mb-4">--}}
        {{--            <div class="card-body">--}}
        {{--                <h5>@lang('actions_under_subjects')</h5>--}}
        {{--                <div class="table-responsive">--}}
        {{--                    <table class="table table-striped table-bordered">--}}
        {{--                        <thead>--}}
        {{--                        <tr>--}}
        {{--                            <th>№</th>--}}
        {{--                            <th>№ @lang('subject')</th>--}}
        {{--                            <th>@lang('executed')</th>--}}
        {{--                            <th>@lang('user')</th>--}}
        {{--                            <th>@lang('description')</th>--}}
        {{--                        </tr>--}}
        {{--                        </thead>--}}
        {{--                        <tbody>--}}
        {{--                        <tr>--}}
        {{--                            <td>1</td>--}}
        {{--                            <td>1</td>--}}
        {{--                            <td>Executed</td>--}}
        {{--                            <td>Temur Butaev</td>--}}
        {{--                            <td>Description</td>--}}
        {{--                        </tr>--}}
        {{--                        <tr>--}}
        {{--                            <td colspan="5">01 Aug 2024 15:59:09, Temur Butaev, Creator</td>--}}
        {{--                        </tr>--}}
        {{--                        </tbody>--}}
        {{--                    </table>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <h5>@lang('passage_plan')</h5>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>@lang('Stage')</th>
                            <th>@lang('Instance')</th>
                            <th>@lang('UnstanceUsers')</th>
                            <th>@lang('period_of_consideration')</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orderRoadMap as $map)
                            <tr>
                                <td>{{ $map['stage'] }}</td>
                                <td>{{ $map['instanceName'] }}</td>
                                <td>{{ $map['userNames'] }}</td>
                                <td>{{ $map['timeLine'] }} @lang('working hours')</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('order-detail.confirmModal')
        @include('order-detail.uploadModal')
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/js/order-action.js') }}"></script>
    <script src="{{ asset('assets/js/order-file.js') }}"></script>
@endpush
