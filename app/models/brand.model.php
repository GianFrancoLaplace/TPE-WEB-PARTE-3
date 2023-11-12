<?php 
include_once 'app/controllers/product.api.controller.php';

class BrandModel{ //modelo tabla marca
    private $db;
    function __construct(){
        $this->db = $this->getConnection();     
    }

    function getConnection(){
        return new PDO('mysql:host=localhost;'
        .'dbname=gimnasio;charset=utf8'
        , 'root', '');
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
