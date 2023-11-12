<?php 
include_once 'app/models/product.model.php';
include_once 'app/models/brand.model.php';
include_once 'app/controllers/brand.controller.php';
include_once 'app/controllers/api.controller.php';
include_once 'app/views/api.view.php';

class ProductApiController extends ApiController{
    // private $controllerBrand;
    private $model;
    // private $view;

    public function __construct() {
        // $this->controllerBrand = new BrandApiController();
        $this->model = new ProductModel();
        $this->view = new ApiView();
    }

    function get($params = []) {
        // if (isset($params)) {
        //     $productos = $this->model->get(params[]);
        //     echo "messi";
        // }else{
        //     echo "messi";
            $productos = $this->model->getAll();
        // }
        return $this->view->response($productos, 200);
    }

    function addProducto() {
        // TODO: validacion de datos
    
        // obtengo los datos del usuario
        $name = $_POST['Nombre'];
        $des = $_POST['Descripcion'];
        $price = $_POST['Precio'];
        $weight = $_POST['Peso'];
        $category = $_POST['Categoria'];
        $brand = $_POST['Marca'];
        $img = $_POST['Img'];

        // inserto en la DB
        $id = $this->model->insert($name, $des, $price, $weight, $category, $brand, $img);
        if (!$id) {
            echo "error";
        }
        
    }

    function removeProducto($id) {
        $this->model->remove($id);
    }
    
    function updateProduct($id)
    {
        $newPrice = $_POST['nuevoPrecio'];
        $this->model->update($id, $newPrice);
        // $this->modelProduct->update($id, $name, $des, $price, $weight, $category, $brand, $img);
    }

}
