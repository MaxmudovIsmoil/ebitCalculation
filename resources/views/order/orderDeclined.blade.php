<section class="app-user-list">
    <!-- list section start -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <table id="orderDeclined" class="table table-bordered table-fs-sm table-striped table-responsive" style="width:100%;">
                <thead>
                <tr>
                    <th>№</th>
                    <th>@lang('Date')</th>
                    <th>@lang('Client')</th>
                    <th>@lang('Address')</th>
                    <th>@lang('Instnace')</th>
                    <th>@lang('Author')</th>
                    <th>@lang('status')</th>
                    <th>@lang('Current Instance')</th>
                    <th>@lang('stage')</th>
                    <th>@lang('Comment')</th>
                    <th class="text-right">@lang('CreatedAt')</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderDeclined as $order)
                    <tr class="fw-semibold">
                        <td class="align-middle">
                            <p class="text-center mb-0">
                                {{ $order->id }} <br/>
                                <a class="a-eye" href="{{ route('orderDetail', $order->id) }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </p>
                        </td>
                        <td class="align-middle">{{ $order->date }}</td>
                        <td class="align-middle">{{ $order->client }}</td>
                        <td class="align-middle">{{ $order->address }}</td>
                        <td class="align-middle">{{ $order->instanceName }}</td>
                        <td class="align-middle">{{ $order->userName }}</td>
                        <td class="align-middle">{{ $order->status->getLabelText() }}</td>
                        <td class="align-middle">{{ $order->currentInstanceName }}</td>
                        <td class="align-middle text-center">{{ $order->allStage }} / {{ $order->currentStage }}</td>
                        <td class="align-middle">{{ $order->comment }}</td>
                        <td class="align-middle">{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $orderDeclined->links() }}
    </div>
</section>
