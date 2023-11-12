<?php
    include_once './TPE-WEB-PARTE-3/config.php';
    class UsersModel{
        private $adminUser;
        private $password_hashed;
        private $db;

        function __construct(){
            $this->db = $this->getConnection();
            $this->adminUser = $this->getUserAdmin();
            $this->password_hashed = $this->getPasswordAdmin();
            $this->registerUser($this->adminUser, $this->password_hashed);
        }
    
        function getConnection(){
            return new PDO("mysql:host=" . DB_HOST .";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
        }

        public function getByUsername($username){
            $query = $this->db->prepare('SELECT * FROM usuarios WHERE user = ?');

            $query->execute([$username]);

            return $query->fetch(PDO::FETCH_OBJ);
        }

    


    function getUser($user)
    {
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE user = ?');
        $query->execute([$user]);
        $usuario = $query->fetch(PDO::FETCH_OBJ);

        return $usuario;

    }

    function registerUser($user, $password)
    {
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