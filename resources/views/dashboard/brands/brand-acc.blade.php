@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Brand">Brand</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Brands'))
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"> {{ $brand->name }} - <span data-i18n="Account">Account</span></h4>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="Brand Details">Brand Details</h5>
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" action={{ route('brand.featured', ['brand' => $brand]) }}
                                        method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label" data-i18n="Name">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    disabled value="{{ $brand->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="name_ar" class="form-label" data-i18n="Name AR">Name AR</label>
                                                <input class="form-control" type="text" id="name_ar" name="name_ar"
                                                    disabled value="{{ $brand->name_ar }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="featured" class="form-label"
                                                    data-i18n="Feature For">FeatureFor</label>
                                                <input class="form-control" type="text" id="featured"
                                                    name="featured"autofocus />
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


@section('jsinc')
    <script>
        $(document).ready(function() {
            $('#roles').DataTable({
                "theme": "bs5"
            });
        });
    </script>
@endsection
