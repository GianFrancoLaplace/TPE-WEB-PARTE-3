<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/brand.model.php';
require_once 'app/views/api.view.php';
 
class ProductApiController extends ApiController{
    private $model;

    function __construct(){
        parent::__construct(); //super()
        $this->model = new ProductModel();
    }

    function get($params = []) {
        if(empty($params)){
            $filterPending = false;
                 
            $productos = $this->model->getAll();
            return $this->view->response($productos,200);
        }
        else {
          $productos = $this->model->getById($params[":ID"]);
          if(!empty($productos)) {
            return $this->view->response($productos,200);
          }else{
            return $this->view->response(['msg' => 'El producto con el id='.$params[":ID"].' no existe'],404);
          }
        }
    }

    function delete($params = []) {
        $producto_id = $params[':ID'];
        $producto = $this->model->getById($producto_id);

        if ($producto) {
            $this->model->remove($producto_id);
            $this->view->response(['msg' => 'Producto id=$producto_id fue eliminado con éxito'], 200);
        }
        else 
            $this->view->response(['msg' => 'Producto id=$producto_id no ha sido encontrado'], 404);
    }

    function create($params = []){
        $product = $this->getData();
        $name = $product->name;
        $des = $product->des;
        $price = $product->price;
        $weight = $product->weight;
        $category = $product->category;
        $brand = $product->brand;
        $img = $product->img;

        $id = $this->model->insert($name, $des, $price, $weight, $category, $brand, $img);
        $this->view->response(['msg' => 'La tarea fue insertada con el id = '.$id], 201);
    }


}