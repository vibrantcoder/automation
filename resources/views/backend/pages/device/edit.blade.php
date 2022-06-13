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
                    <form id="edit-device"  method="POST" action="{{ route('edit-save-device') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Device Name <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="device_name" placeholder="Please enter device name" autocomplete="off"  value="{{ $device_detail[0]['device_name'] }}"/>
                                            <input type="hidden" name="editId" value="{{ $device_detail[0]['id'] }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="radio-inline" style="margin-top:10px">
                                                <label class="radio radio-lg radio-success" >
                                                <input type="radio" name="status" class="radio-btn" checked="checked"  value="A" {{ $device_detail[0]['status'] == 'A' ? 'checked="checked"' : '' }}/>
                                                <span></span>Active</label>
                                                <label class="radio radio-lg radio-danger" >
                                                <input type="radio" name="status" class="radio-btn" value="I" {{ $device_detail[0]['status'] == 'I' ? 'checked="checked"' : '' }}/>
                                                <span></span>Inactive</label>
                                            </div>
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
