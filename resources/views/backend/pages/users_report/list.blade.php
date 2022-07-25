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


            </div>
            <div class="card-body">
                <div class="row">



                    <div class="col-md-3">
                        <div class="form-group">
                            <label>User Name<span class="text-danger">*</span></label>
                            <select class="form-control select2" id="user_name"  name="user_name">
                                <option value="all">All</option>
                                @foreach ($user_details as $key => $value )
                                    <option value="{{ $value['id'] }}">{{ $value['full_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Date<span class="text-danger">*</span></label>
                            <input type="text" name="date" id="date" class="form-control" value="All" readonly="readonly">
                        </div>
                    </div>


                    <div class="col-md-3">
                        <label>&nbsp;</label>
                        <div class="form-group">
                            <a class="btn btn-icon btn-primary Search" id="get_data">
                                <i class="flaticon-search"></i>
                            </a>
                            <a class="btn btn-icon btn-danger clearSearch" id="clearSearch">
                                <i class="flaticon-cancel"></i>
                            </a>

                        </div>
                    </div>
                </div>
                <!--begin: Datatable-->
                <div id="user_report">
                    <table class="table table-bordered table-checkable" id="user-report-histroy-list">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Date</th>
                                <th>Action</th>
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
