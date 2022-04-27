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
                    <form id="edit-brand-entry"  method="POST" action="{{ route('edit-save-brand-entry') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Brand Name <span class="text-danger">*</span></label>
                                            <input class="form-control brand_name" type="text" name="brand_name" placeholder="Please enter brand name" autocomplete="off" value="{{ $brand_entry_details[0]['brand_name'] }}" />
                                            <input type="hidden" class="form-control" name="editId" value="{{ $brand_entry_details[0]['id'] }}">
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>URL <span class="text-danger">*</span></label>
                                            <input class="form-control urls" type="text" name="url" placeholder="Please enter URL" autocomplete="off" value="{{ $brand_entry_details[0]['url'] }}" />
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Country Code <span class="text-danger">*</span></label>
                                            <input class="form-control country_code" type="text" name="country_code" placeholder="Please enter country code" autocomplete="off" value="{{ $brand_entry_details[0]['country_code'] }}"/>
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="text-danger">*</span></label>
                                            <input class="form-control mobile_number" type="text" name="mobile_number" placeholder="Please enter mobile number" autocomplete="off" value="{{ $brand_entry_details[0]['mobile_number'] }}" />
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Generate OTP
                                            <span class="text-danger">*</span></label>
                                            <select class="form-control select2 generate_otp" id="generate_otp"  name="generate_otp" >
                                                <option value="">Please select generate otp</option>
                                                <option value="Y" {{ $brand_entry_details[0]['generate_otp'] == 'Y' ? 'selected="selected"' : '' }}>Yes</option>
                                                <option value="N" {{ $brand_entry_details[0]['generate_otp'] == 'N' ? 'selected="selected"' : '' }}>No</option>
                                            </select>
                                            <span class="error text-danger"></span>
                                        </div>
                                    </div>


                                </div>
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
