@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Invoices">Invoices</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Invoices'))
        <div class="container-xxl flex-grow-1 container-p-y ">
            <h4 data-i18n="Invoices"> Invoices</h4>
            <div class="row">
                <table id="Invoices" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Invoice No">Invoice No</th>
                            <th data-i18n="Price">Price</th>
                            <th data-i18n="User">User</th>
                            <th data-i18n="Branch">Branch</th>
                            <th data-i18n="Brand">Brand</th>
                            <th data-i18n="Status">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td><a target="_blank"
                                        href="{{ route('invoice.show', compact('invoice')) }}">{{ $invoice->invoice_number }}</a>
                                </td>
                                <td>{{ $invoice->total_invoice }}</td>
                                <td>{{ $invoice->user->name }}</td>
                                <td>{{ $invoice->branch->name }}</td>
                                <td>{{ $invoice->branch->brand->name }}</td>

                                @if (auth()->user()->hasPermissionTo('Make Invoice'))
                                    <td>
                                        @if ($invoice->paid)
                                            <span class="badge bg-label-success">Paid</span>
                                            {{-- <form method="POST"
                                                action="{{ route('invoice.unPaid', $invoice->id) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    onclick="showUnpaidAlert(this)"
                                                    data-i18n="Unpaid">Unpaid</button>
                                            </form> --}}
                                        @else
                                            <form method="POST" action="{{ route('invoice.paid', $invoice->id) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    onclick="showpaidAlert(this)" data-i18n="paid">paid</button>
                                            </form>
                                        @endif
                                    </td>
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
            $('#Invoices').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
    function showpaidAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, make it paid !"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Paid !",
                    text: " It's Paid",
                    icon: "success"
                });
            }
        });
    }

</script>

