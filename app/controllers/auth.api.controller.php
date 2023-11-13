<?php
     require_once 'app/controllers/api.controller.php';
     require_once 'app/helpers/token.api.helper.php';
     require_once 'app/models/user.model.php';

    class AuthApiController extends ApiController{
        private $model;
        public function __construct(){
            parent::__construct();
            $this->model = new UsersModel();
        }

        public function login($params =[]){
            $userData = $this->getData();
            if(empty($userData->password) || empty($userData->name)){
                $this->view->response(['msg' => 'Faltan completar campos'],400);
            }

            $userDB = $this->model->getByUser($userData->name);

            if(empty($userDB))
                $this->view->response(['msg'=> 'Usuario no encontrado'],401);

            if(!password_verify($userData->password, $userDB->password))
                $this->view->response(['msg'=> 'Contraseña incorrecta'],401);

            //$token = TokenHelper::generate($userDB);
            
            //$response = ['user'=> $token];
            //$this->view->response($response,200);


        }

        function getToken($params = []) {
            $basic = TokenApiHelper::getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

            if(empty($basic)) {
                $this->view->response('No envió encabezados de autenticación.', 401);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(user:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticación son incorrectos.', 401);
                return;
            }
            
            //Validacion de user
            if($user == "Nico" && $pass == "web") {
                // Usuario es válido
                
                $token = TokenApiHelper::createToken($userdata);
                $this->view->response($token);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }

        private function getData($basic){
            $userpass = base64_decode($basic[1]); // user:pass
            $userpass = explode(":", $userpass); // ["user", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = [ "name" => $user, "id" => 123, "role" => 'admin' ]; // Llamar a la DB

            return $userdata;
        }
    }