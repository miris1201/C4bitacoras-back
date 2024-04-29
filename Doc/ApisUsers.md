### Consultar Lista de Usuarios

URL: localhost/template-back/apis/admin/user/list

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

### Insertar / Actulizar Usuarios
URL: localhost/template-back/apis/admin/user/insertupdate

# Para insertar un nuevo registro iTipo = 0, para actualizar id_update = al id a actualizar y iTipo en 1

Envío de datos

{
    "id_update": 0,
    "nombre": "Jose de Jesus",
    "apepa": "Fonseca",
    "apema": "Sanchez",
    "usuario": "pruebauser12",
    "clave": "123456",
    "correo": "otrouser@hotmail.com",
    "sexo": "1",
    "id_rol": "10",
    "admin": "",
    "menu": [
        {
            "id_menu": "1",
            "texto": "Administrador",
            "value": 1,
            "isChecked": true,
            "_children": [
                {
                    "id_menu": "2",
                    "texto": "Usuarios",
                    "isChecked": true,
                    "value": 1,
                    "imp": "0",
                    "edit": "0",
                    "elim": "0",
                    "nuevo": "1",
                    "exportar": "0"
                },
                {
                    "id_menu": "3",
                    "texto": "Roles",
                    "isChecked": true,
                    "value": 1,
                    "imp": "0",
                    "edit": "0",
                    "elim": "0",
                    "nuevo": "1",
                    "exportar": "0"
                }
            ]
        },
        {
            "id_menu": "4",
            "texto": "Catálogos",
            "value": 0,
            "isChecked": false,
            "_children": [
                {
                    "id_menu": "5",
                    "texto": "Ejemplo",
                    "isChecked": false,
                    "value": 0,
                    "imp": 0,
                    "edit": 0,
                    "elim": 0,
                    "nuevo": 0,
                    "exportar": 0
                }
            ]
        }
    ]
}


Retorno de datos

{
    "done": true,
    "msg": "Registro ingresado correctamente",
    "id": 1
}

### Eliminar / Actualizar Usuarios
URL: localhost/template-back/apis/admin/user/delete

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
URL: http://localhost/template-back/apis/admin/user/show

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

