<?php

    namespace frontend\services;

    use frontend\storages\ProductInterface;

    class ProductService
    {
        private $productService;

        private $item = [];

        /**
         * ProductService constructor.
         */
        public function __construct(ProductInterface $productInterface)
        {
            $this->productService = $productInterface;
        }

        public function getItems()
        {
            $this->loadItems();
            return $this->item;
        }

        private function loadItems()
        {
            $this->item = $this->productService->load();
        }

        private function getProductsMain()
        {
            $this->item = $this->productService->getProductsMain();
        }

    }