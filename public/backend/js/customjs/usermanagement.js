var Usermanagement = function(){
    var list = function(){
        var dataArr = {};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#user-list',
            'ajaxURL': baseurl + "admin/user-management-ajaxcall",
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

        $("body").on("click", ".delete-user-management", function() {
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
                url: baseurl +"admin/user-management-ajaxcall",
                data: { 'action': 'delete-user-management', 'data': data },
                success: function(data) {
                    $("#loader").show();
                    handleAjaxResponse(data);
                }
            });
        });
    }

    var add_user = function(){
        var form = $('#add-user-management');
        var rules = {
            first_name: {required: true},
            // url: {required: true},
            // country_code: {required: true},
            last_name: {required: true},
            email: {required: true , email: true},


        };

        var message = {
            first_name :{
                required : "Please enter first name",

            },
            last_name : {
                required : "Please enter last name",
            },
            email : {
                required : "Please enter email",
                email : 'Please enter valid email address',
            },

        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var edit_user = function(){
        var form = $('#edit-user-management');
        var rules = {
            first_name: {required: true},
            // url: {required: true},
            // country_code: {required: true},
            last_name: {required: true},
            email: {required: true , email: true},


        };

        var message = {
            first_name :{
                required : "Please enter first name",

            },
            last_name : {
                required : "Please enter last name",
            },
            email : {
                required : "Please enter email",
                email : 'Please enter valid email address',
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
            add_user();
        },
        edit: function(){
            edit_user();
        }
    }

}();
