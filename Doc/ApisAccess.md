# Documentación APIS

###  Login

Method: POST

URL: http://localhost/template-back/apis/acceso

Envío de datos 

{
    "user": "turing",
    "password": "password"
}

Retorno de datos

{
    "respuesta": 1,
    "mensaje": "esValido",
    "rows": {
        "id_usuario": "1",
        "id_rol": "1",
        "usuario": "turing",
        "sexo": "1",
        "nombre": "Usuario",
        "apepa": "Administrador",
        "apema": " ",
        "correo": "dperez@inifed.gob.mx",
        "img": "avatar5.png",
        "admin": "0",
        "activo": "1"
    }
}

###  Token
URL: http://localhost/template-back/apis/token

Envío de datos 

{
    "x-token": "valordeltoken"
}

Retorno de datos

{
    "respuesta": 1,
    "mensaje": "esValido",
    "rows": {
        "id_usuario": "1",
        "id_rol": "1",
        "usuario": "turing",
        "sexo": "1",
        "nombre": "Usuario",
        "apepa": "Administrador",
        "apema": " ",
        "correo": "dperez@inifed.gob.mx",
        "img": "avatar5.png",
        "admin": "0",
        "activo": "1"
    }
}

### Consultar Menú

URL: http://localhost/template-back/apis/menu/list

Envío de datos:

{
    "id_rol": 1,
    "id_usuario": 1
}

Dependiendo del usuario y su perfil retorna la lista de menús a mostrar.

Respuesta con límite en 1:
{
    "respuesta": 1,
    "mensaje": "esValido",
    "menu": [
        {
            
        }
    ]
}