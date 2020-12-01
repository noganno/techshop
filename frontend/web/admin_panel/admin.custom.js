/*
 * It is custom js file for admin panel
*/

$(document).ready(function(){

	/*
	 *  .btn-ajax elementlar uchun Ajax so'rov jo'natish funksiyasi
	*/

	$(document).on('click', ".btn-ajax", function(e){

		e.preventDefault()
		var homeUrl = $('span#homeUrl').data('url')
		var url = $(this).attr('href')
		var parent = $(this).parent()
		var oldHtml = parent.html()
		$.ajax({
			url: url,
			type: 'get',
			success: function (result){
				if(result === 'error'){
					alert('Xatolik yuz berdi!')
					parent.html(oldHtml)
				}
				else{
					parent.html(result)
				}
			},
			error: function(result){
				alert('Xatolik !!!')
				console.log('Xatolik !!!')
				parent.html(oldHtml)
				sendBtnAjax()
			},
			beforeSend: function(){
				var img = "<img src='"+homeUrl+"/images/loading.gif' height='17px'>"
				parent.html(img)
			}

		})
	})

	/*
	*  .btn-ajax-delete elementlar uchun Ajax so'rov jo'natish funksiyasi
	* gridview ichidagi elementlarni ajax so'rovi bilan o'chiradi
	* 
	*/

	$(document).on('click', '.btn-ajax-delete', function(e){
		e.preventDefault()

		if (!confirm("Siz ushbu elementni o'chirishni xoxlaysizmi?")) {
			return false;
		}

		var homeUrl = $('span#homeUrl').data('url')
		var url = $(this).attr('href')
		var td = $(this).parent()
		var tr = $(this).parent().parent()
		var nextTr = tr.next()
		var oldHtml = td.html()
		$.ajax({
			url: url,
			type: 'post',
			success: function (result){
				if(result === 'error'){
					alert('Xatolik yuz berdi!')
					td.html(oldHtml)
				}
				else{
					sweetAlertInfo("O'chirildi!!!")
					tr.remove()
					if(tr.data('key') == nextTr.data('key') ){
						nextTr.remove()
					}
				}
			},
			error: function(result){
				alert('Xatolik !!!')
				console.log('Xatolik !!!')
				td.html(oldHtml)
				sendBtnAjax()
			},
			beforeSend: function(){
				var img = "<img src='"+homeUrl+"/images/loading.gif' height='17px'>"
				td.html(img)
			}

		})
	})

	// reInitSomeFunctions()

	/*
	* Textaredagi matnni tartiblash
	*/
	$('#tartiblash').click(function(e){
		e.preventDefault()
		var textArea = $('#from-text-area')
		var text = textArea.val()
		var count = $('#fromtext-optionscount').val()
		var url = $(this).attr('href')
		$.ajax({
			url: url,
			type: 'post',
			data: {'text' : text, 'count' : count},
			success: function (result){
				textArea.val(result)				
			},
			error: function(result){
				alert('Xatolik !!!')
				console.log('Xatolik !!!')
			}
		})
	})
})

	function reInitSomeFunctions(){

		
	}