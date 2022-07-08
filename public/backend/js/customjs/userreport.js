var Userreport = function(){

    var list = function(){
        $('.select2').select2();

        $('#date').datepicker({
            format: 'd-M-yyyy',
            todayHighlight: true,
            autoclose: true,
            orientation: "bottom auto",
            autoclose: true,
            format: date_formate,
        });

        var user_name = $('#user_name').val();

        var date = $('#date').val();

        if (user_name == '' || user_name == null) {
            user_name = '';
        }

        var dataArr = {'user_name': user_name, 'date': date};
        var columnWidth = { "width": "5%", "targets": 0 };
        var arrList = {
            'tableID': '#user-report-histroy-list',
            'ajaxURL': baseurl + "admin/user-report-histroy-ajaxcall",
            'ajaxAction': 'getdatatable',
            'postData': dataArr,
            'hideColumnList': [],
            'noSortingApply': [0, 3],
            'noSearchApply': [0],
            'defaultSortColumn': [0],
            'defaultSortOrder': 'DESC',
            'setColumnWidth': columnWidth
        };
        getDataTable(arrList);

        $('body').on("click", "#get_data", function() {
            var html = '';
            html = '<table class="table table-bordered table-checkable" id="user-report-histroy-list">' +
                '<thead>' +
                '<tr>' +
                '<th>#</th>' +
                '<th>User</th>' +
                '<th>Date</th>' +
                '<th>Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '</tbody>' +
                '</table>';

            $("#user_report").html(html);


            var user_name = $('#user_name').val();

            var date = $('#date').val();

            if (user_name == '' || user_name == null) {
                user_name = '';
            }
            $("#loader").show();

            var dataArr = {'user_name': user_name, 'date': date};
            var columnWidth = { "width": "5%", "targets": 0 };
            var arrList = {
                'tableID': '#user-report-histroy-list',
                'ajaxURL': baseurl + "admin/user-report-histroy-ajaxcall",
                'ajaxAction': 'getdatatable',
                'postData': dataArr,
                'hideColumnList': [],
                'noSortingApply': [0, 3],
                'noSearchApply': [0],
                'defaultSortColumn': [0],
                'defaultSortOrder': 'DESC',
                'setColumnWidth': columnWidth
            };
            getDataTable(arrList);
            $('#loader').hide();
        });


        $('body').on("click", "#clearSearch", function() {
            var url = baseurl + "admin/user-report-histroy-list";
            location.replace(url);
        });




        $('body').on('click', '.view-report-details', function(){
            var data_id = $(this).attr('data-id');
            var data = { 'data_id': data_id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "admin/user-report-histroy-ajaxcall",
                data: { 'action': 'view-user-report-histroy', 'data': data },
                success: function(data) {
                    $("#view-user-report-details").html(data);
                }
            });
        });
    }

    return {
        init:function(){
            list();
        }
    }
}();
