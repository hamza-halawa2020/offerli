@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Rating">Rating</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Rating'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 data-i18n="Rating"> Rating</h4>
            <div class="row">
                <table id="Rating" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Customer Name">Customer Name</th>
                            <th data-i18n="Voucher">Voucher</th>
                            <th data-i18n="Brand">Brand</th>
                            <th data-i18n="Rating of 5">Rating of 5 </th>
                            <th data-i18n="Comment">Comments</th>
                            @if (auth()->user()->hasPermissionTo('Delete Rating'))
                                <th data-i18n="Delete">Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratedVouchers as $voucher)
                            <tr>
                                <td>{{ $voucher->customer->name }}</td>
                                <td>{{ $voucher->voucher->title }}</td>
                                <td>
                                    {{-- {{ $voucher->branch->brand->name }} --}}
                                </td>
                                <td>{{ $voucher->rating }}</td>
                                <td>{{ $voucher->rating_comment }}</td>
                                @if (auth()->user()->hasPermissionTo('Delete Rating'))
                                    <td>
                                        <form action="{{ route('rating.destroy', $voucher->id) }}" method="post"
                                            style="margin-bottom: 0;">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm " type="button"
                                                onclick="showDeleteAlert(this)" data-i18n="Delete">Delete</button>
                                        </form>
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
            $('#Rating').DataTable({
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
                    text: "Rating has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>
