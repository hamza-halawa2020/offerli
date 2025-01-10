@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Sales">Sales</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Sales'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 data-i18n="Sales"> Sales</h4>
            <div class="row">
                <table id="Sales" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Order ID">Order ID</th>
                            <th data-i18n="Customer Name">Customer Name</th>
                            <th data-i18n="Status">Status</th>
                            <th data-i18n="Voucher">Voucher</th>
                            <th data-i18n="Brand">Brand</th>
                            <th data-i18n="Payment Type">Payment Type</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            <tr>
                                <td>{{ $sale->id }}</td>
                                @if ($sale->customer)
                                    <td>{{ $sale->customer->name }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if ($sale->status)
                                    <td>{{ $sale->status->name }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if ($sale->voucher)
                                    <td>{{ $sale->voucher->code }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if ($sale->voucher && $sale->voucher->brand)
                                    <td>{{ $sale->voucher->brand->name }}</td>
                                @else
                                    <td></td>
                                @endif
                                @if ($sale->payment)
                                    <td>{{ $sale->payment->name }}</td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
@endsection


@section('jsinc')
    <script>
        $(document).ready(function() {
            $('#Sales').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection
