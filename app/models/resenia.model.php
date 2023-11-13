<?php
require_once 'app/controllers/resenia.api.controller.php';
require_once 'app/models/model.php';

class ReseniaModel extends Model{ //modelo tabla marca
    function __construct(){
        parent::__construct();
        $this->_deploy();
    }

    function _deploy(){
        $query = $this->db->query('SHOW TABLES LIKE "resenias"');
        $tables = $query->fetchAll();
        if (count($tables) == 0) {
            $sql = <<<END
        CREATE TABLE `resenias` (
            `ID` int(11) NOT NULL AUTO_INCREMENT,
            `Ponderancia` int(11) NOT NULL,
            `Descripcion` varchar(45) NOT NULL,
            `ID_Producto` int(11) NOT NULL,
            PRIMARY KEY (`ID`),
            FOREIGN KEY (`ID_Producto`) REFERENCES `productos` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
END;
            $this->db->query($sql);
        }
    }


    //listado de todo
    function getAll($order, $elemPorPagina, $start_index){//OK
        $query = $this->db->prepare("SELECT * FROM resenias ORDER BY Ponderancia $order LIMIT $elemPorPagina OFFSET $start_index");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getById($id) {//OK
        $query = $this->db->prepare('SELECT * FROM resenias WHERE ID = ?');
        
        $query->execute([$id]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //filtrar por ponderancia
    function getPond($category) {
        $query = $this->db->prepare('SELECT * FROM resenias WHERE Ponderancia = ?');
        $query->execute([$category]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function insert($pond, $des, $idProduct){
        $query = $this->db->prepare('INSERT INTO resenias (ID, Ponderancia, Descripcion, ID_Producto) VALUES (?,?,?,?)');
        $query->execute([null, $pond, $des, $idProduct]);

        return $this->db->lastInsertId();
    }

    function remove($id){
        $query = $this->db->prepare('DELETE FROM  resenias WHERE ID = ?');
        $query->execute([$id]);
    }


}
