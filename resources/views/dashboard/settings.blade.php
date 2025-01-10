@extends('dashboard.layout.app')

@section('title')
    <title>Setting</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Settings'))
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

                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="py-3 mb-4"> <span data-i18n="Settings">Settings</span></h4>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="Settings">Settings</h5>
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" action={{ route('settings.update') }} method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label" data-i18n="Name">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    value="{{ $settings->name }}" autofocus />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="name_ar" class="form-label" data-i18n="Name AR">Name AR</label>
                                                <input class="form-control" type="text" id="name_ar" name="name_ar"
                                                    value="{{ $settings->name_ar }}" autofocus />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label" data-i18n="E-mail">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    value="{{ $settings->email }}" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="address" class="form-label" data-i18n="Address">Address</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    value="{{ $settings->address }}" placeholder="address" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="bank_commission" class="form-label"
                                                    data-i18n="Bank Commission">Bank
                                                    Commission</label>
                                                <input type="text" class="form-control" id="bank_commission"
                                                    name="bank_commission" value="{{ $settings->bank_commission }}"
                                                    placeholder="Bank Commission" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="vat_no" class="form-label" data-i18n="Vat_NO">Vat_NO</label>
                                                <input type="text" class="form-control" id="vat_no" name="vat_no"
                                                    value="{{ $settings->vat_no }}" placeholder="vat_no" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Com_Reg_No" class="form-label"
                                                    data-i18n="Commercial Register Number">Commercial Register
                                                    Number</label>
                                                <input type="text" class="form-control" id="Com_Reg_No" name="Com_Reg_No"
                                                    value="{{ $settings->Com_Reg_No }}" placeholder="Com_Reg_No" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="IOS_Link" class="form-label" data-i18n="IOS Link">IOS
                                                    Link</label>
                                                <input type="text" class="form-control" id="IOS_Link" name="IOS_Link"
                                                    disabled value="{{ $settings->IOS_Link }}" placeholder="IOS_Link" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Android_Link" class="form-label"
                                                    data-i18n="Android Link">Android
                                                    Link</label>
                                                <input type="text" class="form-control" id="Android_Link"
                                                    name="Android_Link" disabled value="{{ $settings->Android_Link }}"
                                                    placeholder="Android_Link" />

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
