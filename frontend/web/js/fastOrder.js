$(document).ready(function(){
	modal=new ModalRemote('#product-vKarzinu');
	
	$(document).on('click','.fast-order-modal-button',function(event){event.preventDefault();modal.open(this,null);$(this).removeClass('fast-order-modal-button')
    $(this).attr('href','#')
    $(this).attr('data-toggle','modal')
    $(this).attr('data-target','#product-vKarzinu')});$(document).on('click','.plus-to-fast-order',function(e){e.preventDefault()
    var count=$('#fast-order-count').val()
    var price=$('#product-sale-price').val()
    count++;var totalPrice=number_format(count*price)
    $('span.total-summ span').html(totalPrice)
    $('#fast-order-count').val(count)
    $('#span-count').html(count)})
    $(document).on('click','.minus-from-fast-order',function(e){e.preventDefault()
        var count=$('#fast-order-count').val()
        if(count<=1)
            return false
        var price=$('#product-sale-price').val()
        count--;var totalPrice=number_format(count*price)
        $('span.total-summ span').html(totalPrice)
        $('#fast-order-count').val(count)
        $('#span-count').html(count)})
    $(document).on('click','.fast-order-resend-code',function(e){e.preventDefault()
        $('span#refresh-icon').html('<img src="/images/loading-sm.gif">')
        var url=$(this).attr('href')
        var tel=$('#fast-order-tel').val()
        $.ajax({url:url,data:{'tel':tel},type:'get',success:function(result){$('span#refresh-icon').html('<i class="fa fa-refresh"></i>')
                var data=JSON.parse(result)
                if(data.success){if(data.message)
                {toastr.info(data.message);swal({icon:"success",title:message,});}}
                else{if(data.message)
                {swal({icon:"error",title:message,});toastr.error(data.message);}}},error:function(result){$('span#refresh-icon').html('<i class="fa fa-refresh"></i>')
                toastr.error('Xatolik yuz berdi!')}})})});

		 /*$('#product-vKarzinu').on('hidden.bs.modal', function (e) { 
  
            // Fire a function in the console 
           // console.log('Function executed when product-vKarzinu closed'); 
              
        }) 

		 $(document).click('body', function(event) {
		  if ($(event.target).closest("#product-vKarzinu").length) {
		    console.log('#product-vKarzinu#product-vKarzinu#product-vKarzinu')
		  }
		});*/