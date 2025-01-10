@extends('dashboard.layout.app')

@section('title')
    <title data-i18n="Customer">customer</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Customers'))
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"> {{ $customer->name }} - <span data-i18n="Account">Account</span></h4>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="customer Details">customer Details</h5>
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings"
                                        action={{ route('customer.block', ['customer' => $customer]) }} method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label" data-i18n="name">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    disabled value="{{ $customer->name }}" autofocus />
                                            </div>
                                            <div class="mb-3 col-md-6">


                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="time" class="form-label" data-i18n="Block For">Block
                                                    For</label>
                                                <input class="form-control" type="text" id="time"
                                                    name="time"autofocus />

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
