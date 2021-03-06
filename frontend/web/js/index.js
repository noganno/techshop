if (jQuery(".preloader-outer").length) {
    jQuery(window).on("load", function () {
        jQuery(".preloader-outer").fadeOut(700);
    });
}
$("document").ready(function ($) {
    $(".header-bottom .menu-item").hover(function () {
        $(this).find(".menu-item__megamenu").fadeIn();
    });
    $(".header-bottom .menu-item").mouseleave(function () {
        $(this).find(".menu-item__megamenu").fadeOut(0);
    });
    if ($(".banner > .banner-carousel").length) {
        $(".banner > .banner-carousel").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            dots: false,
            items: 1,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
        });
    }
    if ($(".special-offer__carousel").length) {
        $(".special-offer__carousel").owlCarousel({
            loop: true,
            margin: 30,
            nav: false,
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: true,
            responsiveClass: true,
            responsive: {0: {items: 1,}, 768: {items: 2,}, 1200: {items: 3,},},
        });
    }
    if ($(".products-cards__carousel").length) {
        $(".products-cards__carousel").owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            autoWidth: true,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            autoplayHoverPause: true,
            mouseDrag: true,
            responsiveClass: true,
            responsive: {0: {items: 1,}, 568: {items: 2,}, 768: {items: 3,}, 992: {items: 4,}, 1199: {items: 5,},},
        });
    }
    if ($(".products-cards").length) {
        $(".products-cards").owlCarousel({
            loop: false,
            margin: 0,
            nav: false,
            dots: false,
            items: 5,
            autoplayHoverPause: true,
            smartSpeed: 1000,
            autoWidth: true,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: true,
            responsiveClass: true,
            responsive: {0: {items: 1,}, 568: {items: 2,}, 768: {items: 3,}, 992: {items: 4,}, 1199: {items: 5,},},
        });
    }
    if ($(".brends__carousel").length) {
        $(".brends__carousel").owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
            responsiveClass: true,
            responsive: {0: {items: 1,}, 390: {items: 2,}, 768: {items: 3,}, 992: {items: 4,}, 1200: {items: 5,},},
        });
    }
    if ($(".deals-cards").length) {
        $(".deals-cards").isotope({itemSelector: ".products-cards__item",});
    }
    if ($(".filter-controls__item").length) {
        $(".filter-controls__item").on("click", function () {
            $(".filter-controls__item").removeClass("active");
            $(this).addClass("active");
            var filterSelector = $(this).attr("data-filter");
            $(".deals-cards").isotope({filter: filterSelector,});
            return false;
        });
    }
    if ($(".news__carousel").length) {
        $(".news__carousel").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
            responsiveClass: true,
            responsive: {0: {items: 1,}, 500: {items: 2,}, 768: {items: 3,}, 992: {items: 4,}, 1200: {items: 5,},},
        });
    }
    if ($(".recently-products__carousel").length) {
        $(".recently-products__carousel").owlCarousel({
            loop: false,
            margin: 0,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
            responsiveClass: true,
            responsive: {
                0: {items: 1,},
                390: {items: 2,},
                768: {items: 3,},
                992: {items: 4,},
                1200: {items: 5,},
                1300: {items: 6,},
            },
        });
    }
    if ($(".product-page__description .carousel-cards").length) {
        $(".product-page__description .carousel-cards").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
            responsiveClass: true,
            autoWidth: false,
            responsive: {0: {items: 1,}, 700: {items: 2,}, 1208: {items: 3,},},
        });
    }
    if ($(".show-password").length) {
        $(".show-password").append('<i class="fa fa-eye-slash"></i>');
        let isShowPassword = true;
        $(".show-password .fa").on("click", function () {
            if (isShowPassword) {
                $(this).removeClass("fa-eye-slash").addClass("fa-eye");
                $(this).siblings(".form-control").attr("type", "text");
                isShowPassword = !isShowPassword;
            } else {
                $(this).removeClass("fa-eye").addClass("fa-eye-slash");
                $(this).siblings(".form-control").attr("type", "password");
                isShowPassword = !isShowPassword;
            }
        });
    }
    if ($(".cart .cart-table .responsive-table table tbody tr .remove-column .remove").length) {
        $(".cart .cart-table .responsive-table table tbody tr .remove-column .remove").on("click", function () {
            $(this).parents("tr").remove();
        });
    }
    if ($(".sidebar .inner-sidebar .sidebar-accardion").length) {
        $(".sidebar .inner-sidebar .sidebar-accardion .sidebar-accardion__item .title").on("click", function () {
            $(this).siblings(".content").slideToggle();
        });
    }
    if ($("#handle-slider").length) {
        let minValues = $("#inner-value-min").text();
        let maxValues = $("#inner-value-max").text();
        $("#slider-range").slider({
            range: true,
            min: parseInt(minValues),
            max: parseInt(maxValues),
            values: [parseInt(minValues), parseInt(maxValues)],
            slide: function (event, ui) {
                $("#handle-slider-val-1").val(ui.values[0]);
                $("#handle-slider-val-2").val(ui.values[1]);
            },
        });
        $("#handle-slider-val-1").val($("#slider-range").slider("values", 0));
        $("#handle-slider-val-2").val($("#slider-range").slider("values", 1));
    }
    if ($("#product-group-sort-icon").length) {
        $("#product-group-sort-icon .fa").on("click", function () {
            if ($(this).hasClass("active") === false) {
                $(this).addClass("active");
                $(this).siblings(".fa").removeClass("active");
                if ($("#product-group-sort-wrapper").hasClass("th-list")) {
                    $("#product-group-sort-wrapper").removeClass("th-list").addClass("th-large");
                } else {
                    $("#product-group-sort-wrapper").removeClass("th-large").addClass("th-list");
                }
            }
        });
    }
    if ($(".contact").length) {
        $(".contact .my-accardion").on("click", ".accardion-item .accardion-item__content .content-item", function () {
            let getMapLat = parseFloat($(this).attr("data-lat"));
            let getName = ($(this).find(".nomi").text());
            let getMapLng = parseFloat($(this).attr("data-lng"));
            initMap(getMapLat, getMapLng, getName);
        });
    }
    if ($(".my-accardion").length) {
        $(".my-accardion .accardion-item .accardion-item__title").on("click", function () {
            $(this).siblings(".accardion-item__content").slideToggle();
        });
    }
    if ($(".post-carousel").length) {
        $(".post-carousel").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            navText: ['<img src="/images/png/arrow-left.png">', '<img src="/images/png/arrow-right.png">',],
            dots: false,
            items: 5,
            smartSpeed: 1000,
            autoplay: true,
            autoplayTimeout: 9000,
            mouseDrag: false,
            responsiveClass: true,
            autoWidth: false,
            responsive: {0: {items: 1, dots: false,}, 700: {items: 2, dots: false,}, 1200: {items: 3, dots: true,},},
        });
    }
    if ($(".mobile-bottom").length) {
        $(".mobile-bottom .mobile-bottom-menu .mobile-bottom-menu__search").on("click", function () {
            $(".search-box").slideToggle();
        });
    }
    if ($(".header-middle").length) {
        function stickiyMenu() {
            if (window.pageYOffset > 100) {
                $(".header-middle").addClass("sticky-top");
            } else {
                $(".hs-navigation").removeClass("open");
                $(".header-middle").removeClass("sticky-top");
            }
        }
    }
    $(window).on("scroll", function () {
        stickiyMenu();
        if ($("#scrollToTopBtn").length) {
            if (window.pageYOffset > 1000) {
                $("#scrollToTopBtn").show();
            } else {
                $("#scrollToTopBtn").hide();
            }
        }
    });
    $("#scrollToTopBtn").on("click", function () {
        $("html").animate({scrollTop: 0}, 500);
    });
    if ($("#input-file-chenge").length) {
        $("#input-file-chenge").on("change", function () {
            let oldText = $(this).siblings("label").find("span").text();
            let text = $(this).val();
            if (text !== "") {
                $(this).siblings("label").find("span").text(text);
            } else {
                $(this).siblings("label").find("span").text(oldText);
            }
        });
    }
    $(".datepicker").datepicker({altField: "#alternate", altFormat: "yy-mm-dd",});
    if ($(".registration-phone").length) {
        $(".registration-phone").inputmask({mask: "+\\9\\9\\8 (99) 999-99-99"});
    }
    if ($(".card-number").length) {
        $(".card-number").inputmask({mask: "9999 9999 9999 9999"});
    }
    if ($(".card-date").length) {
        $(".card-date").inputmask({mask: "99/99"});
    }
    if ($(".verify-code").length) {
        $(".verify-code").inputmask({mask: "999 999"});
    }
    if ($(".passport-seria").length) {
        $(".passport-seria").inputmask({mask: "AA 9999999"});
    }
    if ($(".inn-mask").length) {
        $(".inn-mask").inputmask({mask: "999 999 999"});
    }
    if ($(".header-middle .search-box__select2").length) {
        $(".header-middle .search-box__select2").click(function () {
            $(this).attr("tabindex", 1).focus();
            $(this).toggleClass("active");
            $(this).find(".search-box__select2-menu").slideToggle(300);
        });
        $(".header-middle .search-box__select2").focusout(function () {
            $(this).removeClass("active");
            $(this).find(".search-box__select2-menu").slideUp(300);
        });
        $(".header-middle .search-box__select2 .search-box__select2-menu li").click(function () {
            $(this).parents(".search-box__select2").find("span").text($(this).text());
            $(this).parents(".search-box__select2").find("input").val($(this).attr('id'));
        });
    }
    if ($(".btn-balance").length) {
        $(".btn-balance").on("click", function (e) {
            e.preventDefault();
            $(this).toggleClass("btn-balance_clicked");
        });
    }
    if ($("#header-region").length) {
        $("#header-region #header-region__dropdown-block.dropdown-block-show").show();
        $("#header-region #bg-color.bg-color-show").show();
        $("#header-region #header-region__dropdown").on("click", function () {
            $("#header-region #header-region__dropdown-block").fadeToggle();
            $("#header-region #bg-color").fadeToggle();
        });
        $("#header-region #bg-color").on("click", function () {
            $("#header-region #header-region__dropdown-block").fadeOut();
            $("#header-region #bg-color").fadeOut();
        });
    }
    if ($("#header-region-mobile").length) {
        $("#header-region-mobile #header-region-mobile__dropdown-block.dropdown-block-show").show();
        $("#header-region-mobile #bg-color-mobile.bg-color-show").show();
        $("#header-region-mobile #header-region-mobile__dropdown").on("click", function () {
            $("#header-region-mobile #header-region-mobile__dropdown-block").fadeToggle();
            $("#header-region-mobile #bg-color-mobile").fadeToggle();
        });
        $("#header-region-mobile #bg-color-mobile").on("click", function () {
            $("#header-region-mobile #header-region-mobile__dropdown-block").fadeOut();
            $("#header-region-mobile #bg-color-mobile").fadeOut();
        });
    }
    if ($(".hs-menubar").length) {
        $(".hs-menubar").hsMenu();
    }
});

$(document).ready(function () {
    $('.question-list .q a').on('click', function (e) {
        e.preventDefault();
        $(this).parents(".q").toggleClass('op').next(".ans").slideToggle(200);
    });

});