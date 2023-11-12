<?php 
    abstract class ApiController{
        protected $view; //para que accedan los hijos
        protected $data;

        function __construct(){
            $this->view = new ApiView();
            $this->data = file_get_contents('php://input');
            //es para leer la entrada de datos del form
            //queremos que sea un arreglo lo que se manda
        }

        function getData(){
            return json_decode($this->data); //es para transformar a json
        }
    }