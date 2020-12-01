<?php

    namespace frontend\storages;


    interface ProductInterface
    {
        /**
         * @return array
         */
        public function load();

        public function getProductsMain();

    }