<?php

    namespace frontend\config\bootstrap;

    use yii;
    use yii\base\BootstrapInterface;
    use yii\di\Container;
    use frontend\storages\ProductDaoStorage;
    use frontend\services\ProductService;

    /**
     * BoardBootstrap
     */
    class ProductBootstrap implements BootstrapInterface
    {

        public function bootstrap($app)
        {

            $container = \Yii::$container;

            $container->setSingleton('ProductService');

            $container->set('frontend\storages\ProductInterface', function() {
                return new ProductDaoStorage(Yii::$app->db);
            });
        }
    }