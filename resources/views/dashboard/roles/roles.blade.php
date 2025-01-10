@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Roles">Roles</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Roles'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h4 data-i18n="Roles" style="margin: 0;"> Roles</h4>
                @if (auth()->user()->hasPermissionTo('Add Role'))
                    <a class="btn btn-primary " style="margin: 0;" href={{ route('roles.create') }} data-i18n="Add New Role">
                        Add New Role</a>
                @endif

            </div>
            <div class="row">
                <table id="roles" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="role">Role</th>
                            <th data-i18n="Permissions">Permissions</th>
                            {{-- <th data-i18n="delete">Delete</th> --}}
                            {{-- @if (auth()->user()->hasPermissionTo('Add Role'))
                                <th>
                                    <a class="btn btn-primary " href={{ route('roles.create') }} data-i18n="add"> Add</a>
                                </th>
                            @endif --}}

                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td><a href="{{ route('roles.show', $role->id) }}">{{ ucfirst($role->name) }}</a></td>
                                <td>{{ implode(',', $role->permissions->pluck('name')->toArray()) }}</td>
                                {{-- <td>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm " type="submit"
                                        onclick="return confirm('are you sure')" data-i18n="delete">Delete</button>
                                </form>
                            </td> --}}
                                {{-- @if (auth()->user()->hasPermissionTo('Add Role'))
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
            $('#roles').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection
