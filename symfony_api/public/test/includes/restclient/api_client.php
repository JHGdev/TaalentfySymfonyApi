<?php 


	// CONFIGURACION DEL CLIENTE
	define('REST_SERVER_URL', 'http://localhost:8000/api/');
	define('USERS_ENDPOINT',  'users');
	define('OFFERS_ENDPOINT', 'offers');

	define('MASSIVE_UPLOAD_ENDPOINT', 'misc/upload');
	define('USER_OFFERS_ENDPOINT',    'misc/get_user_offers');
	define('OFFER_USERS_ENDPOINT',    'misc/get_offer_users');
	define('MUSERS_NOFFERS_ENDPOINT', 'misc/get_Musers_Noffers');
	define('MOFFERS_NUSERS_ENDPOINT', 'misc/get_Moffers_Nusers');
	

	require_once( __DIR__ . "/restclient.php");

	// echo "<pre>";
		// $user = [
		// 	"email"=>"prueba3@nomail.com",
		// 	"firstname"=>"Jose",
		// 	"lastname"=>"Hervas",
		// 	"birth_date"=> 406771200
		// ];
		// $user_form = [
		// 	"user_form"=> $user
		// ];
		// $resultado = restUsersPost($user_form);
		// var_dump(json_decode($resultado));

		// $offer = [
		// 	"title"=>"Titulo de oferta",
		// 	"description"=>"Descripcion",
		// 	"incorporation_date"=>406771200,
		// 	"status"=> 1
		// ];
		// $offer_form = [
		// 	"offer_form"=> $offer
		// ];
		// $resultado = restOffersPost($offer_form);
		// var_dump(json_decode($resultado));

		// $massive_upload_data = [
		// 	"users"  => array($user),
		// 	"offers" => array($offer)
		// ];
		// $resultado = restMasiveUploadPost($massive_upload_data);
		// var_dump($resultado);

		// $query_data = [
		// 	"email"		=> "prueba2@nomail.com",
		// 	"n_offers"	=> 10
		// ];
		// $resultado = getUserOffersPost($query_data);
		// var_dump($resultado);

		// $query_data = [
		// 	"title"		=> "Oferta 1",
		// 	"n_users"	=> 10
		// ];
		// $resultado = getOfferUsersPost($query_data);
		// var_dump($resultado);

		
		// $query_data = [
		// 	"users" => [
		// 		"prueba2"
		// 	],
		// 	"n_offers" => 10
		// ];
		// $resultado = getMUsersNOffersPost($query_data);
		// var_dump($resultado);

		
		// $query_data = [
		// 	"offers" => [
		// 		"Oferta 1"
		// 	],
		// 	"n_users" => 10
		// ];
		// $resultado = getMOffersNusersPost($query_data);
		// var_dump($resultado);
	// echo "</pre>";

	

	function restUsersGet(){ 
		$usuarios = restCall(USERS_ENDPOINT, "get");
		return $usuarios;
	}



	function restOffersGet(){ 
		$usuarios = restCall(OFFERS_ENDPOINT, "get");
		return $usuarios;
	}



	function restUsersPost($user){ 
		$user_data = [ "user_form" => $user ];
		$resultado = restPost(USERS_ENDPOINT, $user_data);
		return $resultado;
	}



	function restOffersPost($offer){ 
		$offer_data = [ "offer_form" => $offer ];
		$resultado = restPost(OFFERS_ENDPOINT, $offer_data);
		return $resultado;
	}



	function restMasiveUploadPost($import_data){ 
		$resultado = restPost(MASSIVE_UPLOAD_ENDPOINT, $import_data);
		return $resultado;
	}


/*
{
    "email":"prueba2@nomail.com",
    "n_offers":10
}
*/
	function getUserOffersPost($query_data){
		$resultado = restPost(USER_OFFERS_ENDPOINT, $query_data);
		return $resultado;
	}



/*
{
    "title":"prueba2@nomail.com",
    "n_users":10
}
*/
	function getOfferUsersPost($query_data){
		$resultado = restPost(OFFER_USERS_ENDPOINT, $query_data);
		return $resultado;
	}



	/*
	{
    "offers":[
        "titulo",
        "pepito"
    ],
    "n_users":10
	}
	*/
	function getMOffersNUsersPost($query_data){
		$resultado = restPost(MOFFERS_NUSERS_ENDPOINT, $query_data);
		return $resultado;
	}



	/*
	{
		"users":[
			"prueba2@nomail.com",
			"pepito"
		],
		"n_offers":10
	}
	*/
	function getMUsersNOffersPost($query_data){
		$resultado = restPost(MUSERS_NOFFERS_ENDPOINT, $query_data);
		return $resultado;
	}



	function restPost($endpoint, $data){ 

		$resultado = restCall($endpoint, "post", $data);
		return $resultado;
	}


	function restCall($endpoint, $method, $params = array()){

		// Cliente REST
		$REST = new RestClient([
		    'base_url' 	=> REST_SERVER_URL
		]);
		
		// Operaciones con el cliente
		$result = $REST->$method($endpoint, $params);

		return json_decode($result->response);
	}
	

/*
	function restFunctionCall($method, $endpoint, $call){

		// Cliente REST
		$REST = new RestClient([
		    'base_url' 	=> SERVER_URL_USER, 
		    'format'	=> FORMAT, 
		]);
		
		// Operaciones con el cliente
		$usuario 		= $REST->get(USER_FUNCTION_NAME, array('username' => $user_id));
		$resultado_xml 	= htmlspecialchars_decode($usuario->response);
		$resultado_xml  = str_replace("&", "&amp;", $resultado_xml);

		$xml 			= new SimpleXMLElement($resultado_xml);


		if(isset($xml->ERRORCODE)){
			return false;
			throw new Exception($xml->MESSAGE);
		}else
			// Devolvemos los datos del curso
			return $xml->SINGLE->KEY->VALUE;

	}

*/
	
?>