@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Landing Page">Landing Page</title>
@endsection



@section('content')
    @include('dashboard.landing.navbar.index')

    @if (auth()->user()->hasPermissionTo('Edit Landing'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 data-i18n="Landing section" style="margin: 0;"> about section</h4>
                @if (auth()->user()->hasPermissionTo('Edit Landing'))
                    <a class="btn btn-primary " style="margin: 0;" href={{ route('about-sections.create') }}
                        data-i18n="Add New about">
                        Add New about</a>
                @endif
            </div>
            <div class="row">
                <table id="Images" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="ID">ID</th>
                            <th data-i18n="Title">Title</th>
                            <th data-i18n="Description">Description</th>
                            <th data-i18n="Image">Image</th>
                            @if (auth()->user()->hasPermissionTo('Edit Landing'))
                                <th data-i18n="ACtion">ACtion</th>
                            @endif

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($abouts as $about)
                            <tr>
                                <td>{{ $about->id }}</td>

                                <td>{{ $about->title }}</td>
                                <td>{{ $about->description }}</td>
                                <td>
                                    <img src="{{ asset('images/aboutSections/' . $about->image) }}" alt=""
                                        width="150px" height="150px">
                                </td>
                                @if (auth()->user()->hasPermissionTo('Edit Landing'))
                                    <td>
                                        <form
                                            action="{{ route('about-sections.destroy', ['about_section' => $about->id]) }}"
                                            method="post" style="margin-bottom: 0;" class="deleteForm">
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
            $('#Images').DataTable({
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
                    text: "Image has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>
