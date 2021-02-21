$('form.ajax').on('submit',fuction(){

    var that = $(this),
    url = that.attr('action'),
    type = that.attr('method'),
    data = {};

    that.find('[name]').each(fuction(index, value) {
        var that = $(this),
        name = that.attr('name'),
        value = that.val();

        data[name] = value;

    });
    $.ajax({
        url: url,
        type: type,
        data: data
        success:fuction(response){
            console.log(response);
        }

    });


    return false;
});