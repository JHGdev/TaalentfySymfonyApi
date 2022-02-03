<?php

require_once __DIR__ . '/../vendor/autoload.php';


// Inicializa las globales usadas para poder crear relaciones entre usuarios y ofertas
createGlobals();


function createGlobals(){

    Global $faker, 
           $KNOWLEDGE_VALUES, 
           $LABORAL_SECTOR_VALUES,
           $USER_MAIL_VALUES,
           $OFFER_TITLES_VALUES;

    $faker = Faker\Factory::create();

    $USER_MAIL_VALUES = [];
    $OFFER_TITLES_VALUES = [];

    $LABORAL_SECTOR_VALUES = [];
    for($i = 0; $i < VALORES_DIFERENTES_SECTOR_LABORAL; $i++){
        $LABORAL_SECTOR_VALUES[] = $faker->catchPhrase;
    }

    $KNOWLEDGE_VALUES = [];
    for($i = 0; $i < VALORES_DIFERENTES_CONOCIMIENTOS; $i++){
        $KNOWLEDGE_VALUES[] = $faker->catchPhrase;
    }
}


function createFakeUser(){
    
    Global $faker, $LABORAL_SECTOR_VALUES, $KNOWLEDGE_VALUES, $USER_MAIL_VALUES;
    
    $date = new DateTime($faker->date($format = 'Y-m-d', $max = 'now') );

    $email = $faker->safeEmail;
    $USER_MAIL_VALUES[] = $email;

    $user  = [
        'email'      => $email,
        'firstname'  => $faker->firstName,
        'lastname'   => $faker->lastName,
        'birth_date' => $date->getTimestamp()
    ];

    if ($faker->biasedNumberBetween(0, 1))
        $user['laboral_sector'] = $LABORAL_SECTOR_VALUES[$faker->biasedNumberBetween(0, VALORES_DIFERENTES_SECTOR_LABORAL -1)];

    if($faker->biasedNumberBetween(0, 1)){
        $user['knowledge'] = [];
        for($i = 0; $i <= $faker->biasedNumberBetween(1, VALORES_DIFERENTES_CONOCIMIENTOS - 1); $i++){
            $valor = $KNOWLEDGE_VALUES[$faker->biasedNumberBetween(0, VALORES_DIFERENTES_CONOCIMIENTOS -1)];
            // Establecemos el id con el valor para que no se repitan
            $user['knowledge'][$valor] = $valor;
        }
    }

    if ($faker->biasedNumberBetween(0, 1))
        $user['user_answers_test_a'] = $faker->biasedNumberBetween(10, 100);

    if ($faker->biasedNumberBetween(0, 1))
        $user['user_answers_test_b'] = getTestBCritera();

    return $user;
}


function createFakeOffer(){
    
    Global $faker, $LABORAL_SECTOR_VALUES, $KNOWLEDGE_VALUES, $OFFER_TITLES_VALUES;
    
    $date  = new DateTime($faker->date($format = 'Y-m-d', $max = 'now') );

    $title = $faker->company;
    $OFFER_TITLES_VALUES[] = $title;

    $offer = [
        'title'              => $title,
        'description'        => $faker->text,
        'incorporation_date' => $date->getTimestamp(),
        'status'             => $faker->biasedNumberBetween(0, 1)
    ];

    $offer['laboral_sector'] = $LABORAL_SECTOR_VALUES[$faker->biasedNumberBetween(0, VALORES_DIFERENTES_SECTOR_LABORAL -1)];
    
    $offer['knowledge'] = [];
    $knowledge_count = $faker->biasedNumberBetween(3, 6);
    while(count($offer['knowledge']) != $knowledge_count){
        $valor = $KNOWLEDGE_VALUES[$faker->biasedNumberBetween(0, VALORES_DIFERENTES_CONOCIMIENTOS -1)];
        $offer['knowledge'][$valor] = $valor;
    }
    

    if ($faker->biasedNumberBetween(0, 1))
        $offer['test_a_criteria'] = $faker->biasedNumberBetween(10, 100);

    if ($faker->biasedNumberBetween(0, 1))
        $offer['test_b_criteria'] = getTestBCritera();


    return $offer;
}

  
function getTestBCritera(){

    Global $faker;

    $numbers   = [];
    $numbers[] = $faker->biasedNumberBetween(0, 100);
    $numbers[] = $faker->biasedNumberBetween(0, 100 - $numbers[0]);
    $numbers[] = 100 - $numbers[0] - $numbers[1];

    return $numbers;
}


function createFakeUserOffersRequest($n_offers){
    
    $user = getRandomUser();
        
    $fake_query = [
        "email"    => $user,
        "n_offers" => $n_offers
    ];

    return $fake_query;
}


function createFakeOfferUsersRequest($n_users){
    
    $title = getRandomOffer();
        
    $fake_query = [
        "title"   => $title,
        "n_users" => $n_users
    ];

    return $fake_query;
}


function createFakeMUsersNOffersRequest($m_users, $n_offers){
    
    $users = [];
    for($i = 0; $i < $m_users; $i++)
        $users[] = getRandomUser();
        
    $fake_query = [
        "users"    => $users,
        "n_offers" => $n_offers
    ];

    return $fake_query;
}


function createFakeMOffersNUsersRequest($m_offers, $n_users){
    
    $offers = [];
    for($i = 0; $i < $m_offers; $i++)
        $offers[] = getRandomOffer();
        
    $fake_query = [
        "offers"   => $offers,
        "n_users"  => $n_users
    ];

    return $fake_query;
}




function getRandomUser(){
    Global $faker, $USER_MAIL_VALUES;
    
    $users_max_index = count($USER_MAIL_VALUES) - 1;
    return $USER_MAIL_VALUES[$faker->biasedNumberBetween(0, $users_max_index)];
}



function getRandomOffer(){
    Global $faker, $OFFER_TITLES_VALUES;
    
    $offers_max_index = count($OFFER_TITLES_VALUES) - 1;
    return $OFFER_TITLES_VALUES[$faker->biasedNumberBetween(0, $offers_max_index)];
}
?>