var Brandentry = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#brand-entry-list',
            'ajaxURL': baseurl + "admin/brand-entry-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 5],
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
    }

    var add = function(){
        $('.select2').select2();
        $('body').on("click", ".add-document", function() {
            $("#loader").show();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/brand-entry-ajaxcall",
                data: { 'action': 'addMember' },
                success: function(data) {
                    $('#loader').hide();
                    $("#document-div").append(data);
                    $('.select2').select2();
                },
                complete: function() {
                    $('#loader').hide();
                }
            });
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

            $('.urls').each(function() {
                var elem = $(this);
                if ($(this).is(':visible')) {
                    if ($(this).val() == '' || $(this).val() == 0) {
                        $(this).parent().find('.error').text('Please enter URL');
                        customValid = false;
                    } else {
                        $(this).parent().find('.error').text('');
                    }
                }
            });

            $('.country_code').each(function() {
                var elem = $(this);
                if ($(this).is(':visible')) {
                    if ($(this).val() == '' || $(this).val() == 0) {
                        $(this).parent().find('.error').text('Please enter country code');
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

        var form = $('#edit-brand-entry');
        var rules = {
            brand_name: {required: true},
            url: {required: true},
            country_code: {required: true},
            mobile_number: {required: true},
            generate_otp: {required: true},
        };

        var message = {
            brand_name :{
                required : "Please enter brand name",

            },
            url :{
                required : "Please enter url",

            },
            country_code : {
                required : "Please enter country code"
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
