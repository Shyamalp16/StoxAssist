$('#barDisp').change(function(){
    $('.chart').hide();
    $('#'+$(this).val()).show();
});