# TPE-WEB-PARTE-3
Gian Franco Laplace Schwindt y Joaquin Block.

# ENDPOINTS-PRODUCTOS:
GET  | http://localhost/TPE-WEB-PARTE-3/api/productos 

  - Servicio que obtiene una coleccion entera la cual se puede:
    - paginar.
        Ejemplo: api/productos?pagina=1&elementosPorPagina=20
    - filtrarse por alguno de sus campos.
        Ejemplo: api/productos?categoria=creatina
    - ordenarse por cualquiera de los campos de la tabla de manera ascendente o descendente.
        Ejemplo: api/productos?orden=precio.desc

GET | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - Servicio que obtiene uno de los productos con el id indicado;
  - Ejemplo: api/productos/3

GET | http://localhost/TPE-WEB-PARTE-3/api/user/:token

  - Servicio que se usa para que un usuario obtenga un token de validación  para acceder a los servicios deseados que requieren autenticación.
  - Ejemplo: api/user/1
  - Usar consulta GET -- authorization -- Basic Auth -> username:webadmin password:admin 

POST  | http://localhost/TPE-WEB-PARTE-3/api/productos/
  - Se precisa el token para acceder al servicio, se verifica con:
  - consulta POST -- authorization -- Bearer Auth -> token: (lo que da el get api/user/:token)
    
  - Ejemplo: api/productos
  - Servicio que se usa para crear un producto con los siguientes parametros por body formato raw:

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

  - Se precisa el token para acceder al servicio, se verifica con:
  - consulta POST -- authorization -- Bearer Auth -> token: (lo que da el get api/user/:token)
  - Servicio que permite actualizar el precio con los siguientes parametros por body formato raw:
    `{
      "price": 00
    }`
  
DELETE | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - Servicio que su usa para eliminar el producto con el id indicado
  -Ejemplo: api/productos/4

# ENDPOINTS-RESENIAS:
GET  | http://localhost/TPE-WEB-PARTE-3/api/resenias 

  - Servicio que obtiene una coleccion entera la cual se puede:
    - paginar.
        Ejemplo: api/resenias?pagina=1&elementosPorPagina=20
    - filtrarse por alguno de sus campos.
        Ejemplo: api/resenias?ponderancia=3
    - ordenarse por cualquiera de los campos de la tabla de manera ascendente o descendente.
        Ejemplo: api/resenias?orden=asc  
        Ordena por ponderancia

GET | http://localhost/TPE-WEB-PARTE-3/api/resenias/ID

  - Servicio que obtiene uno de las resenias con el id indicado;
  - Ejemplo: api/resenias/3

GET | http://localhost/TPE-WEB-PARTE-3/api/user/:token

  - Servicio que se usa para que un usuario obtenga un token de validación  para acceder a los servicios deseados que requieren autenticación.
  - Ejemplo: api/user/1

POST  | http://localhost/TPE-WEB-PARTE-3/api/productos
    
  - Ejemplo: api/productos
  - Servicio que se usa para crear un producto con los siguientes parametros por body formato raw:

     `{
      "pond": 3,
      "des": "Descripción del Producto",
      "id_producto": 2,
      }`
  
DELETE | http://localhost/TPE-WEB-PARTE-3/api/productos/ID

  - Servicio que su usa para eliminar el producto con el id indicado
  -Ejemplo: api/productos/3