@extends('backend.layout.layout')
@section('section')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{ $header['title'] }}</h3>
                    </div>
                    <!--begin::Form-->
                    <form id="add-brand-entry"  method="POST" action="{{ route('add-save-brand-entry') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Brand Name <span class="text-danger">*</span></label>
                                            <input class="form-control brand_name" type="text" name="brand_name[]" placeholder="Please enter brand name" autocomplete="off" />
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>URL</label>
                                            <input class="form-control urls" type="text" name="url[]" placeholder="Please enter URL" autocomplete="off" />
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Country Code</label>
                                            <input class="form-control country_code" type="text" name="country_code[]" placeholder="Please enter country code" autocomplete="off" />
                                            <span class="error text-danger"></span>
                                            <input class="form-control generateotp" type="hidden" name="generateotp[]" value="N" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="text-danger">*</span></label>
                                            <input class="form-control mobile_number onlyNumber" type="text" name="mobile_number[]" placeholder="Please enter mobile number" autocomplete="off" />
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Generate OTP <span class="text-danger">*</span></label>
                                        <div class="form-group">
                                            <span class="switch switch-lg  switch-outline switch-icon switch-success">
                                                <label>
                                                    <input type="checkbox"  class="generate_otp_switch" name="generate_otp_switch" value="yes" />
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label>&nbsp;</label>
                                        <div class="form-group">
                                            <a href="javascript:;" class="btn btn-success add-brand"><i class="fa fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div><hr>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Submit</button>
                            <a href="{{ route('brand-entry-list') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Card-->

            </div>

        </div>
    </div>
</div>

@endsection
