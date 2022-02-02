# TaalentfySymfonyApi
Servidor REST en symfony


# con Docker
Renombrar el archivo .docker/.env.dev a .docker/.env
Ejecutar: 
    make create-docker


# Instalacion de symfony y base de datos
Si no se ejecuta mediante el docker hay que modificar el siguiente archivo para configurar la conexion con la base de datos
    symfony_api/.env

Ejecutar:
    make install

