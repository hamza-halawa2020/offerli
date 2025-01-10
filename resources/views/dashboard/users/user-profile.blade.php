@extends('dashboard.layout.app')

@section('title')
    <title>My Profile</title>
@endsection

@section('content')
{{-- @if (auth()->user()->hasPermissionTo('View Users')) --}}

    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"> {{ $user->name }} - <span data-i18n="Accountt"> Account </span></h4>
                <div class="row">
                    <div class="col-md-12">

                        <div class="card mb-4">
                            <h5 class="card-header" data-i18n="User Details">User Details</h5>
                            <div class="card-body">

                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <form method="post" id="formAccountSettings" action="{{ route('profile.update') }}"
                                    class="mt-6 space-y-6">
                                    <div class="row">
                                        @csrf
                                        @method('patch')
                                        <div class="mb-3 col-md-6">
                                            <label for="name" class="form-label" data-i18n="name">Name</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                value="{{ $user->name }}" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">

                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label" data-i18n="email">Email</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                disabled value="{{ $user->email }}" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2" data-i18n="Save">Save changes</button>
                                            <button type="reset" class="btn btn-label-secondary" data-i18n="Cancel">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /Account -->
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <h5 class="card-header" data-i18n="Change Password">Change Password </h5>
                            <div class="card-body">

                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    <div class="row">
                                        @csrf
                                        @method('put')
                                        <div class="mb-3 col-md-6">
                                            <label for="current_password" class="form-label" data-i18n="Current Password">Current Password</label>
                                            <input class="form-control" type="password" id="current_password"
                                                name="current_password" autofocus />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="password" class="form-label" data-i18n="Password">Password</label>
                                            <input class="form-control" type="password" id="password" name="password" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="password_confirmation" class="form-label" data-i18n="Password Confirmation">Password
                                                Confirmation</label>
                                            <input class="form-control" type="password" id="password_confirmation"
                                                name="password_confirmation" />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2" data-i18n="Update Password">Update Password</button>
                                            <button type="reset" class="btn btn-label-secondary" data-i18n="Cancel">Cancel</button>
                                        </div>

                                </form>
                            </div>
                            <!-- /Account -->
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endif --}}
@endsection
