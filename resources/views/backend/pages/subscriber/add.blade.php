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
                    <form id="add-import-subscriber" enctype="multipart/form-data" method="POST" action="{{ route('save-subscriber-add') }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Sr.No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="sr_no" placeholder="Please enter subscriber sr.no" autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscriber Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" placeholder="Please enter subscriber name" autocomplete="off" />

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 1<span class="text-danger">*</span></label>
                                            <textarea class="form-control" type="text" name="address_1" placeholder="Please enter subscriber address 1" autocomplete="off" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <textarea class="form-control" type="text" name="address_2" placeholder="Please enter subscriber address 2" autocomplete="off" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 3</label>
                                            <textarea class="form-control" type="text" name="address_3" placeholder="Please enter subscriber address 3" autocomplete="off" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <input type="text" class="form-control" type="text" name="area" placeholder="Please enter subscriber address area" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" type="text" name="city" placeholder="Please enter subscriber address city" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" type="text" name="state" placeholder="Please enter subscriber address state" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" type="text" name="pincode" placeholder="Please enter subscriber address pincode" autocomplete="off">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" type="text" name="contactno" placeholder="Please enter subscriber contact number" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Landline Number</label>
                                            <input type="text" class="form-control" type="text" name="landline" placeholder="Please enter subscriber landline number" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" type="text" name="email" placeholder="Please enter subscriber email" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Start Date</label>
                                            <input type="text" class="form-control" type="text" id="start_date" name="start_date" placeholder="Please enter subscription start date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group" id="end-date-div">
                                            <label>Subscription End Date</label>
                                            <input type="text" class="form-control" type="text" name="end_date" id="end_date" placeholder="Please enter subscription end date" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Type</label>
                                            <input type="text" class="form-control" type="text" name="type" placeholder="Please enter subscription type" autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control onlyNumber" type="text" name="price" placeholder="Please enter subscription price"  autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary mr-2 submitbtn">Add Subscriber</button>
                            <a href="{{ route('subscriber-list') }}" class="btn btn-secondary">Cancel</a>
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
