@extends('dashboard.layout.app')

@section('title')
    <title>User</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Users'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="row">

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"> {{ $user->name }} - <span data-i18n="Accountt"> Account </span></h4>
                    <div class="row">
                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="User Details">User Details</h5>
                                <!-- Account -->
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" action={{ route('user.update', $user->slug) }}
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    data-i18n="name" value="{{ $user->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    data-i18n="email" value="{{ $user->email }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="sence" class="form-label" data-i18n="Sence">Sence</label>
                                                <input type="text" class="form-control" id="sence" name="sence"
                                                    value="{{ $user->created_at->diffForHumans() }}" placeholder="Sence"
                                                    disabled />
                                            </div>
                                            <div class="mb-3 col-md-6">

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="role" class="form-label" data-i18n="role">Role</label>
                                                <select id="role" name="role" class=" form-select">
                                                    <option value="Select Role">Select Role</option>
                                                    @foreach ($roles as $role)
                                                        <option
                                                            {{ $user->getRoleNames()->first() == $role->name ? 'selected' : '' }}
                                                            value="{{ $role->name }}">{{ $role->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2" data-i18n="Save">Save
                                                changes</button>
                                            <button type="reset" class="btn btn-label-secondary"
                                                data-i18n="Cancel">Cancel</button>
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
    @endif
@endsection
