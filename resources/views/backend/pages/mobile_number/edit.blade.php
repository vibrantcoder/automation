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
                    <form id="edit-mobile-number"  method="POST" action="{{ route('edit-save-mobile-number') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country Code<span class="text-danger">*</span></label>
                                            <select class="form-control select2" id="country_code"  name="country_code">
                                                <option value="">Select Country Code</option>
                                                @foreach ($countries_details as $key => $value)
                                                    <option value="{{ $value['id'] }}" {{ $value['id'] == $mobile_number_details[0]['country_id'] ? 'selected="selected"' : '' }}>{{ $value['phonecode'] }} - {{ $value['shortname'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="mobile_number" placeholder="Please enter mobile number" autocomplete="off" value="{{ $mobile_number_details[0]['mobile_number'] }}" />
                                            <input type="hidden" name="editId" value="{{ $mobile_number_details[0]['id'] }}">
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Operator <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="operator" placeholder="Please enter operator" autocomplete="off" value="{{ $mobile_number_details[0]['operator'] }}"/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio-inline" style="margin-top:10px">
                                                <label class="radio radio-lg radio-success" >
                                                <input type="radio" name="status" class="radio-btn" checked="checked"  value="A" {{ $mobile_number_details[0]['status'] == 'A' ? 'checked="checked"' : '' }}/>
                                                <span></span>Active</label>
                                                <label class="radio radio-lg radio-danger" >
                                                <input type="radio" name="status" class="radio-btn" value="I" {{ $mobile_number_details[0]['status'] == 'I' ? 'checked="checked"' : '' }}/>
                                                <span></span>Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Submit</button>
                            <a href="{{ route('mobile-number-list') }}" class="btn btn-secondary">Cancel</a>
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
