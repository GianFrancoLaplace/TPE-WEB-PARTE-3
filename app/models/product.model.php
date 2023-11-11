<?php 
include_once 'app/controllers/product.controller.php';

class ProductModel{
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

        $query = $this->db -> prepare('SELECT * from productos');
        $query -> execute();
    
        $productos = $query -> fetchAll(PDO::FETCH_OBJ);
    
        return $productos;
    }
    function getPaisOrigen($paisOrigen){
        $query = $this->db->prepare('SELECT a.ID, a.Nombre, a.Precio, a.Img FROM productos a INNER JOIN marcas b ON a.ID_Marca = b.ID WHERE b.Pais_Origen = ?');
        $query->execute([$paisOrigen]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    //te muestra un registro solo, eso pasa cuando cliqueas en cada item
    function get($id){
        $query = $this->db->prepare('SELECT * FROM  productos WHERE Id= ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    //listado por nombre de la marca. Nose si se hace asi o con un id_Marca esta bien pero el tema es que tenes que saber el id de marcas. 
    function getMarca($idMarca) {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio, Img FROM productos WHERE ID_Marca = ?');
        
        $query->execute([$idMarca]);
        
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //listado por pais origen
    function getOrigen($idMarca){
        $query = $this->db -> prepare('SELECT ID, Nombre, Precio, Img FROM productos  WHERE ID_Marca = ? ');
        $query->execute([$idMarca]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    //listado si es crea o prote
    function getCategoria($categoria) {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio, Img FROM  productos WHERE Categoria = ?');
        $query->execute([$categoria]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //listado segun orden por precio asc
    function getPrecioAsc() {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio FROM productos ORDER BY Precio');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //listado segun orden precio desc
    function getPrecioDesc() {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio FROM productos ORDER BY Precio DESC');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //listado segun orden nombre asc
    function getNombreAsc() {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio FROM productos ORDER BY Nombre ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    //listado segun orden nombre desc
    function getNombreDesc() {
        $query = $this->db->prepare('SELECT ID, Nombre, Precio FROM productos ORDER BY Nombre DESC ');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    function updateNombre($id, $nuevoNombre) {
        $query = $this->db->prepare('UPDATE productos SET Nombre = ? WHERE id = ?');
        $query->execute([$nuevoNombre, $id]);
    }
    
    function updateDescripcion($id, $nuevaDescripcion) {
        $query = $this->db->prepare('UPDATE productos SET Descripcion = ? WHERE id = ?');
        $query->execute([$nuevaDescripcion, $id]);
    }
    
    function updatePrecio($id, $nuevoPrecio) {
        $query = $this->db->prepare('UPDATE productos SET Precio = ? WHERE id = ?');
        $query->execute([$nuevoPrecio, $id]);
    }

    function updatePeso($id, $nuevoPeso) {
        $query = $this->db->prepare('UPDATE productos SET Peso = ? WHERE id = ?');
        $query->execute([$nuevoPeso, $id]);
    }
    
    function updateCategoria($id, $nuevaCategoria) {
        $query = $this->db->prepare('UPDATE productos SET Categoria = ? WHERE id = ?');
        $query->execute([$nuevaCategoria, $id]);
    }
    
    function updateMarca($id, $nuevaMarca) {
        $query = $this->db->prepare('UPDATE productos SET ID_Marca = ? WHERE id = ?');
        $query->execute([$nuevaMarca, $id]);
    }

    function insert($name, $des, $price, $weight, $category, $brand, $img) {
    
        $query = $this->db->prepare('INSERT INTO productos (ID, Nombre, Descripcion, Precio , Peso ,Categoria, ID_Marca, Img) VALUES (?,?,?,?,?,?,?,?)');
        $query->execute([null, $name, $des, $price, $weight, $category, $brand, $img]);
    
        return $this->db->lastInsertId();
    }

    function remove($id){
        $query = $this->db -> prepare('DELETE FROM  productos WHERE id = ?');
        $query -> execute([$id]);
    }

    function update($id, $newPrice)
    {
        $query = $this->db->prepare('UPDATE productos SET Precio = ?,  WHERE id = ?');
        $query->execute([$newPrice, $id]);
    }
}

//todos los productos de origen Argentino 
//SELECT a.Nombre, a.Precio FROM productos a INNER JOIN marcas b ON a.ID_Marca = b.ID WHERE b.Pais_Origen = 'Argentina'

//todos los productos de origen EEUU
//SELECT a.Nombre, a.Precio FROM productos a INNER JOIN marcas b ON a.ID_Marca = b.ID WHERE b.Pais_Origen = 'Estados Unidos'

/* $query = $this->db->prepare('SELECT a.Nombre, a.Precio FROM productos a INNER JOIN marcas b ON a.ID_Marca = b.ID WHERE b.Nombre = ?'); */