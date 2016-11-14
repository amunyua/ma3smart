$('.delete-s-p').on('click',function () {
    var action = $(this).attr('action');
    $('#delete-supp-item').attr('action',action);
});