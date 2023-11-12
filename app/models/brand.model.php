<?php 
include_once './config.php';
include_once 'app/controllers/product.controller.php';

class BrandModel{ //modelo tabla marca
    private $db;
    function __construct(){
        $this->db = $this->getConnection();     
    }

    function getConnection(){
        return new PDO('mysql:host=' . DB_HOST .';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
    }
    //listado de todo
    function getAll(){ 

        $query = $this->db -> prepare('SELECT * from marcas');
        $query -> execute();
    
        $marcas = $query -> fetchAll(PDO::FETCH_OBJ);
    
        return $marcas;
    }

    function getNombreMarca($nombreMarca) {
        $query = $this->db->prepare('SELECT ID, Nombre FROM marcas WHERE Nombre = ?');
        
        $query->execute([$nombreMarca]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function getPaisOrigen($paisOrigen) {
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
