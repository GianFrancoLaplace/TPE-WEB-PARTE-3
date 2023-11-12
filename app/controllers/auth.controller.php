<?php
    require_once 'app/views/auth.view.php';
    require_once 'app/models/users.model.php';
    require_once 'app/helpers/auth.helper.php';
    class AuthController{
        private $model;
        private $view;
    

        function __construct() {
            $this->model = new UsersModel();
            $this->view = new ApiView();
        }

        public function auth() {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if (empty($username) || empty($password)) {
                return;
            }

            // busco el usuario
            $user = $this->model->getByUsername($username);
            $hash = password_hash($password, PASSWORD_DEFAULT);
            

            
        }
    }

?>