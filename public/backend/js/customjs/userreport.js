var Userreport = function(){

    var list = function(){
        var dataArr = {};
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