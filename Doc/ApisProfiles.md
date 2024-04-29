
### Consultar Lista de Perfiles

URL: localhost/template-back/apis/backend/admin/rol/list

Envío de datos

{
    "limite": 0,
    "regIni": 0,
    "regFin": 10,
    "filtroB": ""
}

Retorno de datos
{
    "done": true,
    "msg": "Lista consultada correctamente",
    "rows": [
        {
            "id_usuario": "1",
            "usuario": "turing",
            "nombre": "Super Administrador",
            "correo": null,
            "activo": "1",
            "admin": "1"
        }
    ],
    "count": 1
}

### Insertar / Actulizar Perfiles
URL: localhost/template-back/apis/backend/admin/rol/insertupdate

# Para insertar un nuevo registro iTipo = 0, para actualizar id_update = al id a actualizar y iTipo en 1

Envío de datos

{
    "iTipo": 0,
    "id_update": 2,
    "id_rol": 3,
    "usuario": "Ejemplo",
    "clave": "cadenaMD%oelegirsisehaceenelback",
    "nombre": "Jesús Ejemplo",
    "apepa": "Ejemplo",
    "apema": "Apema ejemplo",
    "correo": "correo@ejemplo.com",
    "sexo": "1",
    "admin": 0
}


Retorno de datos

{
    "done": true,
    "msg": "Registro ingresado correctamente",
    "id": 1
}

### Eliminar / Actualizar Perfiles
URL: localhost/template-back/apis/backend/admin/rol/delete

# Para baja iTipo = 0, alta iTipo = 1, eliminar iTipo = 3

Envio de datos
{
    "iTipo": 1,
    "id_delete": 4 
}

Retorno de datos
{
    "done": 1,
    "msg": "Cambios realizados correctamente"
}

###  Consultar datos por id
URL: http://localhost/template-back/apis/backend/admin/rol/show

Envío de datos 

{
    "idShow": 1
}

Retorno de datos

{
    "done": true,
    "msg": "Registros consultados correctamente",
    "rows": {
        "id_usuario": "1",
        "id_rol": "0",
        "usuario": "turing",
        "sexo": "1",
        "nombre": "Super",
        "apepa": "Administrador",
        "apema": null,
        "correo": null,
        "img": "avatar5.png",
        "admin": "1",
        "activo": "1"
    }
}

