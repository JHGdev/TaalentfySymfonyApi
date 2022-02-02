# TaalentfySymfonyApi
Servidor REST en symfony


# con Docker
Se puede crear una configuracion propia para el docker renombrando el archivo .docker/.env.dev a .docker/.env, 
en caso contrario se usara la configuracion del archivo .docker/.env.dev

Ejecutar: 
    make create-docker


# Instalacion de symfony y base de datos
Si no se ejecuta mediante el docker hay que modificar el siguiente archivo para configurar la conexion con la base de datos
    symfony_api/.env

Ejecutar:
    make install

