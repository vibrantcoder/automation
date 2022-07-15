var Brandentry = function(){
    var list = function(){
        $('.select2').select2();

        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#brand-entry-list',
            'ajaxURL': baseurl + "admin/brand-entry-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 6],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $("body").on("click", ".delete-brand-entry", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl +"admin/brand-entry-ajaxcall",
                data: { 'action': 'delete-brand-entry', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
       
        $('body').on('change', '.mobile-number', function() {

            var mobileId = $(this).val();

            var data = { mobileId: mobileId};
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/common-ajaxcall",

                data: { 'action': 'change-mobile-number', 'data': data },
                success: function(data) {
                    var output = JSON.parse(data);

                    for(var i = 0; i < output.length ; i++){
                        var temp = '';
                        var temp = '<option value="'+ output[i].id +'" selected="selected">'+ output[i].operator +'</option>';
                        var html = html + temp;
                    }
                    $("#operator").html(html);
                    $('.select2').select2();
                },
                complete: function(){
                    $("#loader").hide();
                  }
            });
        });

        var validateTrip = true;
        var customValid = true;

        $('#run-script').validate({
            debug: true,
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class

            rules: {                
                device: {required: true},
                mobile_number: {required: true},
                operator: {required: true},
            },

            messages: {             
                device:{    
                    required : "Please enter mobile number"
                },
                mobile_number:{    
                    required : "Please select otp option"
                },
                operator:{    
                    required : "Please select otp option"
                },
            },

            invalidHandler: function(event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();

            },

            submitHandler: function(form) {
                $(".submitbtn:visible").attr("disabled", "disabled");
                $("#loader").show();
                customValid = customerInfoValid();
                console.log(customValid);
                if (customValid) {
                    var options = {
                        resetForm: false, // reset the form after successful submit
                        success: function(output) {
                            handleAjaxResponse(output);
                        }
                    };
                    $(form).ajaxSubmit(options);
                } else {
                    $(".submitbtn:visible").prop("disabled", false);
                    $("#loader").hide();
                }
            },

            errorPlacement: function(error, element) {
                customValid = customerInfoValid();
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else {
                    if (elem.hasClass("radio-btn")) {
                        element = elem.parent().parent().parent().parent().parent().parent().parent();
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            },
        });


        function customerInfoValid() {
            var customValid = true;
            var brand_name =  $("#brnad_name").val();
            if(brand_name == '' || brand_name == null){
                customValid = false;
                $("#brand-name-error").text('Please select brand name');                
            }else{
                $("#brand-name-error").text('');
            }            
            return customValid;
        }

    }

    var add = function(){
        $('.select2').select2();
        $('body').on("click", ".add-brand", function() {

            var html = '';
            var html = '<div class="remove-div">'+
                        '<div class="row">'+
                        '<div class="col-md-6">'+
                        '<div class="form-group">'+
                        '<label>Brand Name <span class="text-danger">*</span></label>'+
                        '<input class="form-control brand_name" type="text" name="brand_name[]" placeholder="Please enter brand name" autocomplete="off" />'+
                        '<span class="error text-danger"></span>'+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-6">'+
                        '<div class="form-group">'+
                        '<label>URL</label>'+
                        '<input class="form-control urls" type="text" name="url[]" placeholder="Please enter URL" autocomplete="off" />'+
                        '<span class="error text-danger"></span>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '<div class="row">'+
                        '<div class="col-md-2">'+
                        '<div class="form-group">'+
                        '<label>Country Code'+
                        '<input class="form-control country_code" type="text" name="country_code[]" placeholder="Please enter country code" autocomplete="off" />'+
                        '<span class="error text-danger"></span>'+
                        '<input class="form-control generateotp" type="hidden" name="generateotp[]" value="N" autocomplete="off" />'+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                        '<div class="form-group">'+
                        '<label>Mobile Number <span class="text-danger">*</span></label>'+
                        '<input class="form-control mobile_number onlyNumber" type="text" name="mobile_number[]" placeholder="Please enter mobile number" autocomplete="off" />'+
                        '<span class="error text-danger"></span>'+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-4">'+
                        '<label>Generate OTP <span class="text-danger">*</span></label>'+
                        '<div class="form-group">'+
                        '<span class="switch switch-lg  switch-outline switch-icon switch-success">'+
                        '<label>'+
                        '<input type="checkbox"  class="generate_otp_switch" name="generate_otp_switch" value="yes" />'+
                        '<span></span>'+
                        '</label>'+
                        '</span>                              '+
                        '</div>'+
                        '</div>'+
                        '<div class="col-md-2">'+
                        '<label>&nbsp;</label>'+
                        '<div class="form-group">                                            '+
                        '<a href="javascript:;" class="btn btn-success add-brand"><i class="fa fa-plus"></i></a>'+
                        '<a href="javascript:;" class="ml-2 btn btn-danger remove-document"><i class="fa fa-minus"></i></a>'+
                        '</div>'+
                        '</div>'+
                        '</div><hr>'+
                        '</div>';

            $("#document-div").append(html);
        });

        $('body').on('change', '.generate_otp_switch', function(){
            if ($(this).is(':checked')) {
                var val = 'Y';
            }else{
                var val = 'N';
            }
            $(this).parent().parent().parent().parent().parent().find('.generateotp').val(val);
            // $().val(val);
        });
        $('body').on('click', '.remove-document', function(){
            $(this).closest('.remove-div').remove();
        });

        $('#add-brand-entry').validate({

            debug: true,
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class


            invalidHandler: function(event, validator) {
                validateTrip = false;
                customValid = customerInfoValid();

            },

            submitHandler: function(form) {
                $(".submitbtn:visible").attr("disabled", "disabled");
                $("#loader").show();
                customValid = customerInfoValid();
                if (customValid) {
                    var options = {
                        resetForm: false, // reset the form after successful submit
                        success: function(output) {
                            handleAjaxResponse(output);
                        }
                    };
                    $(form).ajaxSubmit(options);
                } else {
                    $(".submitbtn:visible").prop("disabled", false);
                    $("#loader").hide();
                }
            },

            errorPlacement: function(error, element) {
                customValid = customerInfoValid();
                var elem = $(element);
                if (elem.hasClass("select2-hidden-accessible")) {
                    element = $("#select2-" + elem.attr("id") + "-container").parent();
                    error.insertAfter(element);
                } else {
                    if (elem.hasClass("radio-btn")) {
                        element = elem.parent().parent().parent().parent().parent().parent().parent();
                        error.insertAfter(element);
                    } else {
                        error.insertAfter(element);
                    }
                }
            },
        });


        function customerInfoValid() {
            var customValid = true;

            $('.brand_name').each(function() {
                var elem = $(this);
                if ($(this).is(':visible')) {
                    if ($(this).val() == '' || $(this).val() == 0) {
                        $(this).parent().find('.error').text('Please enter brand name');
                        customValid = false;
                    } else {
                        $(this).parent().find('.error').text('');
                    }
                }
            });


            $('.mobile_number').each(function() {
                var elem = $(this);
                if ($(this).is(':visible')) {
                    if ($(this).val() == '' || $(this).val() == 0) {
                        $(this).parent().find('.error').text('Please enter mobile number');
                        customValid = false;
                    } else {
                        $(this).parent().find('.error').text('');
                    }
                }
            });

            $('.generate_otp').each(function() {
                var elem = $(this);
                if ($(this).is(':visible')) {
                    if ($(this).val() == '' || $(this).val() == 0) {
                        $(this).parent().find('.error').text('Please select otp option');
                        customValid = false;
                    } else {
                        $(this).parent().find('.error').text('');
                    }
                }
            });

            return customValid;
        }
    }

    var edit = function(){
        $('.select2').select2();

        $('body').on('change', '.generate_otp_switch', function(){
            if ($(this).is(':checked')) {
                var val = 'Y';
            }else{
                var val = 'N';
            }
            $(this).parent().parent().parent().parent().parent().find('.generateotp').val(val);
            // $().val(val);
        });

        var form = $('#edit-brand-entry');
        var rules = {
            brand_name: {required: true},
            // url: {required: true},
            // country_code: {required: true},
            mobile_number: {required: true},
            generate_otp: {required: true},
        };

        var message = {
            brand_name :{
                required : "Please enter brand name",

            },
           
            mobile_number : {
                required : "Please enter mobile number"
            },
            generate_otp : {
                required : "Please select otp option"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return{
        init: function(){
            list();
        },
        add: function(){
            add();
        },
        edit: function(){
            edit();
        }
    }
}();
