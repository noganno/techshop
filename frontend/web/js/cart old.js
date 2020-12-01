$(document).ready(function () {


    $.ajax({
        url: '/site/get-cart-html',
        type: "GET",
        success: function (result) {
            if (result == "0") {
                showEmptyView();
                return true;
            }
            updateCartItems(result);
        }
    })

    $.ajax({
        url: '/site/get-rassrochka-html',
        type: "GET",
        success: function (result) {
            if (result == "0") {
                showEmptyView();
                return true;
            }
            updateRassrochkaItems(result);
        }
    })

    function updateRassrochkaItems(html) {
        $('#product-rassrochka .modal-body').html(html);
    }

    //show empty view
    function showEmptyView() {
        $('#product-basket').find('.modal-body .form-row').hide();
        $('#product-basket').find('.modal-body .product-cards').hide();
        $('#product-basket').find('.no-product-gif').show();

        $('#product-vKarzinu').find('.modal-body .form-row').hide();
        $('#product-vKarzinu').find('.modal-body .product-cards').hide();
        $('#product-vKarzinu').find('.no-product-gif').show();

        $('#product-rassrochka').find('.modal-body .table-responsive').hide();
        $('#product-rassrochka').find('.no-product-gif').show();
    }

    function hideEmptyView() {
        $('#product-basket').find('.modal-body .form-row').show();
        $('#product-basket').find('.modal-body .product-cards').show();
        $('#product-basket').find('.no-product-gif').hide();

        $('#product-vKarzinu').find('.modal-body .form-row').show();
        $('#product-vKarzinu').find('.modal-body .product-cards').show();
        $('#product-vKarzinu').find('.no-product-gif').hide();

        $('#product-rassrochka').find('.modal-body .table-responsive').show();
        $('#product-rassrochka').find('.no-product-gif').hide();
    }


    function updateStaticValues() {
        $.ajax({
            url: "/site/get-static-values",
            type: 'GET',
            success: function (result) {
                // console.log(result);
                // let values = JSON.parse(result);
                $(".count").text(result.productCount);
            }
        })
    }

    function updateCartItems(html) {
        hideEmptyView();
        updateStaticValues();
        $('#product-basket .product-wrapper').html(html);
    }

    /* -------------------------------------------------- */

    // product add to product cart
    if ($('.products-cards__item').length) {
        // window on resize functions
        function productFlyToCart() {
            //   console.log(readFromCookie());
            if ($(window).innerWidth() < 1200) {
                $('.products-cards__item .btns .add-to-cart').on('click', function (e) {
                    e.preventDefault();
                    let cartHtml = $('.mobile-bottom .mobile-bottom-menu .basket-icon');
                    let imgtodrag = $(this)
                        .parents('.products-cards__item')
                        .find('.img img');

                    // fly product to basket
                    if (imgtodrag) {
                        let imgclone = imgtodrag
                            .clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left,
                            })
                            .css({
                                opacity: '0.5',
                                position: 'absolute',
                                maxHeight: '150px',
                                maxWidth: '150px',
                                'z-index': '100',
                            })
                            .appendTo($('body'))
                            .animate(
                                {
                                    top: cartHtml.offset().top,
                                    left: cartHtml.offset().left,
                                    width: 30,
                                    height: 30,
                                },
                                1000,
                                'linear'
                            );

                        setTimeout(function () {
                            cartHtml.effect(
                                'shake',
                                {
                                    times: 2,
                                },
                                200
                            );
                        }, 1000);

                        imgclone.animate(
                            {
                                width: 0,
                                height: 0,
                            },
                            function () {
                                $(this).detach();
                            }
                        );
                    }

                    const id = $(this).parents('.products-cards__item').attr('data-id');

                    $.ajax({
                        url:
                            '/site/add-to-cart?product_id=' + id,
                        type: 'GET',
                        success: function (result) {
                            updateCartItems(result);
                            /* -------------------------------------------------- */
                        },
                    });
                });
            } else {
                $('.products-cards__item .btns .add-to-cart').on('click', function (e) {
                    e.preventDefault();
                    let cartHtml = $('.basket .basket-icon');
                    let imgtodrag = $(this)
                        .parents('.products-cards__item')
                        .find('.img img');

                    // fly product to basket
                    if (imgtodrag) {
                        let imgclone = imgtodrag
                            .clone()
                            .offset({
                                top: imgtodrag.offset().top,
                                left: imgtodrag.offset().left,
                            })
                            .css({
                                opacity: '0.5',
                                position: 'absolute',
                                maxHeight: '150px',
                                maxWidth: '150px',
                                'z-index': '100',
                            })
                            .appendTo($('body'))
                            .animate(
                                {
                                    top: cartHtml.offset().top,
                                    left: cartHtml.offset().left,
                                    width: 30,
                                    height: 30,
                                },
                                1000,
                                'linear'
                            );

                        setTimeout(function () {
                            cartHtml.effect(
                                'shake',
                                {
                                    times: 2,
                                },
                                300
                            );
                        }, 1000);

                        imgclone.animate(
                            {
                                width: 0,
                                height: 0,
                            },
                            function () {
                                $(this).detach();
                            }
                        );
                    }


                    const id = $(this).parents('.products-cards__item').attr('data-id');
                    $.ajax({
                        url:
                            '/site/add-to-cart?product_id=' + id,
                        type: 'GET',
                        success: function (result) {
                            // result = JSON.parse(result);
                            updateCartItems(result);
                            /* -------------------------------------------------- */
                        },
                    });
                });
            }
        }

        productFlyToCart();
        // $(window).on('resize', function () {
        //     productFlyToCart();
        // })
    }

    /* ------------------------------------------------------------------------------------------------- */
    // cart modal boxes and prouduct ++ or --
    // this is identificator for cart box remove item
    if ($('#product-basket').length && $('.modal').length) {
        $('#product-basket').on(
            'click',
            '.product-wrapper .product-item .remove .icon',
            function () {
                $(this).parents('li.product-item').remove();
                let id = $(this).parents('li.product-item').attr('data-id');
                $.ajax({
                    url: '/site/remove-from-cart?id=' + id,
                    type: "GET",
                    success: function (result) {

                    }
                })
                let countProduct = $('#product-basket').find('li.product-item').length;
                if (countProduct == 0) {
                    $('#product-basket').find('.modal-body .form-row').hide();
                    $('#product-basket').find('.modal-body .product-cards').hide();
                    $('#product-basket').find('.no-product-gif').show();
                } else {
                    $('#product-basket').find('.no-product-gif').hide();
                }
            }
        );
    }

    // for product.html
    // this is identificator for cart box remove item
    if ($('#product-vKarzinu').length && $('.modal').length) {
        $('#product-vKarzinu').on(
            'click',
            '.product-wrapper .product-item .remove .icon',
            function () {
                $(this).parents('li.product-item').remove();
                let id = $(this).parents('li.product-item').attr('data-id');
                $.ajax({
                    url: '/site/remove-from-cart?id=' + id,
                    type: "GET",
                    success: function (result) {

                    }
                })
                let countProduct = $('#product-vKarzinu').find('li.product-item')
                    .length;
                if (countProduct == 0) {
                    $('#product-vKarzinu').find('.modal-body .form-row').hide();
                    $('#product-vKarzinu').find('.modal-body .product-cards').hide();
                    $('#product-vKarzinu').find('.no-product-gif').show();
                } else {
                    $('#product-vKarzinu').find('.no-product-gif').hide();
                }
            }
        );
    }

    // for product.html
    // this is identificator for cart box remove item
    if ($('#product-rassrochka').length && $('.modal').length) {
        $('#product-rassrochka').on(
            'click',
            '.product-wrapper .product-item .remove .icon',
            function () {
                $(this).parents('li.product-item').remove();

                let id = $(this).parents('li.product-item').attr('data-id');
                $.ajax({
                    url: '/site/remove-from-cart?id=' + id,
                    type: "GET",
                    success: function (result) {

                    }
                })

                let countProduct = $('#product-rassrochka').find('li.product-item')
                    .length;
                if (countProduct == 0) {
                    $('#product-rassrochka').find('.modal-body .form-row').hide();
                    $('#product-rassrochka').find('.no-product-gif').show();
                } else {
                    $('#product-rassrochka').find('.no-product-gif').hide();
                }
            }
        );
    }

    //  .count-product -- or ++
    // if ($('.count-product').length) {
    $(document).on('click', ".count-product .control.minus", function () {
        let countProductValueUpdate = parseInt($(this).siblings('.value').text());
        if (countProductValueUpdate > 1) {
            countProductValueUpdate--;
            $(this).siblings('.value').text(countProductValueUpdate);
        }
    });
    $(document).on('click', ".count-product .control.plus", function () {
        let countProductValueUpdate = parseInt($(this).siblings('.value').text());
        countProductValueUpdate++;
        $(this).siblings('.value').text(countProductValueUpdate);
    });
    // }

    $('#singleAddProduct').on('click',function (e){
        e.preventDefault();
        let id = $(this).parents('.product-page__info').attr('data-id');
        // window on resize functions

        $.ajax({
            url:
                '/site/add-to-cart?product_id=' + id,
            type: 'GET',
            success: function (result) {
                updateCartItems(result);
                /* -------------------------------------------------- */
            },
        });

        // $('#product-basket').modal('show');

    })

    /* ====================================================================================================
  End of product to cart for coockie
  ==================================================================================================== */
});
