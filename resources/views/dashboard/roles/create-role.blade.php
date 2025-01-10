@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="New Role">New Role</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Roles'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4 mt-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" data-i18n="New Role">New Role</h5>
                            <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('roles.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name" data-i18n="Role Name">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Admin" />
                                </div>
                                <button type="submit" class="btn btn-primary" data-i18n="Save">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
