<div class="remove-div">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Brand Name <span class="text-danger">*</span></label>
                <input class="form-control brand_name" type="text" name="brand_name[]" placeholder="Please enter brand name" autocomplete="off" />
                <span class="error text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>URL <span class="text-danger">*</span></label>
                <input class="form-control urls" type="text" name="url[]" placeholder="Please enter URL" autocomplete="off" />
                <span class="error text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Country Code <span class="text-danger">*</span></label>
                <input class="form-control country_code" type="text" name="country_code[]" placeholder="Please enter country code" autocomplete="off" />
                <span class="error text-danger"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Mobile Number <span class="text-danger">*</span></label>
                <input class="form-control mobile_number" type="text" name="mobile_number[]" placeholder="Please enter mobile number" autocomplete="off" />
                <span class="error text-danger"></span>
            </div>
        </div>
        <div class="col-md-4">
            <label>Generate OTP
                <span class="text-danger">*</span></label>
            <div class="form-group row">

                <div class="col-2">
                    <label>Yes</label>
                    <span class="switch switch-success">
                        <label>
                            <input class="form-control" type="checkbox" checked="checked" name="select[]" value="Y"/>
                            <span></span>
                        </label>
                    </span>
                </div>

                <div class="col-2">
                    <label>No</label>
                    <span class="switch switch-danger">
                        <label>
                            <input class="form-control" type="checkbox"  name="select[]" value="N"/>
                            <span></span>
                        </label>
                    </span>
                </div>
                {{-- <select class="form-control select2 generate_otp" id="generate_otp"  name="generate_otp[]" >
                    <option value="">Please select generate otp</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select> --}}
                <span class="error text-danger"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>&nbsp;</label><br>
                <a href="javascript:;" class="btn btn-success add-document"><i class="fa fa-plus"></i></a>
                <a href="javascript:;" class="ml-2 btn btn-danger remove-document"><i class="fa fa-minus"></i></a>
            </div>
        </div>
    </div>
</div>
