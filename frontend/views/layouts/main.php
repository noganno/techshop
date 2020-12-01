<?php

/* @var $this \soft\web\SView */

/* @var $content string */

use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
\frontend\assets\ToastrMinAsset::register($this);


$title = $this->metaTitle ?? $this->title;
$description = $this->metaDescription;
$keywords = $this->metaKeywords;
$image = $this->metaImage ?? "/images/logo.png";

$baseUrlManager = new \yii\web\UrlManager([
    'showScriptName' => false,
    'enablePrettyUrl' => true,
]);

$image = $baseUrlManager->createAbsoluteUrl($image);
$url = $this->metaUrl ?? \yii\helpers\Url::current();

//Google Meta Tags

$this->registerMetaTag(['name' => 'title', 'content' => $title], 'title');
$this->registerMetaTag(['name' => 'description', 'content' => $description], 'description');
$this->registerMetaTag(['name' => 'keywords', 'content' => $keywords], 'keywords');

// Open Graph
$this->registerMetaTag(['property' => 'og:type', 'content' => "website"], 'ogType');
$this->registerMetaTag(['property' => 'og:url', 'content' => $url], 'ogUrl');
$this->registerMetaTag(['property' => 'og:title', 'content' => $title], 'ogTitle');
$this->registerMetaTag(['property' => 'og:description', 'content' => $description], 'ogDescription');
$this->registerMetaTag(['property' => 'og:image', 'content' => $image], 'ogImage');

// Twitter
$this->registerMetaTag(['property' => "twitter:card", 'content' => "summary_large_image"], "twitterCard");
$this->registerMetaTag(['property' => "twitter:url", 'content' => $url], 'twitterUrl');
$this->registerMetaTag(['property' => "twitter:title", 'content' => $title], 'twitterTitle');
$this->registerMetaTag(['property' => "twitter:description", 'content' => $description], 'twitterDescription');
$this->registerMetaTag(['property' => "twitter:image", 'content' => $image], 'twitterImage');

Yii::$app->name = "Texnomart";

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-scope" content="profile email">
        <meta name="google-signin-client_id"
              content="463644899427-gcgff8c3185inb70btbaqh1ha6m8ilmr.apps.googleusercontent.com">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="icon" href="/images/favicon.ico">


        <?php $this->head() ?>

        <!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(39788475, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39788475" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-62697167-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-62697167-1');
</script>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '725764004815741');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=725764004815741&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

    </head>
    <body>

    <?php $this->beginBody() ?>
    <div class="wrap">
        <!--        <div class="preloader-outer">-->
        <!--            <div class="preloader">-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--        <div class="ajax-loader-outer ">-->
        <!--            <div class="ajax-loader">-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--                <span></span>-->
        <!--            </div>-->
        <!--        </div>-->

        <div class="page">

            <!-- Start of .header-top -->
            <?= $this->render('_headerTop') ?>
            <!-- End of .header-top -->


            <!-- Start of .header-middle -->
            <?= $this->render('_headerMiddle') ?>
            <!-- End of .header-middle -->

            <?php if ($this->beginCache("headerBottom1", ['duration' => Yii::$app->params['pageCache']])): ?>
                <!-- Start of .header-bottom -->
                <?= $this->render('_headerBottom') ?>
                <!-- End of .header-bottom -->
                <?php $this->endCache(); ?>
            <?php endif ?>


            <!-- Start of .header-bottom-2 -->
            <?= $this->render('_headerBottom2') ?>


            <?php if (Yii::$app->controller->route != 'site/index'): ?>
                <?= $this->render('_breadcrumb') ?>
            <?php endif ?>

            <?= $content ?>

            <?php
            echo Html::hiddenInput('add-to-cart-url', url_to(['cart/add-to-cart']), ['id' => 'add-to-cart-url']);
            echo Html::hiddenInput('remove-from-cart-url', url_to(['cart/remove-from-cart']), ['id' => 'remove-from-cart-url']);
            echo Html::hiddenInput('change-count-on-cart-url', url_to(['cart/change-count-on-cart']), ['id' => 'change-count-on-cart-url']);
            echo Html::hiddenInput('plus-to-cart-url', url_to(['cart/plus-to-cart']), ['id' => 'plus-to-cart-url']);
            echo Html::hiddenInput('minus-from-cart-url', url_to(['cart/minus-from-cart']), ['id' => 'minus-from-cart-url']);

            echo Html::hiddenInput('product-fast-order-url', url_to(['cart/product-fast-order']), ['id' => 'product-fast-order-url']);

            ?>

            <?php if ($this->beginCache("footer", ['duration' => Yii::$app->params['pageCache']])): ?>

                <!-- Start of .footer -->
                <?= $this->render('_footer'); ?>
                <!-- End of .footer -->

                <?php $this->endCache(); ?>
            <?php endif ?>

        </div><!-- end of page -->

        <!-- mobile bottom menu -->
        <?= $this->render('_mobileFooter') ?>
        <?= $this->render('_modals') ?>

    </div>

    <?php \dominus77\sweetalert2\Alert::widget(['useSessionFlash' => true]) ?>
    <?php $this->endBody() ?>

    <!-- BEGIN BX widget CODE {literal} -->
    <script>
        (function (w, d, u) {
            var s = d.createElement('script');
            s.async = true;
            s.src = u + '?' + (Date.now() / 60000 | 0);
            var h = d.getElementsByTagName('script')[0];
            h.parentNode.insertBefore(s, h);
        })(window, document, 'https://intranet.tm.uz/upload/crm/site_button/loader_1_3ujz6t.js');
    </script>
    <!-- {/literal} END BX widget CODE -->

   

    </html>
<?php $this->endPage() ?>