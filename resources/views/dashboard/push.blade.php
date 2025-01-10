@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Push Notifications">Push Notifications</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('Push Notifications'))
        <div class="container-xxl flex-grow-1 container-p-y">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4 mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" data-i18n="Push Notifications">Push Notifications</h5>
                            <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('push-notifiations') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="title" data-i18n="Notification Title">Notification
                                        Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Title" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="content" data-i18n="Notification Content">Notification
                                        Content
                                        AR</label>
                                    <input type="text" class="form-control" id="content" name="content"
                                        placeholder="Content" />
                                </div>
                                <button type="button" class="btn btn-primary" onclick="showAlert(this)">
                                    Push <i class="fab fa-telegram fa-2x" style="margin-left: 10px;"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('node_modules/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showAlert(button) {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#7367f0",
            confirmButtonText: "Yes, Push it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Get the form element by its class
                var form = button.closest('form');
                // Submit the form
                form.submit();
                // Optionally, you can show another Swal.fire for success
                Swal.fire({
                    title: "Successful!",
                    text: "Notifications Push Successfully",
                    icon: "success"
                });
            }
        });
    }
</script>
