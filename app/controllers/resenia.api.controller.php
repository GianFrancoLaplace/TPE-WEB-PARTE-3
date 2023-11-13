<?php
require_once 'app/controllers/api.controller.php';
require_once 'app/models/resenia.model.php';
require_once 'app/views/api.view.php';

class ReseniaApiController extends ApiController{
    private $model;

    function __construct(){
        parent::__construct(); //super()
        $this->model = new ReseniaModel();
    }

    function get($params = []) {
        if(empty($params)){

            $filterPond = null;
            
            $orden = (!empty($_GET['orden']) && $_GET['orden'] == 'desc') ? "DESC" : "ASC";
            
            $pagina = (!empty($_GET['pagina']) ? $_GET['pagina'] : 1);
            $elemPorPagina = (!empty($_GET['elementosPorPagina']) ? $_GET['elementosPorPagina'] : 20);
            $start_index = ($pagina - 1) * $elemPorPagina;

            $resenia = $this->model->getAll($orden, $elemPorPagina, $start_index);
            
            if (isset($_GET['ponderancia'])) {
                $filterPond = $_GET['ponderancia']; //1,2..
                if ($filterPond>=1 && $filterPond<=5){
                    $resenia = $this->model->getPond($filterPond);
                }
            }

            $resenia = $this->model->getAll($orden, $elemPorPagina, $start_index);

            return $this->view->response($resenia, 200);
        }
        else {
            //resenia/2
          $resenia = $this->model->getById($params[":ID"]);
          if(!empty($resenia)) {
            return $this->view->response($resenia,200);
          }else{
            return $this->view->response(['msg' => 'La resenia con el id='.$params[":ID"].' no existe'],404);
          }
        }
    }

    function delete($params = []) {
        $resenia_id = $params[':ID'];
        $resenia = $this->model->getById($resenia_id);

        if ($resenia) {
            $this->model->remove($resenia_id);
            $this->view->response(['msg' => 'Resenia id='.$resenia_id.' fue eliminada con éxito'], 200);
        }
        else 
            $this->view->response(['msg' => 'Resenia id='.$resenia_id.' no ha sido encontrada'], 404);
    }

    function create(){
        $resenia = $this->getData();
        
        if(!empty($resenia)){ 
            $pond = $resenia->pond;
            $des = $resenia->des;
            $idProduct = $resenia->id_product;

            $id = $this->model->insert($pond, $des, $idProduct); 
            $this->view->response(['msg' => 'La resenia fue insertada con el id = '.$id], 201);
            return;
        }else{
            $this->view->response("Faltan ingresar datos del resenia", 400);
            return;
        }
    }
}