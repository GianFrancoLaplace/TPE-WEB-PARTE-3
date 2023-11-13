# TPE-WEB-PARTE-3
Gian Franco Laplace Schwindt y Joaquin Block.

# ENDPOINTS:
GET  | http://localhost/TPE-WEB-PARTE-3/api/productos 

  - Servicio que obtiene una coleccion entera la cual se puede:
    - paginar.
        Ejemplo: api/productos?pagina=1&elementosPorPagina=20
    - filtrarse por alguno de sus campos.
        Ejemplo: api/productos?categoria=creatina
    - ordenarse por cualquiera de los campos de la tabla de manera ascendente o descendente.
        Ejemplo: api/productos?orden=precio.desc

GET | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - obtiene uno de los productos con el id indicado;

GET | http://localhost/TPE-WEB-PARTE-3/api/user/:token

  - Se usa para que un usuario obtenga un token de validación  para acceder a los servicios deseados que requieren autenticación.

POST  | http://localhost/TPE-WEB-PARTE-3/api/productos/
  - Crear un producto con los siguientes parametros

     `{
      "name": "Nombre del Producto",
      "des": "Descripción del Producto",
      "price": 00,
      "weight": 0.0,
      "category": "categoria",
      "brand": "Marca",
      "img": "imagen.jpg"
      }`
  
PUT | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - Permite actualizar el precio
    `{
      "price": 00
    }`
  
DELETE | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - Elimina el producto con el id indicado

