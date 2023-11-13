# TPE-WEB-PARTE-3
Gian Franco Laplace Schwindt y Joaquin Block.

# ENDPOINTS:
GET  | http://localhost/TPE-WEB-PARTE-3/api/productos 
  - Devuelve todos los productos.
POST  | http://localhost/TPE-WEB-PARTE-3/api/productos/
  Crear un producto con los siguientes parametros
  {
  "name": "Nombre del Producto",
  "des": "Descripción del Producto",
  "price": 00,
  "weight": 0.0,
  "category": "categoria",
  "brand": "Marca",
  "img": "imagen.jpg"
  }
  
GET | http://localhost/TPE-WEB-PARTE-3/api/productos/ID
  obtiene uno de los productos con el id indicado;
  
PUT | http://localhost/TPE-WEB-PARTE-3/api/productos/ID
  Permite actualizar el precio;
  {
  "price": 00
  }
  
DELETE | http://localhost/TPE-WEB-PARTE-3/api/productos/ID
  Elimina el producto con el id indicado
  
GET | http://localhost/TPE-WEB-PARTE-3/api/user/:token
  Se usa para que un usuario tenga un token con el metodo de autenticación para acceder a los servicios deseados
  
  
