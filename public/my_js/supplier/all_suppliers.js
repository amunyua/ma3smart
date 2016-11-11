$('#edit-supplier-btn').on('click',function () {

});

$('#delete-supplier-btn').on('click',function(){
    var action = $(this).attr('action');
    $('#delete-supplier-form').attr('action',action);
});