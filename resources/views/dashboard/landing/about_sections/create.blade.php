@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="New about">New about</title>
@endsection

@section('content')
    @include('dashboard.landing.navbar.index')

    @if (auth()->user()->hasPermissionTo('Edit Landing'))
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
                        <div class="card-about d-flex justify-content-between align-items-center">
                            <h5 class="mb-0" data-i18n="New about">New about</h5>
                            <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('about-sections.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div style="padding-bottom: 20px;">
                                    <label for="title" class="form-label">Title</label>
                                    <input name="title" class="form-control" id="title" type="text">
                                </div>
                                <div style="padding-bottom: 20px;">
                                    <label for="desc" class="form-label">Description</label>
                                    <input name="description" class="form-control" id="desc" type="text">
                                </div>
                                <div style="padding-bottom: 20px;">
                                    <label for="formFileMultiple" class="form-label">Image</label>
                                    <input name="image" class="form-control" id="formFileMultiple" type="file">
                                </div>
                                <button type="submit" class="btn btn-primary" data-i18n="Add">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
