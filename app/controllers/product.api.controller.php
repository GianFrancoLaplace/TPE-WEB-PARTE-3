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
        if(empty($params)){

            //producto?orden=asc
            $filterCategory = null;
            $orderByPrice = null;
            $productos = $this->model->getAll();
            //producto?category=creatina
            if (isset($_GET['categoria'])) {
                $filterCategory = $_GET['categoria']; //creatina
                if ($filterCategory == 'creatina' || $filterCategory == 'proteina' || $filterCategory == 'aminoacidos'){
                    $productos = $this->model->getCategory(ucfirst($filterCategory));
                }
            }

            // Verifica si se proporciona el parámetro 'orden' en la URL
            if (isset($_GET['orden'])) {
                $order = explode('.',$_GET['orden']); //price.asc o name.desc
                if(isset($order[0]) && isset($order[1])){
                    if($order[0]=='precio'){
                        if($order[1]=='asc'){
                            $productos = $this->model->getPrecioAsc();
                        }
                        if($order[1]=='desc'){
                            $productos = $this->model->getPrecioDesc();
                        }
                    }
                    if($order[0]=='nombre'){
                        if($order[1]=='asc'){
                            $productos = $this->model->getNombreAsc();
                        }
                        if($order[1]=='desc'){
                            $productos = $this->model->getNombreDesc();
                        }
                    }
                }
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

        $id = $this->model->insert($name, $des, $price, $weight, ucfirst($category), $brand, $img);
        $this->view->response(['msg' => 'La tarea fue insertada con el id = '.$id], 201);
    }
}