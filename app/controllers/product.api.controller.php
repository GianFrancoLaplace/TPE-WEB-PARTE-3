<?php   
    require_once 'app/models/product.model.php';
    require_once 'app/models/brand.model.php';

    class ProductApiController {
        private $view;
        private $model;

        function __construct(){
            $this->model = new ProductModel();
        }
    }