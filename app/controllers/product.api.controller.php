<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/product.model.php';
require_once 'app/views/api.view.php';
require_once 'app/helpers/token.api.helper.php';
 
class ProductApiController extends ApiController{
    private $model;

    function __construct(){
        parent::__construct(); //super()
        $this->model = new ProductModel();
    }

    function get($params = []) {
        var_dump($_GET);
        die();
        if(empty($params)){

            //prodcuto?orden=asc
            $filterCategory = null;
            $orderByPrice = null;
            $productos = $this->model->getAll();
            
            //producto?category=creatina
            if (isset($_GET['category'])) {
                $filterCategory = $_GET['category']; //creatina
                $productos = $this->model->getCategory($filterCategory);
            }

            // Verifica si se proporciona el parámetro 'order' en la URL
            if (isset($_GET['order'])) {
                $order = explode('.',$_GET['order']); //price.asc o name.desc
                if($order[1]=='asc')
                    $productos = $this->model->getOrderAsc($order[0]);
                else 
                    $productos = $this->model->getOrderDesc($order[0]);
            }

            // Devuelve la respuesta con los productos
            return $this->view->response($productos, 200);
        }
        else {
            //producto/2
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
        $user = TokenApiHelper::currentUser();

        if(!$user){
            $this->view->response("No autorizado",401);
            return;
        }

        if($user->role!="admin"){
            $this->view->response("Prohibido", 403);
            return;
        }

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