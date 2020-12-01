<?php


$this->title = t('our_magazines');
$this->params['breadcrumbs'][] = $this->title;


use yii\web\View;


$this->registerJsFile('https://polyfill.io/v3/polyfill.js?features=default', [
//    'depends' => \frontend\assets\AppAsset::class,
    'position' => View::POS_HEAD
]);
$this->registerJsFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ3OliAp3MXHy-JYQ1bWfNmL9an4yqOys&callback=initMap', [
//    'depends' => \frontend\assets\AppAsset::class,
    'position' => View::POS_HEAD,
//    'async' => true,
    'defer' => true

]);
//$this->registerJsFile('js/map.js', [
//    'depends' => \frontend\assets\AppAsset::class,
//]);

$this->registerJS("
        let map;

        function initMap(Lat=40.374569, Lng=71.787051,name) {
        
         const uluru = { lat: Lat, lng: Lng };
       
          const map = new google.maps.Map(document.getElementById(\"contact-map\"), {
                zoom: 17,
                center: uluru,
//                  mapTypeId: 'satellite'
          });
//        alert(name);
          const marker = new google.maps.Marker({
            position: uluru,
            map: map,
             title: name,
             icon:'https://texnomart.uz/files/global/GOOGLE/mark.png'
          });  
        
        }
", View::POS_HEAD)
?>

    <!-- Start of .personal-page -->
    <div class="main-block universal-page">
        <div class="auto-container main-container contact">
            <div class="sidebar">
                <div class="inner-sidebar">
                    <ul class="my-accardion">
                        <?php foreach ($regions as $region): ?>
                            <li class="accardion-item">
                                <h1 class="accardion-item__title">
                                    <span><?= $region->name ?></span>
                                    <i class="fa fa-angle-down"></i>
                                </h1>

                                <ul class="accardion-item__content">
                                    <?php foreach ($region->getSklads()->andWhere(['sklad.in_map'=>1])->all() as $sklad): ?>
                                        <li class="content-item" data-lat="<?= $sklad->lat ?>"
                                            data-lng="<?= $sklad->long ?>">
                                            <div class="content-item__icon">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                            <div class="content-item__text">
                                                <p class="nomi" style="display: none"><?= $sklad->name ?></p>
                                                <h1 class="content-item__text-title"
                                                    style="cursor: pointer"><?= $sklad->address ?></h1>
                                                <p><?= $sklad->phone ?></p>
                                                <p><?= $sklad->work_time ?></p>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div class="article">
                <div id="contact-map"></div>
            </div>
        </div>
    </div>
    <!--End of .personal-page -->
<?php


?>