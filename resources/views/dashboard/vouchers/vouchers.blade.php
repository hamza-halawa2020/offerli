@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Vouchers">Vouchers</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Vouchers'))
        <div class="container-xxl flex-grow-1 container-p-y ">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 data-i18n="Vouchers" style="margin: 0;">Vouchers</h4>
                @if (auth()->user()->hasPermissionTo('Add Voucher'))
                    <div style="display: flex; align-items: center;">
                        <a class="btn btn-primary" style="margin: 0;margin-right: 10px;" href={{ route('vouchers.create') }}
                            data-i18n="Add New Voucher">
                            Add New Voucher
                        </a>
                        <a class="btn btn-primary" style="margin: 0;" href={{ route('vouchers.createEvent') }}
                            data-i18n="Add New Event">
                            Add New Event
                        </a>
                    </div>
                @endif
            </div>
            <div class="row ">
                <table id="vouchers" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Code"> Code</th>
                            <th data-i18n="Price">Price</th>
                            <th data-i18n="Discount">Discount</th>
                            <th data-i18n="Category">Category</th>
                            <th data-i18n="Sub-Category">Sub-Category</th>
                            <th data-i18n="Expire Date">Expire Date</th>
                            <th data-i18n="Brand">Brand</th>
                            @if (auth()->user()->hasPermissionTo('Activate Voucher'))
                                <th data-i18n="Status">Status</th>
                            @endif

                            @if (auth()->user()->hasPermissionTo('Delete Voucher'))
                                <th data-i18n="delete">Delete</th>
                            @endif

                            {{-- @if (auth()->user()->hasPermissionTo('Add Voucher'))
                                <th>
                                    <a class="btn btn-primary " href={{ route('vouchers.create') }} data-i18n="add">
                                        Add</a>
                                </th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vouchers as $voucher)
                            <tr>
                                @if (auth()->user()->hasPermissionTo('Edit Voucher'))
                                    <td>
                                        <a
                                            href="{{ route('vouchers.edit', ['voucher' => $voucher->slug]) }}">{{ $voucher->code }}</a>
                                    </td>
                                @else
                                    <td>{{ $voucher->code }}</td>
                                @endif
                                <td>{{ $voucher->price }}</td>
                                <td>{{ $voucher->discount }}</td>



                                @if ($voucher->subcategory && $voucher->subcategory->category)
                                    <td>{{ $voucher->subcategory->category->name }}</td>
                                @else
                                    <td></td>
                                @endif

                                @if ($voucher->subcategory)
                                    <td>{{ $voucher->subcategory->name }}</td>
                                @else
                                    <td></td>
                                @endif

                                <td>{{ $voucher->expire_at->format('Y-m-d') }}</td>

                                @if ($voucher->brand)
                                    <td>{{ $voucher->brand->name }}</td>
                                @else
                                    <td></td>
                                @endif

                                @if (auth()->user()->hasPermissionTo('Activate Voucher'))
                                    <td>
                                        @if ($voucher->active)
                                            <form method="POST" action="{{ route('voucher.deactivate', $voucher->slug) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    onclick="showDeActivateAlert(this)"
                                                    data-i18n="Deactivate">Deactivate</button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('voucher.activate', $voucher->slug) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    onclick="showActivateAlert(this)" data-i18n="Activate">Activate</button>
                                            </form>
                                        @endif
                                    </td>
                                @endif

                                @if (auth()->user()->hasPermissionTo('Delete Voucher'))
                                    <td>
                                        <form action="{{ route('vouchers.destroy', $voucher->slug) }}" method="post"
                                            style="margin-bottom: 0;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm " type="button"
                                                onclick="showDeleteAlert(this)" data-i18n="Delete">Delete</button>
                                        </form>
                                    </td>
                                @endif

                                {{-- @if (auth()->user()->hasPermissionTo('Add Voucher'))
                                    <td></td>
                                @endif --}}


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
            $('#vouchers').DataTable({
                "theme": "bs5"
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
                    text: "User has been deleted.",
                    icon: "success"
                });
            }
        });
    }

    function showActivateAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Will Activate this Voucher",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#7367f0",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Activate it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Activated!",
                    text: "The Voucher is activated",
                    icon: "success"
                });
            }
        });
    }

    function showDeActivateAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Will DeActivate this Voucher",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, DeActivate it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Activated!",
                    text: "The Voucher is Deactivated",
                    icon: "success"
                });
            }
        });
    }
</script>
