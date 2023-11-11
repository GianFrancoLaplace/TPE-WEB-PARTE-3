<?php
include_once 'app/models/brand.model.php';
include_once './product.controller.php';
include_once '../../config.php';
include_once 'app/views/api.view.php';

class BrandApiController
{
	private $controllerProduct;
	private $model;
	private $view;

	public function __construct()
	{
		$this->modelBrand = new BrandModel();
		$this->controllerProduct = new ProductApiController();
	}

	public function showPageHome()
	{
		$this->view->showHome();
	}

	public function showPageProducts($id = null){
		if ($id == "eeuu") {
			$id = "Estados Unidos";
		}
		if (isset($id)) {
			if ($id == "Estados Unidos" || $id == "argentina") {
				$tablaMarcaId = $this->model->getPaisOrigen($id);
				$resultado = array();
				foreach ($tablaMarcaId as $object) {
					$arreglo = $this->controllerProduct->model->getOrigen($object->ID);
					array_push($resultado, $arreglo);
				}
				//NO ELIMINAR PRODUCTOS PLEASE :)
				// var_dump($this->modelProduct->getPaisOrigen(ucfirst($id)));
				// $this->view->showProducts($this->modelProduct->getPaisOrigen(ucfirst($id)), $this->getMarcas());

			}
			if ($id == "creatina" || $id == "proteina" || $id == "aminoacidos") {
				$this->view->showProducts($this->controllerProduct->model->getCategoria(ucfirst($id)), $this->getMarcas());
			} else {
				$this->view->showProducts($this->controllerProduct->model->getMarca(ucfirst($id)), $this->getMarcas());
			}

		} else {
			$this->view->showProducts($this->controllerProduct->model->getAll(), $this->getMarcas());
		}
	}

	//BRANDS
	public function getMarcas()
	{
		return $this->model->getIdNombres();
	}

	public function showBrands()
	{
		$this->view->showBrands($this->model->getAll());
	}

	public function addBrands()
	{
		$name = $_POST['Nombre_categoria'];
		$des = $_POST['Descripcion_categoria'];
		$pais = $_POST['Pais_origen'];

		$id = $this->model->insert($name, $des, $pais);

		if ($id) {
			// redirigo la usuario a la pantalla principal
			header('Location: ' . BASE_URL);
		} else {
			echo "Error al insertar la tarea";
		}
	}

	public function removeBrand($id)
	{
		$this->model->remove($id);
		header('Location: ' . BASE_URL);
	}
}
