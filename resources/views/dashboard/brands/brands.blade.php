@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Brands">Brands</title>
@endsection


@section('content')
    @if (auth()->user()->hasPermissionTo('View Brands'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 data-i18n="Brands" style="margin: 0;">Brands</h4>
                <a class="btn btn-primary " style="margin: 0;" href={{ route('brands.create') }} data-i18n="Add New Brand">
                    Add New Brand</a>
            </div>
            <div class="row">
                <table id="brands" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Logo">Logo</th>
                            <th data-i18n="name">Name</th>
                            <th data-i18n="Branches">Branches</th>
                            <th data-i18n="Commission">Commission</th>
                            <th data-i18n="email">Email</th>
                            {{-- <th data-i18n="Vat_NO">Vat_NO</th> --}}

                            <th data-i18n="Actions">Actions</th>
                            <th data-i18n="featured until">featured until</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td style="width: 30px; height: 30px; overflow: hidden;">
                                    <a href="{{ route('images.index', $brand) }}">

                                        <img src="{{ asset('images/brand/' . $brand->logo) }}" alt=""
                                            style="width: 100%; height: 100%; object-fit: cover;">
                                    </a>

                                </td>
                                <td><a href="{{ route('brands.edit', $brand->slug) }}">{{ $brand->name }}</a></td>
                                <td><a href="{{ route('brands.show', $brand->slug) }}">{{ $brand->branches->count() }}</a>
                                </td>
                                <td>{{ $brand->percentage }}</td>
                                <td>{{ $brand->email }}</td>
                                {{-- <td>{{ $brand->vat_no }}</td> --}}
                                @if (auth()->user()->hasPermissionTo('Activate Brand'))
                                    <td class="d-flex">
                                        @if ($brand->active)
                                            <form method="POST" class="deactivateForm"
                                                action="{{ route('brand.deactivate', $brand->slug) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-danger btn-sm" type="button"
                                                    onclick="showDeActivateAlert(this)"
                                                    data-i18n="Deactivate">Deactivate</button>
                                            </form>
                                        @else
                                            <form method="POST" class="activateForm"
                                                action="{{ route('brand.activate', $brand->slug) }}"
                                                style="margin-bottom: 0;">
                                                @csrf
                                                <button class="btn btn-primary btn-sm" type="button"
                                                    onclick="showActivateAlert(this)" data-i18n="Activate">Activate</button>
                                            </form>
                                        @endif
                                @endif

                                @if (auth()->user()->hasPermissionTo('Delete Brand'))
                                    <form class="deleteForm" action="{{ route('brands.destroy', $brand->slug) }}"
                                        style="margin-bottom: 0;" method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm confirm-color" type="button"
                                            onclick="showDeleteAlert(this)" data-i18n="Delete"
                                            data-brand-id="{{ $brand->id }}">Delete</button>
                                    </form>
                                @endif
                                @if (auth()->user()->hasPermissionTo('Feature Brand'))
                                    @if ($brand->featured)
                                        <form method="POST" action="{{ route('brand.unfeatured', $brand->slug) }}"
                                            class="unfeatureForm" style="margin-bottom: 0;">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="button"
                                                onclick="showunfeatureAlert(this)" data-i18n="Unfeature">Unfeature</button>
                                        </form>
                                    @else
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('brands.see', ['brand' => $brand]) }}"
                                            data-i18n="Feature">Feature</a>
                                    @endif
                                    </td>
                                    <td>
                                        @if ($brand->featured)
                                            <p>{{ $brand->featured_until->format('Y-m-d') }}</p>
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
            $('#brands').DataTable({
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
                    text: "Brand has been deleted.",
                    icon: "success"
                });
            }
        });
    }

    function showunfeatureAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, UnFeature it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Unfeatured!",
                    text: "This Brand is Unfeatured Now!",
                    icon: "success"
                });
            }
        });
    }

    function showActivateAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Will Activate this brand",
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
                    text: "The Brand is activated",
                    icon: "success"
                });
            }
        });
    }

    function showDeActivateAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You Will DeActivate this brand",
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
                    text: "The Brand is Deactivated",
                    icon: "success"
                });
            }
        });
    }
</script>
