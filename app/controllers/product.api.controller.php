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
            $field = 'Nombre';
            $orden = 'ASC';
            $pagina = (!empty($_GET['pagina']) ? $_GET['pagina'] : 1);
            $elemPorPagina = (!empty($_GET['elementosPorPagina']) ? $_GET['elementosPorPagina'] : 20);
            $start_index = ($pagina - 1) * $elemPorPagina;

            // $productos = $this->model->getAll($elemPorPagina, $start_index);
            $productos = $this->model->getAll($field,$orden, $elemPorPagina, $start_index);
            
            // $productos = $this->model->getAll($elemPorPagina, $start_index);
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
                if (($order[0] == 'precio' || $order[0] == 'nombre') && ($order[1] == 'asc' || $order[1] == 'desc')){
                    $field = ucfirst($order[0]);
                    $orden = strtoupper($order[1]);
                }
                    
            }

            $productos = $this->model->getAll($field,$orden, $elemPorPagina, $start_index);
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
            $this->view->response(['msg' => 'Producto id='.$producto_id.' fue eliminado con éxito'], 200);
        }
        else 
            $this->view->response(['msg' => 'Producto id='.$producto_id.' no ha sido encontrado'], 404);
    }

    function create($params = []){
        $user = TokenApiHelper::currentUser();

        if(!$user){
            $this->view->response("No autorizado",401);
            return;
        }

        if($user->admin=false){
            $this->view->response("Prohibido", 403);
            return;
        }

        $product = $this->getData();

        if(!empty($product)){
            $name = $product->name;
            $des = $product->des;
            $price = $product->price;
            $weight = $product->weight;
            $category = $product->category;
            $brand = $product->brand; //mandar brand con id
            $img = $product->img;

            // {
            //     "name": "Nombre del Producto",
            //     "des": "Descripción del Producto",
            //     "price": 19.99,
            //     "weight": 0.5,
            //     "category": "Electrónicos",
            //     "brand": "Marca XYZ",
            //     "img": "imagen.jpg"
            // }

            $id = $this->model->insert($name, $des, $price, $weight, ucfirst($category), $brand, $img); 
            $this->view->response(['msg' => 'El producto fue insertado con el id = '.$id], 201);
            return;
        }else{
            $this->view->response("Faltan ingresar datos del producto", 400);
            return;
        }
    }

    function update($params = []){
        $user = TokenApiHelper::currentUser();

        if(!$user){
            $this->view->response("No autorizado",401);
            return;
        }

        if($user->admin=false){
            $this->view->response("Prohibido", 403);
            return;
        }        

        $data = $this->getData();
        
        $newValue = $data->price;

        $id = $params[":ID"];

        if (!isset($id)) {
            $this->view->response(['msg' => 'Producto id=' . $id .' no ha sido encontrado'], 404);
            return;
        }

        if(!empty($newValue) && is_numeric($newValue)){
            $this->model->updatePrice($newValue, $id); 
            $this->view->response(['msg' => 'Se modificó el producto con el id = '.$id], 200);
            return;
        }else{
            $this->view->response("Faltan ingresar datos del producto", 400);
            return;
        }
    }
}