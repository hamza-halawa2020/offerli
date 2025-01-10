@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Branches">Branches</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Brands'))
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"> {{ $brand->name }} - <span data-i18n="Branches">branches</span></h4>
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            {{-- <div class="alert alert-danger" role="alert">This is a danger alert — check it out!</div> --}}
            <div class="row">
                <table id="Branch" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th data-i18n="Branch">Branch</th>
                            <th data-i18n="Vouchers">Vouchers</th>
                            @if (auth()->user()->hasPermissionTo('Make Invoice'))
                                <th data-i18n="Invoice">Invoice</th>
                            @endif

                            @if (auth()->user()->hasPermissionTo('Delete Brand'))
                                <th data-i18n="delete">Delete</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brand->branches as $branch)
                            <tr>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->vouchers->count() }}</td>
                                @if (auth()->user()->hasPermissionTo('Make Invoice'))
                                    <td>
                                        <a class="btn btn-primary btn-sm"
                                            href="{{ route('branch.invoice', ['branch' => $branch->slug]) }}"
                                            target="_blank" data-i18n="Invoice">Invoice</a>
                                    </td>
                                @endif

                                @if (auth()->user()->hasPermissionTo('Delete Brand'))
                                    <td>
                                        <form action="{{ route('branch.destroy', $branch->slug) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm " type="submit"
                                                onclick="return confirm('are you sure')" data-i18n="delete">Delete</button>
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
            $('#Branch').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection
