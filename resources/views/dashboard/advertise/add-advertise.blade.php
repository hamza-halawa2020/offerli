@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="New Advertise">New Advertise</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('Add Advertise'))
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
                            <h5 class="mb-0" data-i18n="New Advertise">New Advertise</h5>
                            <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('advertise.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div style="padding-bottom: 20px;">
                                    <label for="formFileMultiple" class="form-label">Advertise</label>
                                    <input name="image" class="form-control" id="formFileMultiple" type="file">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="brand_id" data-i18n="Brand">Brand</label>
                                    <select class="form-select" aria-label="Brand" name="brand_id">
                                        <option disabled selected>Select targeted Brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="service_id" data-i18n="Service">Service</label>
                                    <select class="form-select" aria-label="Service" name="service_id">
                                        <option disabled selected>Select targeted Service</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}">{{ $service->name_en }}</option>
                                        @endforeach
                                    </select>
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
