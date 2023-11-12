<?php
require_once "./api/controller/table.api.controller.php";
require_once "./api/helpers/token.helper.php";
require_once "./api/models/user.model.php";

class AuthApiController extends ApiController{
    private $model;
    public function __construct(){
        parent::__construct();
        $this->model = new UsersModel();
    }

    public function login($params =[]){
        $user = $this->getData();
        if(empty($user->password) || empty($user->name)){
            $this->view->response(['msg' => 'Faltan completar campos'],400);
        }

        $userDB = $this->model->getByUser($user->name);

        if(empty($userDB))
            $this->view->response(['msg'=> 'Usuario no encontrado'],401);

        if(!password_verify($user->password, $userDB->password))
            $this->view->response(['msg'=> 'Contraseña incorrecta'],401);

        //$token = TokenHelper::generate($userDB);
        
        //$response = ['user'=> $token];
        //$this->view->response($response,200);
    }
}