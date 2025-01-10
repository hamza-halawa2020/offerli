@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Permissions">Permissions</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Roles'))
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"> {{ $role->name }} - <span data-i18n="Permissions">Permissions</span></h4>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mb-4">
                                <h5 class="card-header"></h5>
                                <div class="card-body">

                                    <hr class="my-0" />
                                    <div class="card-body">
                                        <form id="formAccountSettings" action="{{ route('roles.update', $role->id) }}"
                                            method="post">
                                            @csrf
                                            @method('patch')
                                            <div class="row">
                                                <div class="mb-3 col-md-6">

                                                </div>
                                                <div class="mb-3 col-md-6">

                                                </div>
                                                <div class="flex-grow-1 row">
                                                    @foreach ($permissions as $permission)
                                                        <div class="col-9 mb-sm-0 mb-2">
                                                            <h5 class="mb-0">{{ $permission->name }}</h5>
                                                        </div>
                                                        <div class="col-3 d-flex align-items-center justify-content-start">
                                                            <div class="form-check form-switch">
                                                                <input class="form-check-input float-start"
                                                                    name="{{ $permission->id }}" type="checkbox"
                                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} />
                                                            </div>
                                                        </div>
                                                        <hr class="my-0" />
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="mt-5">
                                                <button type="submit" class="btn btn-primary me-2" data-i18n="Save">Save
                                                    changes</button>
                                                <button type="reset" class="btn btn-label-secondary"
                                                    data-i18n="Cancel">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
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


@section('jsinc')
    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection
