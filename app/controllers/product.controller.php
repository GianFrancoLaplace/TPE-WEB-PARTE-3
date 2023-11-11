<?php 
include_once 'app/models/product.model.php';
include_once 'app/models/brand.model.php';
include_once 'app/views/product.view.php';

class ProductApiController{
    private $controllerBrand;
    private $model;
    private $view;

    public function __construct() {
        $this->controllerBrand = new BrandApiController();
        $this->model = new ProductModel();
        $this->view = new ApiView();
    }

    public function showPageHome(){
        $this->view->showHome();
    }

    public function showPageProducts($id = null){
        if($id=="eeuu"){
            $id="Estados Unidos";
        }
        if(isset($id)){
            if($id=="Estados Unidos" || $id == "argentina"){
                $tablaMarcaId = $this->modelBrand->getPaisOrigen($id);
                $resultado = array();
                foreach($tablaMarcaId as $object){
                    $arreglo = $this->modelProduct->getOrigen($object->ID);
                    array_push($resultado, $arreglo);
                }
                $this->view->showProducts($resultado, $this->getMarcas());
                //NO ELIMINAR PRODUCTOS PLEASE :)
                // var_dump($this->modelProduct->getPaisOrigen(ucfirst($id)));
                // $this->view->showProducts($this->modelProduct->getPaisOrigen(ucfirst($id)), $this->getMarcas());

            }
            if($id=="creatina" || $id=="proteina" || $id=="aminoacidos"){
                $this->view->showProducts($this->modelProduct->getCategoria(ucfirst($id)), $this->getMarcas());
            }else{
                $this->view->showProducts($this->modelProduct->getMarca(ucfirst($id)), $this->getMarcas());
            }
            
        }else{
            $this->view->showProducts($this->modelProduct->getAll(), $this->getMarcas());
        }
    }

    function showProductDetails($id){
        $this->view->showDetail($this->modelProduct->get($id));
        
    }

    function showPageCrud($id = null){
        if(isset($id)){
            if($id == 'agregar')
                $this->addProducto();
            // if($id == 'eliminar')
            //    $this->removeProducto();
        }else{
            $this->view->showCrud($this->modelProduct->getAll());
        }
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
        $id = $this->modelProduct->insert($name, $des, $price, $weight, $category, $brand, $img);
        if ($id) {
            // redirigo la usuario a la pantalla principal
            header('Location: ' . BASE_URL);
        } else {
            echo "Error al insertar la tarea";
        }
    }

    function removeProducto($id) {
        $this->modelProduct->remove($id);
        header('Location: ' . BASE_URL);
    }
    function updateProduct($id)
    {
        $newPrice = $_POST['nuevoPrecio'];
        $this->modelProduct->update($id, $newPrice);
        // $this->modelProduct->update($id, $name, $des, $price, $weight, $category, $brand, $img);
    }
    //BRANDS
    public function getMarcas(){
        return $this->modelBrand->getIdNombres();
    }

    public function showBrands()
    {
        $this->view->showBrands($this->modelBrand->getAll());
    }

    public function addBrands()
    {
        $name = $_POST['Nombre_categoria'];
        $des = $_POST['Descripcion_categoria'];
        $pais = $_POST['Pais_origen'];

        $id = $this->modelBrand->insert($name, $des, $pais);

        if ($id) {
            // redirigo la usuario a la pantalla principal
            header('Location: ' . BASE_URL);
        } else {
            echo "Error al insertar la tarea";
        }
    }

    public function removeBrand($id){
        $this->modelProduct->remove($id);
        header('Location: ' . BASE_URL);
    }
}
