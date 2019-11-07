## 🤓 API-Laravel-example

En este proyecto se desarrolló una [API](https://www.redhat.com/es/topics/api/what-are-application-programming-interfaces) que cuenta un sistema básico de roles y se puede gestionar todo el (CRUD) de departamentos.

### 📜 Características
Contamos con los siguientes ***modelos*** principales
* Roles
* Usuarios
* Departamentos

Cada uno tiene una ***migración*** que se encarga de generar una tabla en la base de datos, además tiene su debido ***controlador*** intermediario que recibe las peticiones y retorna respuesta de tipo [JSON](https://developer.mozilla.org/es/docs/Learn/JavaScript/Objects/JSON).

Cree tres ***middlwares***, dos de ellos se encargan de la seguridad del sistema y otro es una implementación básica de [CORS](https://developer.mozilla.org/es/docs/Web/HTTP/Access_control_CORS).

* 🔒 isAuthenticated – Verifica si el token recibido es válido, además si pertenece a un usuario registrado.
* 🔒 isAdmin – Verifica si el usuario tiene el rol administrador en el sistema.
* 🌎 Cors – Es un mecanismo en los headers que permite que se puedan solicitar recursos desde otros dominós o host. (Para que terceros puedan interactuar con la API).

### 📌 Rutas
![Route-list](public/imgs/routes.png)

``` 
    Las rutas que tienen implementado el [middlware isAuthenticated] requieren que se les envié un parámetro por el método GET llamado [token] el cual debe tener asignado el valor que genera la ruta [login]; luego de su correspondiente registro en la ruta [register].
 ```
## License 🔥
Copyright © 2019-present [Oscar Amado](https://github.com/ofaaoficial) 🧔
