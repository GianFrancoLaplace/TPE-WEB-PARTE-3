<?php
    require_once 'app/models/model.php';
    class UserModel extends Model{
        private $adminUser;
        private $password_hashed;

        function __construct(){
            parent::__construct();
            $this->adminUser = $this->getUserAdmin();
            $this->password_hashed = $this->getPasswordAdmin();
            $this->registerUser($this->adminUser, $this->password_hashed);
        }

        function getByUser($user){
            $query = $this->db->prepare('SELECT * FROM usuarios WHERE user = ?');
            $query->execute([$user]);
            $usuario = $query->fetch(PDO::FETCH_OBJ);

            return $usuario;

        }

        function registerUser($user, $password){
            $query = $this->db->prepare('INSERT INTO usuarios (user, password) VALUES (?, ?) ');
            $query->execute([$user, $password]);
        }

        function getUserAdmin(){
            $adminuser = "webadmin";
            return $adminuser;
        }

        function getPasswordAdmin(){
            $clave = "admin";
            $password_hashed = password_hash ($clave , PASSWORD_BCRYPT ); 
            return $password_hashed;
        }
    
}


        
?>