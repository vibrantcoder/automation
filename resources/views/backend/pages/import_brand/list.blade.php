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
                    <form id="add-import-brands"  method="POST" action="{{ route('import-brands-save') }}">
                        @csrf
                        <div class="card-body">
                            <div id="document-div">
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Upload Excel File<span class="text-danger">*</span></label>
                                                <div></div>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="file" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>
                                                
                                            </div>
                                           <h5 class="text-danger">Note: Please remove the header from the excel sheet before importing the data. <a href="{{ url('public/upload/excel/demo.xlsx') }}" download><u>Download File <i class="fa fa-download" style="color: #3699FF !important" ></i></u></a></h5>
                                           
                                        </div>

                                        {{-- <div class="form-group">
                                            <label>Import Files<span class="text-danger">*</span></label>
                                            <input class="form-control" type="file" name="import_files" placeholder="Please enter device name" autocomplete="off"  accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"/>
                                        </div> --}}
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
