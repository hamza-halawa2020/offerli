@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="New Sub-Category">New Sub-Category</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Categories'))
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
                            <h5 class="mb-0" data-i18n="New Sub-Category">New Sub-Category</h5>
                            <small class="text-muted float-end"></small>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('subcategories.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label" for="name" data-i18n="Sub-Category Name">Sub-Category
                                        Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Name" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="name_ar" data-i18n="Sub-Category Name AR">Sub-Category
                                        Name
                                        AR</label>
                                    <input type="text" class="form-control" id="name_ar" name="name_ar"
                                        placeholder="الاسم باللغة العربية" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="category" data-i18n="Category">Category</label>
                                    <select class="form-select" aria-label="Category" name="category_id">
                                        <option disabled selected>Select targeted Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div style="padding-bottom: 20px;">
                                    <label for="formFileMultiple" class="form-label">Sub Category Logo</label>
                                    <input name="logo" class="form-control" id="formFileMultiple" type="file">
                                </div>
                                <button type="submit" class="btn btn-primary" data-i18n="add">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
