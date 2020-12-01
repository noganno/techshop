<?php

use yii\helpers\Url;
use common\models\Page;
    $region = Yii::$app->help->activeRegion;
 /*   $pages = Yii::$app->db->cache(function(){
        return  Page::find()->indexBy('idn')->all();
    });*/


?>



<?
// текущая страница: yii2
$page = Yii::$app->request->pathInfo;
echo "<script>console.log('Debug Objects: " . $page . "' );</script>";
if ( $page == "ru" || $page == "uz" || $page == "kr" || $page == "") 
	{        
?>

    <style>
        #dialogContainer
        {
            display: flex;
            align-items: center;
            justify-content: center;
			z-index: 16777270;
            position: fixed;
            width: 100%;
            height: 100%;   
            background-color: rgba(255, 255, 255, 0.7);
        }
		#dialogWindow
        {
			/*
            position: fixed;
            width: 35%;
            border-radius: 20px;
            background-color: #fff;
            padding: 30px 10px;
            z-index: 16777271;
            color: #000;
			*/
                z-index: 16777271;
                background-color: #fff;
                position: fixed;
        }


        #closeDialogBtn
        {
			/*
            position: absolute; 
            right:  10px;
            top: 10px;
            width: 30px;
            height: 30px;
            line-height: 30px;
            border-radius: 20px;
            cursor: pointer;
            background: #000;
            color: #fff;
			*/
                position: absolute;
                right: 25px;
                top: 25px;
                width: 30px;
                height: 30px;
                line-height: 30px;
                border-radius: 20px;
                background: rgb(255 255 255 / 0%);
                color: rgb(255 255 255 / 78%);
                border: 0px;
                font-size: 40px;
                font-weight: bold;
                cursor: pointer;
        }        	
    	#imageforpopup
		{
			border-radius: 15px;
			background-color: transparent !important;
			border-color: #333324 !important;
			box-shadow: 1px 1px 10px 0px grey;
		}

    </style>

<div id="dialogContainer">
    <div id="dialogWindow">
        <button id="closeDialogBtn" onclick="closeTheDialogWindow()">X
        </button>
        <!--
			<a href="#" target="_blank">
            </a> -->
<script>  
    width= window.innerWidth;  
    height= window.innerHeight; 
    console.log('Debug Objects:' + width+'x'+height);
    if (width < 700) 
    {
        document.write("<img src='/files/global/Popup/ЧП%20Pop-up%20mobile.png' id='imageforpopup' style='width:300px'>");
    }else
    {
        document.write("<img src='/files/global/Popup/Сарик%20жума%20Pop-up.png' id='imageforpopup'>");
    }
</script>
        
	</div>
</div>
<script>

var myEl = document.getElementById('dialogContainer');

myEl.addEventListener('click', function() {
    document.getElementById("dialogContainer").style.display = "none";
}, false);


function closeTheDialogWindow() {
    document.getElementById("dialogContainer").style.display = "none";
}
</script>
<?
    }
?>


<?php if ($this->beginCache("headertop", ['duration' => Yii::$app->params['pageCache']])): ?>


    <div class="header-top">
        <div class="auto-container">
            <ul class="help-compare">
                <li id="header-region">
                        <span id="header-region__dropdown">
                           <?php echo $this->renderDynamic('return Yii::$app->help->activeRegion->name;'); ?> <i class="fa fa-angle-down"></i>
                        </span>
                    <div id="bg-color" class="<?= $region ? "" : "bg-color-show" ?>"></div>
                    <ul id="header-region__dropdown-block" class="<?= $region ? "" : "dropdown-block-show" ?>">
                        <?php foreach (\common\models\Towns::find()->where(['status' => 1])->all() as $town): ?>
                            <li><a class="myNav-bar__item-dropdown-item"
                                   href="<?= Url::to(['site/select-region', 'id' => $town->id]) ?>"><?= $town->name ?></a>
                            </li>

                        <?php endforeach; ?>
                    </ul>
                </li>
                <li><a href="<?= Url::to('/balance/index/') ?>"><i
                                class="fa fa-balance-scale"></i><?= Yii::t('app', 'taqqoslash') ?></a><span
                            class="count"><?php echo $this->renderDynamic('return Yii::$app->balance->getCountItems();'); ?></span></li>
            </ul>
            <nav class="myNav">
                <ul class="myNav-bar">
                    <!--                <li class="myNav-bar__item">-->
                    <!--                    <a href="--><?//= Url::to(['blog/discounts']) ?><!--"-->
                    <!--                       class="myNav-bar__link">--><?//= Yii::t('app', 'aksiya') ?><!--</a>-->
                    <!--                </li>-->
                    <li class="myNav-bar__item">
                        <a href="#" class="myNav-bar__link">
                            <?= Yii::t('app', 'rassrochka') ?>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="myNav-bar__item-dropdown">
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'about']) ?>"><?= Yii::t('app', 'company') ?></a>
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'purchase-on-loan']) ?>"><?= Yii::t('app', 'qarzga_olish') ?></a>
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'warranty']) ?>"><?= Yii::t('app', 'garantiya_na_tovari') ?></a>
                            <!--<a class="myNav-bar__item-dropdown-item"
                               href="<?/*= Url::to(['site/page', 'id' => 'bonus-system']) */?>"><?/*= Yii::t('app', 'bonus_system') */?></a>-->
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'free-delivery']) ?>"><?= Yii::t('app', 'delivery') ?></a>
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'purchase-online']) ?>"><?= Yii::t('app', 'payment') ?></a>
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'help']) ?>"><?= Yii::t('app', 'help') ?></a>
                            <a class="myNav-bar__item-dropdown-item"
                               href="<?= Url::to(['site/page', 'id' => 'about-manufacturers']) ?>"><?= Yii::t('app', 'proizvoditeli') ?></a>
                        </div>
                    </li>
<!--                    <li class="myNav-bar__item">
                        <a href="<?/*= Url::to(['site/page', 'id' => 'bonus-system']) */?>"
                           class="myNav-bar__link"><?/*= Yii::t('app', 'bonus_system') */?></a>
                    </li>-->
                    <li class="myNav-bar__item">
                        <a href="<?= Url::to(['site/sklad-map']) ?>"
                           class="myNav-bar__link"><?= Yii::t('app', 'our_magazines') ?></a>

                    </li>
                    <li class="myNav-bar__item">
                        <a href="<?= Url::to(['site/page', 'id' => 'about']) ?>"
                           class="myNav-bar__link"><?= Yii::t('app', 'About us') ?></a>
                    </li>
                </ul>
            </nav>
            <div class="tel">
                <a href="tel:+998712099944">+99871 209 99 44</a>
            </div>
        </div>
    </div>

    <?php $this->endCache(); ?>
<?php endif ?>