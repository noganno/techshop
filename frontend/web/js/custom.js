function number_format(s){var a=s.toString();var j=1;var r='';var n='';for(var i=a.length-1;i>=0;i--){r=r+(a[i])
    if(j%3==0&&j!=a.length){r=r+' ';}
    j++;}
    for(var i=r.length-1;i>=0;i--){n=n+(r[i])}
    return n;}
$(function(){if($("#handle-slider").length){let minValues=$("#inner-value-min").text();let maxValues=$("#inner-value-max").text();$("#slider-range").slider({range:true,min:parseInt(minValues),max:parseInt(maxValues),values:[parseInt($('#input-min-price').val()),parseInt($('#input-max-price').val())],slide:function(event,ui){var minCost=Math.trunc(ui.values[0]/1000)*1000
        var maxCost=Math.trunc(ui.values[1]/1000)*1000
        $("#handle-slider-val-1").val(number_format(minCost));$("#handle-slider-val-2").val(number_format(maxCost));$('#input-min-price').val(minCost)
        $('#input-max-price').val(maxCost)}});var minValue=$("#slider-range").slider("values",0)
    var maxValue=$("#slider-range").slider("values",1)
    $("#handle-slider-val-1").val(number_format(minValue));$("#handle-slider-val-2").val(number_format(maxValue));}
    var desc=$('body a.desc')
    var descIcon="<i class = 'fa fa-sort-amount-desc'></i>"
    desc.append(descIcon)
    var asc=$('body a.asc')
    var ascIcon="<i class = 'fa fa-sort-amount-asc'></i>"
    asc.append(ascIcon)
    function onSignIn(googleUser){var profile=googleUser.getBasicProfile();console.log("ID: "+profile.getId());console.log('Full Name: '+profile.getName());console.log('Given Name: '+profile.getGivenName());console.log('Family Name: '+profile.getFamilyName());console.log("Image URL: "+profile.getImageUrl());console.log("Email: "+profile.getEmail());var id_token=googleUser.getAuthResponse().id_token;console.log("ID Token: "+id_token);}
    function signOut(){gapi.auth2.getAuthInstance().signOut().then(function(){console.log('user sign out')})}
    $(document).on('click','#products-pagination ul li a',function(event){event.preventDefault()
        let form=$('#product-filter-form')
        let url=$(this).attr('href')
        form.attr('action',url)
        form.submit()})
    $(document).on('click','#signup-label',function(event){let url=$(this).data('url')
        window.location.href=url})})
$('.header-middle .search-box__select2').focusout(function(){$(this).removeClass('active');$(this).find('.search-box__select2-menu').slideUp(300);});$('.header-middle .search-box__select2 .search-box__select2-menu li').click(function(){$(this).parents('.search-box__select2').find('span').text($(this).text());$(this).parents('.search-box__select2').find('input#category-id').val($(this).attr('id'));});$('.slider-link-item').on('click',function(e){let link=$(this).attr('href');window.location.href=link;})