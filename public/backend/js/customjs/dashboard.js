var  Dashboard = function(){
    var dash= function(){
        $('.select2').select2();

        $("#datepicker_from").datepicker({
            format: 'd-M-yyyy',
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom auto"
        });

        $("#datepicker_to").datepicker({
            format: 'd-M-yyyy',
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom auto"
        });

        $('body').on('click', '#get_data', function(){
            var html = '';
            html = '<table class="table table-bordered table-checkable" id="reports-list">'+
                    '<thead>'+
                    '<tr>'+
                    '<th>Sr. No</th>'+
                    '<th>Event Time Stamp</th>'+
                    '<th>Result Value</th>'+
                    '<th>Sender From</th>'+
                    '<th>Sender SCCPAddress</th>'+
                    '<th>Recipient Code</th>'+
                    '<th>TextBody</th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                    '</tbody>'+
                    '</table>';
            $("#reports-list-div").html(html);

            var result_value = $("#result_value").val();
            var sender_from = $("#sender_from").val();
            var from = $("#datepicker_from").val();
            var to = $("#datepicker_to").val();

            var dataArr = {'result_value' : result_value, 'sender_from':sender_from, 'from':from, 'to':to};
            var columnWidth = { "width": "5%", "targets": 0 };
            var arrList = {
                'tableID': '#reports-list',
                'ajaxURL': baseurl + "admin/my-report-ajaxcall",
                'ajaxAction': 'getdatatable',
                'postData': dataArr,
                'hideColumnList': [],
                'noSortingApply': [0],
                'noSearchApply': [0],
                'defaultSortColumn': [0],
                'defaultSortOrder': 'DESC',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);            
        });

        $('body').on('click', '.clearSearch', function(){
            var html = '';
            html = '<table class="table table-bordered table-checkable" id="reports-list">'+
                    '<thead>'+
                    '<tr>'+
                    '<th>Sr. No</th>'+
                    '<th>Event Time Stamp</th>'+
                    '<th>Result Value</th>'+
                    '<th>Sender From</th>'+
                    '<th>Sender SCCPAddress</th>'+
                    '<th>Recipient Code</th>'+
                    '<th>TextBody</th>'+
                    '</tr>'+
                    '</thead>'+
                    '<tbody>'+
                    '</tbody>'+
                    '</table>';
            $("#reports-list-div").html(html);

            $('#result_value').val('all').trigger('change');
            $('#sender_from').val('all').trigger('change');
            $('#datepicker_from').val('');
            $('#datepicker_to').val('');

            var result_value = $("#result_value").val();
            var sender_from = $("#sender_from").val();
            var from = $("#datepicker_from").val();
            var to = $("#datepicker_to").val();

            var dataArr = {'result_value' : result_value, 'sender_from':sender_from, 'from':from, 'to':to};
            var columnWidth = { "width": "5%", "targets": 0 };
            var arrList = {
                'tableID': '#reports-list',
                'ajaxURL': baseurl + "admin/my-report-ajaxcall",
                'ajaxAction': 'getdatatable',
                'postData': dataArr,
                'hideColumnList': [],
                'noSortingApply': [0],
                'noSearchApply': [0],
                'defaultSortColumn': [0],
                'defaultSortOrder': 'DESC',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);

        });

        $('body').on('click', '#excel_download', function(){
            var result_value = $("#result_value").val();
            var sender_from = $("#sender_from").val();
            var from = $("#datepicker_from").val();
            var to = $("#datepicker_to").val();

            var dataArr = {'result_value' : result_value, 'sender_from':sender_from, 'from':from, 'to':to};
            var url =  baseurl + "admin/download-excel-download?result_value="+result_value+"&sender_from="+sender_from+"&from="+from+"&to="+to ;
            window.location = url;

        });

        const primary = '#6993FF';
        const success = '#1BC5BD';
        const info = '#8950FC';
        const warning = '#FFA800';
        const danger = '#F64E60';

        var result_value = $("#result_value").val();
        var sender_from = $("#sender_from").val();
        var from = $("#datepicker_from").val();
        var to = $("#datepicker_to").val();

        var dataArr = {'result_value' : result_value, 'sender_from':sender_from, 'from':from, 'to':to};

        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#reports-list',
            'ajaxURL': baseurl + "admin/my-report-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
            },
            url: baseurl + "admin/my-report-ajaxcall",
            data: { 'action': 'sender-chat'},
            success: function(data) {
                $("#loader").show();
                var output = JSON.parse(data);
                const apexChart = "#sender_chat";
                var options = {
                    series: output.count,
                    labels: output.sender,
                    chart: {
                        width: 550,
                        type: 'donut',
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 350
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    legend: {
                        position: 'top'
                    },
                    colors: [primary, success, warning, danger, info]
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();               
            },
            // complete: function(){
            //     $("#loader").hide();
            // }
        });
    }

    var update = function(){
        var form = $('#update-profile');
        var rules = {
            first_name : {required: true},
            last_name : {required: true},
            email: {required: true,email:true},
        };

        var message = {
            first_name : {required: "Please enter your first name"},
            last_name : {required: "Please enter your last name"},
            email :{
                required : "Please enter your register email address",
                email: "Please enter valid email address"
            },

        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    var password = function(){
        var form = $('#change-password');
        var rules = {
            old_password: {required: true},
            new_password: {required: true},
            new_confirm_password: {required: true,equalTo: "#password"},

        };

        var message = {
            old_password: {required: "Please enter your password"},
            new_password: {required: "Please enter your new password"},
            new_confirm_password: {
                required: "Please enter confirm password",
                equalTo: "New Password and confirmn password not match"
            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }

    return {
        init:function(){
            dash();
        },
        edit_profile:function(){
            update();
        },
        change_password:function(){
            password();
        }
    }
}();
