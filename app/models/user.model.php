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
            $this->_deploy();
        }

        function _deploy(){
            $query = $this->db->query('SHOW TABLES LIKE "usuarios"');
            $tables = $query->fetchAll();
            if (count($tables) == 0) {
                $sql = <<<END
            CREATE TABLE `usuarios` (
                `ID` int(11) NOT NULL AUTO_INCREMENT,
                `User` varchar(100) NOT NULL,
                `Password` varchar(100) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    END;
                $this->db->query($sql);
                $this->registerUser($this->getUserAdmin(), $this->getPasswordAdmin());
            }
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