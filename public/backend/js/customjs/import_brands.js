var Import_brands = function(){
    var import_br = function(){
        var form = $('#add-import-brands');
        var rules = {
            file: {required: true},
        };

        var message = {
            file :{
                required : "Please select import excel file",

            },
        }
        handleFormValidateWithMsg(form, rules,message, function(form) {
            handleAjaxFormSubmit(form,true);
        });
    }
    return{
        init: function(){
            import_br();
        },
    }
}();