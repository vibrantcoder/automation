@extends('backend.layout.layout')
@section('section')
<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        @csrf
        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">
                <div class="card-title">
                    <h3 class="card-label">{{ $header['title'] }}</h3>
                </div>

                <div class="card-toolbar">
                    <a href="javascript:;" data-toggle="modal" data-target="#runScript"   class="btn btn-icon btn-danger mr-4 run-script"  title="Run Python Scripts">
                        <span class="svg-icon svg-icon-light svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Media\Play.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M9.82866499,18.2771971 L16.5693679,12.3976203 C16.7774696,12.2161036 16.7990211,11.9002555 16.6175044,11.6921539 C16.6029128,11.6754252 16.5872233,11.6596867 16.5705402,11.6450431 L9.82983723,5.72838979 C9.62230202,5.54622572 9.30638833,5.56679309 9.12422426,5.7743283 C9.04415337,5.86555116 9,5.98278612 9,6.10416552 L9,17.9003957 C9,18.1765381 9.22385763,18.4003957 9.5,18.4003957 C9.62084305,18.4003957 9.73759731,18.3566309 9.82866499,18.2771971 Z" fill="#000000"/>
                            </g>
                        </svg>
                    </a>

                    <a href="{{ asset('public/excel/BrandDetails.xlsx') }}" class="btn btn-icon  mr-4" style="background: #1D6F42 !important;" download title="Download excel file">
                        <i class="far fa-file-excel text-white"></i>
                    </a>

                    <!--begin::Button-->
                    <a href="{{ route('import-brands') }}" class="btn btn-success font-weight-bolder mr-5">
                       Import Brand Entry
                    </a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <a href="{{ route('add-brand-entry') }}" class="btn btn-primary font-weight-bolder mr-5">
                       Add Brand Entry
                    </a>
                    <!--end::Button-->
                </div>

            </div>
            <div class="card-body">
                <!--begin: Datatable-->
                <table class="table table-bordered table-checkable" id="brand-entry-list">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Brand Name</th>
                            <th>URL</th>
                            <th>Country Code - Mobile</th>
                            <th>Generate OTP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->


{{-- modal --}}
<div class="modal fade" id="runScript" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Run Script</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <form id="run-script"  method="POST" action="{{ route('run-script') }}">@csrf
                <div class="modal-body" style="padding: 0% !important">
                    
                        @csrf
                        <div class="card-body">
                            <div id="document-div">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Brand List<span class="text-danger">*</span></label><br>
                                            <select class="form-control selectpicker select brnad_name" multiple aria-label="Default select example" id="brnad_name" name="brnad_name[]" data-placeholder="Please select device" data-live-search="true">                                                
                                                @foreach ($brand_entry_list as $bl_key => $bl_value)
                                                    <option value="{{ $bl_value['id'] }}">{{ $bl_value['brand_name'] }}</option>      
                                                @endforeach
                                            </select>
                                            <span id="brand-name-error" class="error text-danger"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Device <span class="text-danger">*</span></label><br>
                                            <select class="form-control select2 device" id="device"  name="device">
                                                <option value="">Please select device</option>
                                                    @foreach ($device_list as $dl_key => $dl_value)
                                                        <option value="{{ $dl_value['id'] }}">{{ $dl_value['device_name'] }}</option>      
                                                    @endforeach
                                            </select>                                            
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile Number <span class="text-danger">*</span></label><br>
                                            <select class="form-control select2 mobile-number" id="mobile_number"  name="mobile_number">
                                                <option value="">Please select mobile number</option>
                                                @foreach ($mobile_number_list as $ml_key => $ml_value)
                                                    <option value="{{ $ml_value['id'] }}">{{ $ml_value['mobile_number'] }}</option>      
                                                @endforeach
                                            </select>                                            
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Operator <span class="text-danger">*</span></label><br>
                                            <select class="form-control select2" id="operator"  name="operator">
                                                <option value="">Please select operator</option>
                                            </select>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Run Script</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
