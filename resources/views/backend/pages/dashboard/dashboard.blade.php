@extends('backend.layout.layout')
@section('section')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid">
    <!--begin::Container-->
    <div class="container-fluid">
        @csrf
           
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">List Of Sender</h3>
                        </div>
                    </div>
                    <div class="card-body" style="height: 500px !important;">
                        <!--begin::Chart-->
                        <div id="sender_chat" class="d-flex justify-content-center"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
           
        </div>

        <!--begin::Card-->
        <div class="card card-custom gutter-b">
            <div class="card-header flex-wrap py-3">

                <div class="card-title">
                    <h3 class="card-label">{{ $header['title'] }}</h3>
                </div>

                <div class="card-toolbar">
                    <a href="{{ route('update-report') }}" class="btn btn-primary font-weight-bolder mr-5 update-records">
                        Update Report
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Result Value</label>
                            <select class="form-control select2 result_value" id="result_value"  name="result_value">
                                <option value="all">All</option>
                                @foreach ($result_value as $key => $value )
                                    <option value="{{ $value['result_value'] }}" >{{ $value['result_value'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sender From</label>
                            <select class="form-control select2 sender_from" id="sender_from"  name="sender_from">
                                <option value="all">All</option>
                                @foreach ($sender_from as $key => $value )
                                    <option value="{{ $value['sender_from'] }}" >{{ $value['sender_from'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Event From</label>
                            <input class="form-control from_date filter-field" name="date" value="" type="text" placeholder="From date" id="datepicker_from" autocomplete="off">
                            <span class="help-block" id="fillter_from_date"></span>
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            <label>Event To</label>
                            <input class="form-control to_date filter-field" name="date" value="" type="text" placeholder="To date" id="datepicker_to" autocomplete="off">
                            <span class="help-block" id="fillter_to_date"></span>
                        </div>
                    </div>
                    
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <div class="form-group">
                            <a href="javascript:;" class="btn btn-icon btn-primary search-btn Search" id="get_data">
                                <i class="flaticon-search"></i>
                            </a>

                            <a href="javascript:;"  class="btn btn-icon btn-danger clearSearch" id="clearSearch">
                                <i class="flaticon-cancel"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon excel-download" style="background: #1D6F42;" id="excel_download" target="_blank">
                                <i class="far fa-file-excel text-white"></i>
                            </a>

                        </div>
                    </div>

                </div>
                <!--begin: Datatable-->
                <div id="reports-list-div">
                    <table class="table table-bordered table-checkable" id="reports-list">
                        <thead>
                            <tr>
                                <th>Sr. No</th>
                                <th>Event Time Stamp</th>
                                <th>Result Value</th>
                                <th>Sender From</th>
                                <th>Sender SCCPAddress</th>
                                <th>Recipient Code</th>
                                <th>TextBody</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
     

    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
