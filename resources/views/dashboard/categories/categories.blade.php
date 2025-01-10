@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Categories">Categories</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Categories'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 data-i18n="Categories" style="margin: 0;"> Categories</h4>
                @if (auth()->user()->hasPermissionTo('Add Category'))
                    <a class="btn btn-primary " style="margin: 0;" href={{ route('categories.create') }}
                        data-i18n="Add New Category">
                        Add New Category</a>
                @endif
            </div>
            <div class="row">
                <table id="Categories" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Category Logo">Category Logo</th>
                            <th data-i18n="Category">Category</th>
                            <th data-i18n="Sub-Categories">Sub-Categories</th>
                            @if (auth()->user()->hasPermissionTo('Delete Category'))
                                <th data-i18n="Delete">Delete</th>
                            @endif


                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>

                                <td>
                                    <img src="{{ asset('images/category/' . $category->logo) }}" alt=""
                                        width="50px" height="50px">

                                </td>
                                <td><a
                                        href="{{ route('categories.edit', $category->slug) }}">{{ ucfirst($category->name) }}</a>
                                </td>
                                <td> <a href="{{ route('categories.show', $category->slug) }}">{{ implode(',', $category->subcategories->pluck('name')->toArray()) }}
                                    </a></td>
                                @if (auth()->user()->hasPermissionTo('Delete Category'))
                                    <td>
                                        <form action="{{ route('categories.destroy', $category->slug) }}" method="post"
                                            style="margin-bottom: 0;" class="deleteForm">
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
            $('#Categories').DataTable({
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
                    text: "Category has been deleted.",
                    icon: "success"
                });
            }
        });
    }
</script>
