var Mobile_number = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#mobile-number-list',
            'ajaxURL': baseurl + "admin/mobile-number-ajaxcall",
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


        $("body").on("click", ".delete-mobile-number", function() {
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
                url: baseurl +"admin/mobile-number-ajaxcall",
                data: { 'action': 'delete-mobile-number', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".deactive-mobile-number", function() {
            var id = $(this).data('id');
            setTimeout(function() {
                $('.yes-sure-deactive:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-deactive', function() {
            var id = $(this).attr('data-id');
            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/mobile-number-ajaxcall",
                data: { 'action': 'deactive-mobile-number', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });

        $("body").on("click", ".active-mobile-number", function() {
            var id = $(this).data('id');

            setTimeout(function() {
                $('.yes-sure-active:visible').attr('data-id', id);
            }, 500);
        })

        $('body').on('click', '.yes-sure-active', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/mobile-number-ajaxcall",
                data: { 'action': 'active-mobile-number', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_mobile_number = function(){
        $('.select2').select2();

        var form = $('#add-mobile-number');
        var rules = {
            country_code: {required: true},
            mobile_number: {required: true},
            operator: {required: true},

        };

        var message = {
            country_code :{
                required : "Please select country code",
            },
            mobile_number :{
                required : "Please enter mobile number",
            },
            operator :{
                required : "Please enter operator",
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    var edit_mobile_number = function(){
        $('.select2').select2();

        var form = $('#edit-mobile-number');
        var rules = {
            country_code: {required: true},
            mobile_number: {required: true},
            operator: {required: true},

        };

        var message = {
            country_code :{
                required : "Please select country code",
            },
            mobile_number :{
                required : "Please enter mobile number",
            },
            operator :{
                required : "Please enter operator",
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
            add_mobile_number();
        },
        edit: function(){
            edit_mobile_number();
        }
    }
}();
