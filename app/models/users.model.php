<?php
    include_once 'config.php';
    class UsersModel{
        private $db;

        function __construct(){
            $this->db = $this->getConnection();
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
    
    function getConnection(){
        return new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    }

    public function getByUsername($username){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE User = ?');

        $query->execute([$username]);

        return $query->fetch(PDO::FETCH_OBJ);
    }

    


    function getUser($user){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE User = ?');
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);

        return $usuario;

    }

    function registerUser($user, $password){
        if (empty($this->getUser($user))){
            $query = $this->db->prepare('INSERT INTO usuarios (User, password) VALUES (?, ?)');
            $query->execute([$user, $password]);
        }
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