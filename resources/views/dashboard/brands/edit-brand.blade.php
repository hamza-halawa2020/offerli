@extends('dashboard.layout.app')

@section('title')
    <title>Brand</title>
@endsection

@section('content')
    @if (auth()->user()->hasPermissionTo('View Brands'))
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
                    <h4 class="py-3 mb-4"> {{ $brand->name }} - <span data-i18n="Brand">Brand</span></h4>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="Brand Details">Brand Details</h5>
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" action={{ route('brands.update', $brand->slug) }}
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="name" class="form-label" data-i18n="Name">Name</label>
                                                <input class="form-control" type="text" id="name" name="name"
                                                    placeholder="Name" autofocus value="{{ $brand->name }}" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="name_ar" class="form-label" data-i18n="Name AR">Name AR</label>
                                                <input class="form-control" type="text" id="name_ar" name="name_ar"
                                                    placeholder="Name AR" value="{{ $brand->name_ar }}" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label" data-i18n="E-mail">E-mail</label>
                                                <input class="form-control" type="text" id="email" name="email"
                                                    placeholder="E-mail" value="{{ $brand->email }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="phone" class="form-label" data-i18n="Phone">Phone</label>
                                                <input class="form-control" type="text" id="phone" name="phone"
                                                    placeholder="Phone" value="{{ $brand->phone }}" />
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="percentage" class="form-label"
                                                    data-i18n="Percentage">Percentage</label>
                                                <input type="text" class="form-control" id="percentage" name="percentage"
                                                    placeholder="Percentage %" value="{{ $brand->percentage }}" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Other fees" class="form-label" data-i18n="Other fees">Other
                                                    fees</label>
                                                <input type="text" class="form-control" id="other_fee" name="other_fee"
                                                    placeholder="Other fees" value="{{ $brand->other_fee }}" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="vat_no" class="form-label" data-i18n="Vat_NO">Vat No.</label>
                                                <input type="text" class="form-control" id="vat_no" name="vat_no"
                                                    placeholder="Vat No." value="{{ $brand->vat_no }}" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="Com_Reg_No" class="form-label" data-i18n="Commercial Register Number">Com Reg
                                                    No.</label>
                                                <input type="text" class="form-control" id="Com_Reg_No" name="Com_Reg_No"
                                                    placeholder="Com Reg No." value="{{ $brand->Com_Reg_No }}" />

                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="formFileMultiple" class="form-label" data-i18n="Logo">Logo</label>
                                                <input name="logo" class="form-control" id="formFileMultiple"
                                                    type="file">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="description" class="form-label"
                                                    data-i18n="Description">Description</label>
                                                <textarea name="description" class="form-control" id="description" placeholder="Descripe The Brand">{{ $brand->description }} </textarea>
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
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header" data-i18n="Brand Times">Brand Times</h5>
                                <div class="card-body">

                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <form id="formAccountSettings" action={{ route('brand.workingHours', $brand->slug) }}
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="sun_ot" class="form-label"
                                                    data-i18n="Sunday Opening">Sunday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="sun_ot"
                                                    step="60"  value="{{$brand->workinghours ? $brand->workinghours->sun_ot : ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="sun_ct" class="form-label"
                                                    data-i18n="Sunday Closing">Sunday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="sun_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->sun_ct : ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="mon_ot" class="form-label"
                                                    data-i18n="Monday Opening">Monday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="mon_ot"
                                                    step="60"  value="{{$brand->workinghours ? $brand->workinghours->mon_ot: ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="mon_ct" class="form-label"
                                                    data-i18n="Monday Closing">Monday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="mon_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->mon_ct: ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="tue_ot" class="form-label"
                                                    data-i18n="Tuesday Opening">Tuesday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="tue_ot"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->tue_ot: ''}}" />
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="tue_ct" class="form-label"
                                                    data-i18n="Tuesday Closing">Tuesday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="tue_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->tue_ct: ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="wed_ot" class="form-label"
                                                    data-i18n="Wednesday Opening">Wednesday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="wed_ot"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->wed_ot: ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="wed_ct" class="form-label"
                                                    data-i18n="Wednesday Closing">Wednesday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="wed_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->wed_ct: ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="thu_ot" class="form-label"
                                                    data-i18n="Thursday Opening">Thursday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="thu_ot"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->thu_ot: ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="thu_ct" class="form-label"
                                                    data-i18n="Thursday Closing">Thursday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="thu_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->thu_ct: ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="fri_ot" class="form-label"
                                                    data-i18n="Friday Opening">Friday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="fri_ot"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->fri_ot: ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="fri_ct" class="form-label"
                                                    data-i18n="Friday Closing">Friday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="fri_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->fri_ct: ''}}"/>
                                            </div>

                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="sat_ot" class="form-label"
                                                    data-i18n="Saturday Opening">Saturday
                                                    Opening Time</label>
                                                <input type="time" class="form-control" name="sat_ot"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->sat_ot: ''}}"/>
                                            </div>
                                            <div class="mb-3 col-md-6 cs-form">
                                                <label for="sat_ct" class="form-label"
                                                    data-i18n="Saturday Closing">Saturday
                                                    Closing Time</label>
                                                <input type="time" class="form-control" name="sat_ct"
                                                    step="60" value="{{$brand->workinghours ? $brand->workinghours->sat_ct: ''}}"/>
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
