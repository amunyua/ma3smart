$('#supplier').on('change',function () {
    $('#fields').html('');
    var supplier_id = $(this).val();
    if (supplier_id != 0) {
        $.ajax({
            url: 'load-invoice-fields/'+ supplier_id,
            dataType: 'json',
            success: function (data) {
                var length = data.length;
                var label = '';

                if(length>0){
                    for (var i=0;i<length;i++){
                        label += '<section><div class="row"><label class="label col col-2">'
                            + data[i]['item_name']+ '</label><div class="col col-10"><label class="input"><i class="icon-append fa fa-keyboard-o"></i>'
                        + '<input type="number" required name="'+ data[i]['id'] +'" value="'+ data[i]['amount'] +'" autocomplete="off"></label></div></div></section>';
                        // $(label).insertAfter($('#before'));

                    }
                }
                $('#fields').html(label);
            }
        });
    }

});

$('.delete-invoice').on('click',function () {
    var action = $(this).attr('action');
    $('#delete-invoice-form').attr('action',action);
});