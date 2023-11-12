<?php
include_once 'app/models/brand.model.php';
include_once 'product.controller.php';
include_once './config.php';
include_once 'app/views/api.view.php';
include_once 'app/controllers/api.controller.php';

class BrandApiController extends ApiController
{
	// private $controllerProduct;
	private $model;

	public function __construct()
	{
		$this->model = new BrandModel();
		// $this->controllerProduct = new ProductApiController();
	}


	//BRANDS
	public function getMarcas()
	{
		return $this->model->getIdNombres();
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
