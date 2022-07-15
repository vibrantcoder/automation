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
                    <form id="add-user-management"  method="POST" action="{{ route('add-save-user-management') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="first_name" placeholder="Please enter first name" autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="last_name" placeholder="Please enter last name" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="email" placeholder="Please enter email" autocomplete="off" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number</label>
                                            <input class="form-control mobile_number onlyNumber" type="text" name="mobile_no" placeholder="Please enter mobile number" autocomplete="off" />
                                        </div>
                                    </div>



                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <input class="form-control" type="text" name="designation" placeholder="Please enter your designation" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Submit</button>
                            <a href="{{ route('user-management-list') }}" class="btn btn-secondary">Cancel</a>
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
