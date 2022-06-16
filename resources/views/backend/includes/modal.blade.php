<style>
    .text-danger {
    color: red !important;
}
.has-error {
    border: 1px solid red !important;
}
</style>
<div class="modal fade " id="viewAuditTrails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Audit Trails Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" id="view-audit-trails" style="word-break: break-all !important; ">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete record ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light yes-sure">Yes , I am sure</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="activeModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Active record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to active record ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light yes-sure-active">Yes , I am sure</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal-->
<div class="modal fade" id="deactiveModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Deactive record</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to deactive record ? </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light yes-sure-deactive">Yes , I am sure</button>
            </div>
        </div>
    </div>
</div>

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
            <div class="modal-body" style="padding: 0% !important">
                <form id="add-run-script"  method="POST" action="{{ route('add-save-mobile-number') }}">
                    @csrf
                    <div class="card-body">
                        <div id="document-div">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Brand Name <span class="text-danger">*</span></label><br>
                                        <select class="form-control select2 brnad_name" id="brnad_name"  name="brnad_name[]" multiple="multiple" data-placeholder="Please select device">                                            
                                        </select>
                                        <span id="device-error" class="error text-danger"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Device <span class="text-danger">*</span></label><br>
                                        <select class="form-control select2 device" id="device"  name="device">
                                            <option value="">Please select device</option>
                                        </select>
                                        <span id="device-error" class="error text-danger"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Mobile Number <span class="text-danger">*</span></label><br>
                                        <select class="form-control select2 mobile-number" id="mobile_number"  name="mobile_number">
                                            <option value="">Please select mobile number</option>
                                        </select>
                                        <span id="mobile-number-error" class="error text-danger"></span>
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
                                        <span id="operator-error" class="error text-danger"></span>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary waves-effect waves-light run-modal-script-btn">Run Script</button>
            </div>
        </div>
    </div>
</div>
