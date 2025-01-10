@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Customers">Customers</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Customers'))
        <div class="container-xxl flex-grow-1 container-p-y ">
            <h4 data-i18n="Customers"> Customers</h4>
            <div class="row">
                <table id="Customers" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="ID">ID</th>
                            <th data-i18n="name">Name</th>
                            <th data-i18n="email">Email</th>
                            <th data-i18n="Phone">Phone</th>
                            <th data-i18n="Vouchers Used">Vouchers Used</th>
                            <th data-i18n="Total Spent">Total Spent</th>
                            @if (auth()->user()->hasPermissionTo('Block Customer'))
                                <th data-i18n="Actions">Actions</th>
                                <th data-i18n="blocked until">blocked until</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>#{{ $customer->id }}</td>
                                <td><a href="{{ route('customers.edit', compact('customer')) }}">{{ $customer->name }}</a>
                                </td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->customervoucherredeemed()->count() }}</td>
                                <td>{{ $customer->customervoucherredeemed()->sum('paid_price') }}</td>
                                @if (auth()->user()->hasPermissionTo('Block Customer'))
                                    <td>
                                        @if ($customer->blocked)
                                            <form method="POST" action="{{ route('customer.unBlock', $customer->slug) }}"
                                                style="margin-bottom:0;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    onclick="showUnblockAlert(this)" data-i18n="UnBlock">
                                                    UnBlock</button>
                                            </form>
                                        @else
                                            <a class="btn btn-primary btn-sm"
                                                href="{{ route('customers.see', ['customer' => $customer]) }}"
                                                data-i18n="Block">Block</a>
                                        @endif

                                        @if (auth()->user()->hasPermissionTo('Delete Customer'))
                                            <form action="{{ route('customers.destroy', $customer->slug) }}" method="post"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger btn-sm " type="button"
                                                    onclick="showDeleteAlert(this)" data-i18n="Delete">Delete</button>
                                            </form>
                                        @endif
                                    </td>


                                    <td>
                                        @if ($customer->blocked)
                                            <p style="margin-bottom:0;">{{ $customer->blocked_until->format('Y-m-d') }}</p>
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
            $('#Customers').DataTable({
                "theme": "bs5",
            });

        });
    </script>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function showDeleteAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Deleted!",
                    text: "Customer has been deleted.",
                    icon: "success"
                });
            }
        });
    }

    function showUnblockAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, unblock it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "UnBlocked!",
                    text: "Customer has been UnBlocked.",
                    icon: "success"
                });
            }
        });
    }
</script>
