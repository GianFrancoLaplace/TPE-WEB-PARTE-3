<?php 
include_once 'app/controllers/product.controller.php';
require_once 'app/models/model.php';

class BrandModel extends Model{ //modelo tabla marca
    function __construct(){
        parent::__construct();
    }
    //listado de todo
    function getAll(){ 
        $query = $this->db -> prepare('SELECT * from marcas');
        $query -> execute();
    
        $marcas = $query -> fetchAll(PDO::FETCH_OBJ);
    
        return $marcas;
    }

    function getById($id) {
        $query = $this->db->prepare('SELECT ID, Nombre FROM marcas WHERE ID = ?');
        
        $query->execute([$id]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getByPaisOrigen($paisOrigen) {
        $query = $this->db->prepare('SELECT ID FROM marcas WHERE Pais_Origen = ?');
        
        $query->execute([$paisOrigen]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getIdNombres(){
        $query = $this->db->prepare('SELECT ID, Nombre FROM marcas');
        
        $query->execute();
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function insert($name, $des, $pais)
    {
        $query = $this->db->prepare('INSERT INTO marcas (ID, Nombre, Descripcion, Pais_Origen) VALUES (?,?,?,?)');
        $query->execute([null, $name, $des, $pais]);

        return $this->db->lastInsertId();
    }

    function remove($id){
        $query = $this->db->prepare('DELETE FROM  marcas WHERE id = ?');
        $query->execute([$id]);
    }


}
