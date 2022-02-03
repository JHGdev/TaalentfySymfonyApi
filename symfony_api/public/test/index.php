<?php


// Estas variable limita la cantidad de valores posibles que pueden tomar estos campos para que haya coincidencias entre ofertas y usuarios
// Los campos introducidos User.email y Offer.title se almacenan en un array para poder reallizar consultas sobre ofertas y usuarios existentes
define('VALORES_DIFERENTES_SECTOR_LABORAL', 5);
define('VALORES_DIFERENTES_CONOCIMIENTOS',  10);

define('USUARIOS_A_INSERTAR', 100);
define('OFERTAS_A_INSERTAR',  150);


// Valores usados para lla cantidad de usuarios/ofertas devueltos en las llamadas
define('NUMERO_DE_USUARIOS', 15);
define('NUMERO_DE_OFERTAS',  15);



require_once __DIR__ . "/includes/functions.php";


echo "<pre>";

// No se comprueba el numero real de usuarios insertados en el mensaje devuelto
// * Podria darse el caso de usuarios con mail repetidos u ofertas con titulo repetido
createNusers(USUARIOS_A_INSERTAR);
    echo "Se han insertado ". USUARIOS_A_INSERTAR ." usuarios.<br>";

createNOffers(OFERTAS_A_INSERTAR);
    echo "Se han insertado ". OFERTAS_A_INSERTAR ." ofertas.<br>";

echo "<hr>";


// Obtiene hasta NUMERO_DE_OFERTAS ofertas de un usuario aleatorio
echo "<br><br><h5> Recomendaciones de Ofertas para usuario</h5>";
$resultado = getUserOffers(NUMERO_DE_OFERTAS);
var_dump($resultado);


// Obtiene hasta NUMERO_DE_USUARIOS usuarios de una oferta aleatoria
echo "<h5> Recomendaciones de Usuarios para Ofertas</h5>";
$resultado = getOfferUsers(NUMERO_DE_USUARIOS);
var_dump($resultado);


// Obtiene hasta NUMERO_DE_USUARIOS usuarios para NUMERO_DE_OFERTAS aleatorias
echo "<h5> Recomendaciones de N Usuarios para M Ofertas</h5>";
$resultado = getMOfferNUsers(NUMERO_DE_OFERTAS, NUMERO_DE_USUARIOS);
var_dump($resultado);


// Obtiene hasta NUMERO_DE_OFERTAS ofertas para NUMERO_DE_USUARIOS usuarios aleatorios
echo "<h5> Recomendaciones de N Ofertas para M Usuarios</h5>";
$resultado = getMUsersNOffers(NUMERO_DE_USUARIOS, NUMERO_DE_OFERTAS);
var_dump($resultado);


