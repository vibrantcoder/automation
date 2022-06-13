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
    }

    var add_mobile = function(){
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
    return{
        init: function(){
            list();
        },
        add: function(){
            add_mobile();
        }
    }
}();
