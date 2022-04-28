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
                    <a href="javascript:;" class="btn btn-icon  mr-4" style="background: #356fa0 !important" download title="Run Python Scripts">
                        <i class="far fa-file-code text-white"></i>
                    </a>
                   
                    <a href="{{ asset('public/excel/BrandDetails.xlsx') }}" class="btn btn-icon btn-danger mr-4" download title="Download excel file">
                        <i class="far fa-file-excel"></i>
                    </a>

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


@endsection
