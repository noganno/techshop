$(document).ready(function () {
    $.ajax({
        url:"/ajax/get-rassrochka-products-sum",
        type:"GET",
        success:function (result) {
            $('#rSum').text(result);
        }
    })

    $("#product-rassrochka").on('change', ".creditMonth", function (e) {
        let creditType = $(this).parents('tr').attr('credit_type_id');
        let creditOption = $(this).val();
        let thisObj = $(this);
        $.ajax({
            url:"/ajax/get-values-by-credit-selection",
            type:"GET",
            data:{
                creditType:creditType,
                creditOption:creditOption
            },
            success:function (result) {
                thisObj.parents('.creditType').find('.monthlyPrice').find('span').text(result);
                console.log(result);
            }
        })
    })




})