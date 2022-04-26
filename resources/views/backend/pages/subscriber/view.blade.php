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

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Sr.No</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['sr_no'] != '' && $subscriber_details[0]['sr_no'] != null ? $subscriber_details[0]['sr_no'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Subscriber Name</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['name'] != '' && $subscriber_details[0]['name'] != null ? $subscriber_details[0]['name'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>

                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark-75  mb-1 font-size-lg">Address 1</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['address_1'] != '' && $subscriber_details[0]['address_1'] != null ? $subscriber_details[0]['address_1'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Address 2</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['address_2'] != '' && $subscriber_details[0]['address_2'] != null ? $subscriber_details[0]['address_2'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Address 3</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['address_3'] != '' && $subscriber_details[0]['address_3'] != null ? $subscriber_details[0]['address_3'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>

                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark-75  mb-1 font-size-lg">Area</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['area'] != '' && $subscriber_details[0]['area'] != null ? $subscriber_details[0]['area'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">City</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['city'] != '' && $subscriber_details[0]['city'] != null ? $subscriber_details[0]['city'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">State</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['state'] != '' && $subscriber_details[0]['state'] != null ? $subscriber_details[0]['state'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>

                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark-75  mb-1 font-size-lg">Pincode</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['pincode'] != '' && $subscriber_details[0]['pincode'] != null ? $subscriber_details[0]['pincode'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Contact Number</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['contactno'] != '' && $subscriber_details[0]['contactno'] != null ? $subscriber_details[0]['contactno'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Landline Number</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['landline'] != '' && $subscriber_details[0]['landline'] != null ? $subscriber_details[0]['landline'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>

                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark-75  mb-1 font-size-lg">Email</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['email'] != '' && $subscriber_details[0]['email'] != null ? $subscriber_details[0]['email'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>
                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Subscription Start Date</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['start_date'] != '' && $subscriber_details[0]['start_date'] != null ? date_formate($subscriber_details[0]['start_date']) : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Subscription End Date</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['end_date'] != '' && $subscriber_details[0]['end_date'] != null ? date_formate($subscriber_details[0]['end_date']) : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>

                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">

                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark-75  mb-1 font-size-lg">Subscription Type</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['type'] != '' && $subscriber_details[0]['type'] != null ? $subscriber_details[0]['type'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>

                        <br><br>
                        <div class="row">
                            <div class="col-md-4">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Text-->
                                    <div class="d-flex flex-column font-weight-bold">
                                        <span class="text-dark tex mb-1 font-size-lg">Subscription Price</span>
                                        <span class="text-muted">{{ $subscriber_details[0]['price'] != '' && $subscriber_details[0]['price'] != null ? $subscriber_details[0]['price'] : '-'}}</span>
                                    </div>
                                    <!--end::Text-->
                                </div>
                                <!--end::Item-->
                            </div>




                        </div>
                    </div>
                        {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Sr.No<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="sr_no" placeholder="Please enter subscriber sr.no" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['sr_no'] : ''}}" />
                                            <input class="form-control" type="hidden" name="editid"  value="{{ $subscriber_details[0]['id'] }}" />

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscriber Name<span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="name" placeholder="Please enter subscriber name" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['name'] : ''}}" />

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 1<span class="text-danger">*</span></label>
                                            <textarea class="form-control" type="text" name="address_1" placeholder="Please enter subscriber address 1" autocomplete="off" rows="2">{{(!empty($subscriber_details)) ? $subscriber_details[0]['address_1'] : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 2</label>
                                            <textarea class="form-control" type="text" name="address_2" placeholder="Please enter subscriber address 2" autocomplete="off" rows="2">{{(!empty($subscriber_details)) ? $subscriber_details[0]['address_2'] : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Address 3</label>
                                            <textarea class="form-control" type="text" name="address_3" placeholder="Please enter subscriber address 3" autocomplete="off" rows="2">{{(!empty($subscriber_details)) ? $subscriber_details[0]['address_3'] : ''}}</textarea>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Area</label>
                                            <input type="text" class="form-control" type="text" name="area" placeholder="Please enter subscriber address area" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['area'] : ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" type="text" name="city" placeholder="Please enter subscriber address city" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['city'] : ''}}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" class="form-control" type="text" name="state" placeholder="Please enter subscriber address state" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['state'] : ''}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Pincode</label>
                                            <input type="text" class="form-control" type="text" name="pincode" placeholder="Please enter subscriber address pincode" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['pincode'] : ''}}">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text" class="form-control" type="text" name="contactno" placeholder="Please enter subscriber contact number" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['contactno'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Landline Number</label>
                                            <input type="text" class="form-control" type="text" name="landline" placeholder="Please enter subscriber landline number" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['landline'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" type="text" name="email" placeholder="Please enter subscriber email" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['email'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Start Date</label>
                                            <input type="text" class="form-control" type="text" id="start_date" name="start_date" placeholder="Please enter subscription start date" autocomplete="off" value="{{(!empty($subscriber_details)) ? date_formate($subscriber_details[0]['start_date']) : ''}}" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group" id="end-date-div">
                                            <label>Subscription End Date</label>
                                            <input type="text" class="form-control" type="text" id="end_date" name="end_date" placeholder="Please enter subscription end date" autocomplete="off" value="{{(!empty($subscriber_details)) ? date_formate($subscriber_details[0]['end_date']) : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Type</label>
                                            <input type="text" class="form-control" type="text" name="type" placeholder="Please enter subscription type" autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['type'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label>Subscription Price<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control onlyNumber" type="text" name="price" placeholder="Please enter subscription price"  autocomplete="off" value="{{(!empty($subscriber_details)) ? $subscriber_details[0]['price'] : ''}}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}



                    <!--end::Form-->
                </div>
                <!--end::Card-->

            </div>

        </div>
    </div>
</div>



@endsection
