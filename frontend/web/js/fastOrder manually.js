
$(document).ready(function () {

    $(document).on('click', '.fast-order-btn', function (e) {
        e.preventDefault()
        var url = $(this).data('url')
        var productId = $(this).data('product-id')
        $.ajax({
            url: url ,
            data: {'productId' : productId},
            type: 'get',
            success: function (result){
                var data = JSON.parse(result)
                if(data.success){
                    $('#fast-order-modal-container').html(data.fastOrderModalContent)
                }
                else{
                    if (data.message)
                    {
                        toastr.error(data.message);
                    }
                }
            },
            error: function(result){
                toastr.error('Xatolik yuz berdi!')
            }
        })
    })


    $(document).on('click', '.plus-to-fast-order', function (e) {
        e.preventDefault()

        var span = $(this).parent().find('.value')
        var count = span.html()
        if (count < 1){
            count = 1;
        }
        count ++;

        var url = $(this).data('url')
        var productId = $(this).data('product-id')
        $.ajax({
            url: url ,
            data: {'productId' : productId},
            type: 'get',
            success: function (result){
                var data = JSON.parse(result)
                if(data.success){
                    $('#fast-order-modal-container').html(data.fastOrderModalContent)
                }
                else{
                    if (data.message)
                    {
                        toastr.error(data.message);
                    }
                }
            },
            error: function(result){
                toastr.error('Xatolik yuz berdi!')
            }
        })
    })


})

