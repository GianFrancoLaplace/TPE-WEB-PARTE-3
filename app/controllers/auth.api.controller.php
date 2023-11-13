<?php
     require_once 'app/controllers/api.controller.php';
     require_once 'app/helpers/token.api.helper.php';
     require_once 'app/models/user.model.php';

    class AuthApiController extends ApiController{
        private $model;
        public function __construct(){
            parent::__construct();
            $this->model = new UserModel();
        }

        function getToken($params = []) {
            //Obtengo encabezado de autorizacion:
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
            $userpass = base64_decode($basic[1]); // user:pass
            $userpass = explode(":", $userpass); // ["user", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = [ "name" => $user, "password" => $pass, "role" => 'admin' ]; 
            
            // Llamar a la DB
            $userDB = $this->model->getByUser($userdata["name"]);

            if(empty($userDB))
                return $this->view->response(['msg'=> 'Usuario no encontrado'],401);

            if(!password_verify($userdata["password"], $userDB->password)){
                return $this->view->response(['msg'=> 'Contraseña incorrecta'],401);
            }
            else{
                //Todo correcto, creamos token
                $token = TokenApiHelper::createToken($userdata);
                $this->view->response($token);
            }
        }
    }