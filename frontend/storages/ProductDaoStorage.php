<?php


    namespace frontend\storages;

    use frontend\models\Product;
    use yii\db\Connection;

    class ProductDaoStorage implements ProductInterface
    {

        const TABLE_NAME = 'product';

        private $connection;

        public function __construct(Connection $connection)
        {
            $this->connection = $connection;
        }

        public function load()
        {
            return $this->connection->createCommand('SELECT * FROM product')->queryAll();
        }

        public function getProductsMain() {

                return Product::find()
                    ->active()
                    ->orderBy(['order_count' => SORT_DESC])
                    ->latest(20)
                    ->with('categories')
                    ->with('category')
                    ->all();

        }
    }

