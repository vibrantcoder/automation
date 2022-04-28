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
                <!--begin: Datatable-->
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
                <!--end: Datatable-->
            </div>
        </div>
        <!--end::Card-->
     

    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection
