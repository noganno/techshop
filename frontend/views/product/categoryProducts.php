<?php

use yii\helpers\Html;
use common\models\Category;

$this->title = $category->name;
$this->metaTitle = $category->getMetaTitle();
$this->metaImage = $category->getMetaImage();
$this->metaDescription = $category->getMetaDescription();
$this->metaKeywords = $category->getMetaKeywords();
$sort = $dataProvider->getSort();

Yii::$app->session->set('currentCategoryId', $category->id);

//<editor-fold desc="Breadcrumbs" defaultstate="collapsed">

$this->params['breadcrumbs'][] = [
    'label' => t('Catalog'),
    'url' => ['site/catalog'],
];
if ($category->lvl == 2) {
    $this->params['breadcrumbs'][] = [
        'label' => $category->parent->title,
        'url' => $category->parent->detailUrl,
    ];
}

if ($category->lvl == 3) {
    $this->params['breadcrumbs'][] = [
        'label' => $category->parent->parent->title,
        'url' => $category->parent->parent->detailUrl,
    ];
    $this->params['breadcrumbs'][] = [
        'label' => $category->parent->title, 'url' => $category->parent->detailUrl,
    ];
}

    $this->params['breadcrumbs'][] = $this->title;


// </editor-fold>

?>

<div class="main-block filter-product">
    <div class="auto-container container_left-sidebar-2">
        <?= $this->render('_leftFilter', [
            'category' => $category,
            'attributeValues' => $attributeValues,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'filterMaxPrice' => $filterMaxPrice,
            'brands' => $brands,
            'warranties' => $warranties,
            'countries' => $countries,
        ]); ?>
        <div class="article">
            <div class="product-wrapper-top">
                <div style="display:none">
                <?if ($category->name=="Кондиционеры") :?>
			<?/* Nachalo calc  Nachalo calc  Nachalo calc  Nachalo calc  Nachalo calc  Nachalo calc  Nachalo calc  Nachalo calc */?>
  <style>
	  #more_par_but:hover{
		  background-color:lavender !important;
		  outline-width: 2px;
		  outline: auto;
   }

	  #del_filter2:hover{
		  background-color:lavender !important;
		  outline-width: 2px;
		  outline: auto;
   }
  </style>

			<div class="container" style="width:auto; border-width: 1px;border-color:  #acacac;padding: 2%;border-style:  solid;margin:  2%;">
<h1 style="margin-bottom:0px;">Помощник подбора кондиционера</h1>
	<h6 style="margin-bottom:15px;font-weight:100;">Укажите размеры помещения, и сайт подберет для Вас подходящий кондиционер</h6>
	<div class="row">

		<div class="col-md-6" style="display:flex;">
				<div class="">

					<div style="margin: 15px; color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0;">Площадь помещения (м<sup>2</sup>)</div>
					<div style="margin: 15px">
						<input class="small" type="number" id="space" name="space" min="1" step="any" style="text-align:  center; border-width: 2px !important; border-style: solid; color: #acacac; font-size: 15px; border-color: #e0e0e0;" onkeypress="if( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
					</div>
					<div style="margin-top: -15px">
						<label class="error small" id="space_error" style="margin: 15px; color: red; font-family: GothamProRegular; font-size: 12px; border-bottom: 0px; display: none;">Введите данные!</label>
					</div>

				</div>
				<div class="">

					<div style="margin: 15px; color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0;">Высота потолка (м)</div>
					<div style="margin: 15px">
						<input class="small" type="number" id="height" name="height" min="1" step="any" pattern="\d+((,|\.)\d*)?" style="text-align:  center; border-width: 2px !important; border-style: solid; color: #acacac; font-size: 15px; border-color: #e0e0e0;" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"/>
					</div>
					<div style="margin-top: -15px">
						<label class="error small" id="height_error" style="margin: 15px; color: red; font-family: GothamProRegular; font-size: 12px; border-bottom: 0px; display: none;">Введите данные!</label>
					</div>
				</div>
		</div>

		<div class="col-md-3" style="text-align:center !important;">
			<input type="submit" name="submit" class="button" id="submit_btn" style="color: #fff; background-color: #fbc100 !important; border-radius: 25px !important; padding: 7%; margin: 5%; font-size: 18px; font-family: RobotoBold;" value="Рассчитать"/>
			<input type="button" id="more_par_but" style="font-size:11px;padding: 2%; margin :2%;background-color:#fff" value="Больше параметров"/><i id="strelka" class="fa fa-chevron-down"></i>
		</div>

		<div class="col-md-3">
			<button type="reset" id="del_filter2" name="del_filter2" value="Сбросить фильтр" style="margin-top: 5%; padding:5%;"><span><i class="fa fa-times" aria-hidden="true"></i> Сбросить фильтр</span></button>
		</div>

		<div class="col-md-12" id="more_parameters" style="display:none;"> 
			<div class="col-md-3" style="padding-left:0px;">
				<div style="margin: 15px; color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0;">Степень освещенности</div>
				<div class="col-md-12">
					<select name="insolation" class="select" style="color: #333333;font-family: GothamProRegular;font-size: 16px;border-bottom: 0;">
						<option value="30" style="color: #333333;font-family: GothamProRegular;font-size: 16px;border-bottom: 0;">Слабая</option>
						<option value="35" style="color: #333333;font-family: GothamProRegular;font-size: 16px;border-bottom: 0;">Средняя</option>
						<option value="40" style="color: #333333;font-family: GothamProRegular;font-size: 16px;border-bottom: 0;">Сильная</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div style="margin: 15px; color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0;">Количество людей в помещении</div>
				<div class="col-md-12">
					<input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="1" id="people_number" name="people_number" min="0" class="small" required="" style="text-align:  center; border-width: 2px !important; border-style: solid; color: #acacac; font-size: 15px; border-color: #e0e0e0;" />
				</div>
			</div>
			<div class="col-md-6">
				<div style="margin: 15px; color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0;">Количество компьютеров и <br>телевизоров</div>
				<div class="col-md-12">
					<input type="number" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="1" id="equipment_quantity" name="equipment_quantity" min="0" class="small" required="" style="text-align:  center; border-width: 2px !important; border-style: solid; color: #acacac; font-size: 15px; border-color: #e0e0e0;"/> 
				</div>
			</div>

		</div>
	</div>

	<div class="col-md-12 result" style="display: none; text-align: center; margin:  2%; padding: 2%; margin-left:0px;">

		<label id="result_label" style=" color: #333333;font-family: GothamProRegular;font-size: 18px;border-bottom: 0; font-weight: 700;">
			Мы предлагаем вам приобрести кондиционеры с мощностью охлаждения в диапазоне от <font id="Q_1" style="color:red;">15</font> до <font id="Q_2" style="color:red;">45</font> КВт.
		</label>

	</div>

</div>




	<script type="text/javascript">

	$( document ).ready(function() {

var divmosh = $('[property_id = "2155"]');
var dmelsoni = divmosh.children(".bx_filter_block").children().length;
var dmelementlar = divmosh.children(".bx_filter_block").children();

		//if ($(".bx_filter_container").attr('property_id').$(".bx_filter_block")) { alert("aa"); }
		//if ( $(".bx_filter_container").attr('property_id')==2155 ) { alert($(".bx_filter_container").attr('property_id')); }

del_filter2.onclick = function()
{
	del_filter.click();
}

		more_par_but.onclick = function() 
		{
			if (more_par_but.value=="Меньше параметров")
				{
					more_par_but.value="Больше параметров";	
					more_parameters.style.display="none";
					strelka.className="fa fa-chevron-down";
					return;
				}
			if (more_par_but.value=="Больше параметров")
				{
					more_par_but.value="Меньше параметров";
					more_parameters.style.display="block";				
					strelka.className="fa fa-chevron-up";
					return;
				}

		};
		$('.error').hide();
		$('.result').hide();
		var q=30;
		$('select').on('change', function() {
				q = this.value;
			});

		$(function() {
			$(".button").click(function() {

				$('.error').hide();

				var space = $("input#space").val();
				if (space == "") {
					$("label#space_error").text("Введите данные!");
					$("label#space_error").show();

					$("input#space").focus();
				return false;
				}
				if (space == "0") {
					$("label#space_error").text("Введите данные больше 0!");
					$("label#space_error").show();

					$("input#space").focus();
				return false;
				}

				var height = $("input#height").val();
				if (height == "") {
					$("label#height_error").text("Введите данные!");
					$("label#height_error").show();

					$("input#height").focus();
				return false;
				}
				if (height == "0") {
					$("label#height_error").text("Введите данные больше 0!");
					$("label#height_error").show();

					$("input#height").focus();
				return false;
				}

				var Q1 = space * height * q / 1000;
				var Q2 = 0.25 * $("input#equipment_quantity").val();
				var Q3 = 0.15 * $("input#people_number").val();
				var Q = Q1 + Q2 + Q3;
				$("#Q_1").text( Math.round((Q*0.95)*100)/100 );
				$("#Q_2").text( Math.round((Q*1.15)*100)/100 );

		if ( divmosh ) 
		{ 
			var min=Math.abs(dmelementlar.children('label')[0].innerText.slice(0, dmelementlar.children('label')[0].innerText.indexOf(' '))-Q*950);
			var max=Math.abs(dmelementlar.children('label')[0].innerText.slice(0, dmelementlar.children('label')[0].innerText.indexOf(' '))-Q*1150);
			var minI = 0 ;
			var maxI = 0 ;

			for (var i=0;i<dmelsoni;i++)
			{
				if (Math.abs(dmelementlar.children('label')[i].innerText.slice(0, dmelementlar.children('label')[i].innerText.indexOf(' '))-Q*950)<min)
				{
					min=Math.abs(dmelementlar.children('label')[i].innerText.slice(0, dmelementlar.children('label')[i].innerText.indexOf(' '))-Q*950);
					minI = i;
				}
				if (Math.abs(dmelementlar.children('label')[i].innerText.slice(0, dmelementlar.children('label')[i].innerText.indexOf(' '))-Q*1150)<max)
				{
					max=Math.abs(dmelementlar.children('label')[i].innerText.slice(0, dmelementlar.children('label')[i].innerText.indexOf(' '))-Q*1150);
					maxI = i;
				}
				dmelementlar.children('input')[i].checked = false;
			}
			var checkedsoni = 0; 
			for (var i=0;i<dmelsoni;i++)
			{
				//var moshnest = dmelementlar.children('label')[i].innerText;
				var text = dmelementlar.children('label')[i].innerText.slice(0, dmelementlar.children('label')[i].innerText.indexOf(' '));
				if ( text>=Q*950 && text<=Q*1150)
				{
					checkedsoni = 1;
					dmelementlar.children('input')[i].checked = true;
				}
			}
			if (checkedsoni == 0)
			{
				dmelementlar.children('input')[minI].checked = true;
				dmelementlar.children('input')[maxI].checked = true;
			}
		}
				//document.cookie = "cokspace=space;cokheight=height;cokQ2=Q2;cokQ3=Q3;cokq=q;";
				//alert( document.cookie );

				$.cookie("cokspace", space, { expires : 1 });
				$.cookie("cokheight", height, { expires : 1 });
 				$.cookie("cokQ2", $("input#equipment_quantity").val(), { expires : 1 });
 				$.cookie("cokQ3", $("input#people_number").val(), { expires : 1 });
				$.cookie("cokq", q, { expires : 1 });
				$.cookie("check", 1, { expires : 1 });
				$.cookie("cokQ", Q, { expires : 1 });
				//alert( document.cookie );
			$("#set_filter").click();
				//$('.result').show();
				//alert( document.cookie );
			});
			if ($.cookie("check")==1)
			{

			$('.result').show();
			document.getElementById("space").value = $.cookie("cokspace");
			document.getElementById("height").value = $.cookie("cokheight");
			document.getElementById("equipment_quantity").value = $.cookie("cokQ2");
			document.getElementById("people_number").value = $.cookie("cokQ3");
			$('.select').val($.cookie("cokq")).change();
				$("#Q_1").text( Math.round(($.cookie("cokQ")*0.95)*100)/100 );
				$("#Q_2").text( Math.round(($.cookie("cokQ")*1.15)*100)/100 );
				//$.cookie("check",0);
			}
		});
	});

		</script>

			<?/* конец калкятор  конец калкятор  конец калкятор  конец калкятор  конец калкятор  конец калкятор */?>
<?endif;?>
                </div>
                <div class="wrapper-block">
                    <div class="inner-block">
                      <?= $this->render('_sort', ['sort' => $sort]); ?>
                    </div>
                    <p class="inner-block-min" id="product-group-sort-icon">
                        <span>Вид:</span>
                        <i class="fa fa-th-list"></i>
                        <i class="fa fa-th-large active"></i>
                    </p>
                </div>
            </div>
            <div class="product-wrapper-bottom th-large" id="product-group-sort-wrapper">
                <?php foreach ($dataProvider->getModels() as $model): ?>
                    <?= $this->render('_productCard', ['model' => $model]); ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <?= \frontend\components\TexnomartLinkPager::widget([
            'id' => 'products-pagination',
            'pagination' => $dataProvider->getPagination()
    ]) ?>
</div>