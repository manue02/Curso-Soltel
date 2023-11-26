---
title: Documentación Django
created: "2023-11-14T09:26:45.100Z"
modified: "2023-11-21T13:20:29.033Z"
---

# Documentación Django (Phyton)

[//]: # "version: 1.0"
[//]: # "author: Manuel Ibáñez"
[//]: # "date: 2020-10-10"

# Tabla de contenidos

- [Documentación Django (Phyton)](#documentación-django-phyton)
- [Tabla de contenidos](#tabla-de-contenidos)
  - [Introducción](#introducción)
  - [Instalación en Linux](#instalación-en-linux)
    - [Explicación de los comandos](#explicación-de-los-comandos)

<div style="page-break-after: always;"></div>

## Introducción

[Tabla de contenidos](#tabla-de-contenidos)

[Django](https://www.djangoproject.com/) es un framework web de alto nivel de desarrollo web de código abierto, escrito en Python, que respeta el patrón de diseño conocido como modelo–vista–controlador (MVC).

El modelo-vista-controlador es un patrón de arquitectura de software, que separa los datos y la lógica de negocio de una aplicación de su representación y el módulo encargado de gestionar los eventos y las comunicaciones.

- **Modelo**: Es la representación de la información con la cual el sistema opera, por lo tanto gestiona todos los accesos a dicha información, tanto consultas como actualizaciones, implementando también los privilegios de acceso que se hayan descrito en las especificaciones de la aplicación (lógica de negocio).
- **Vista**: Presenta el modelo en un formato adecuado para interactuar (usualmente la interfaz de usuario) y también puede encargarse de filtrar la entrada de datos y enviarla al modelo.
- **Controlador**: Responde a eventos (usualmente acciones del usuario) e invoca peticiones al modelo cuando se hace alguna solicitud de información (por ejemplo, editar un documento o un registro en una base de datos).

## Instalación en Linux

[Tabla de contenidos](#tabla-de-contenidos)

Python viene instalado por defecto en la mayoría de distribuciones GNU/Linux. Para comprobar si lo tenemos instalado, abrimos una terminal y escribimos:

```console

 python3 --version

```

En el caso de que no lo tengamos instalado, podemos instalarlo desde los repositorios oficiales de nuestra distribución. En el caso de Ubuntu, escribimos:

```console

 sudo apt install python3

```

Una vez verificado que tenemos instalado Python podemos empezar a instalar Django primero debemos instalar python3.10-venv para poder crear entornos virtuales. Para ello, escribimos:

```console

 sudo apt install python3.10-venv

```

Una vez instalado, creamos un entorno virtual llamado django y lo activamos:

```console

 $ python3 -m venv django
 $ source django/bin/activate
 (django)$ pip install django
 (django)$ python -m django --version
 4.2.7

```

### Explicación de los comandos

- **python3 -m venv django**: Creamos un entorno virtual llamado django.
- **source django/bin/activate**: Activamos el entorno virtual esto hay que hacerlo cada vez que queramos trabajar con Django.
- **pip install django**: Instalamos Django.
- **python -m django --version**: Comprobamos la versión de Django instalada.

Si en la terminal nos aparece (django) delante del nombre de nuestro usuario, significa que el entorno virtual está activado. En caso contrario, debemos activarlo con el comando source django/bin/activate. Para desactivar el entorno virtual, escribimos deactivate.
