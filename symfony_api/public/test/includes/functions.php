<?php

require_once __DIR__ . "/fakedata/fakeData.php";
require_once __DIR__ . "/restclient/api_client.php";



function createNusers($n_users){

    $users = [];
    for($i=0; $i<$n_users; $i++){
        $user    = createFakeUser();
        $users[] = restUsersPost($user);
    }

    return $users;
}


function createNOffers($n_offers){

    $offers = [];
    for($i=0; $i < $n_offers; $i++){
        $offer    = createFakeOffer();
        $offers[] = restOffersPost($offer);
    }

    return $offers;
}


function getUserOffers($n_offers){

    $query_data = createFakeUserOffersRequest($n_offers);

    $offers['user']   = $query_data['email'];
    $offers['offers'] = getUserOffersPost($query_data);

    return $offers;
}


function getOfferUsers($n_users){

    $query_data = createFakeOfferUsersRequest($n_users);
    $users['title'] = $query_data['title'];
    $users['users'] = getOfferUsersPost($query_data);
    return $users;
}


function getMOfferNUsers($m_offers, $n_users){

    $query_data = createFakeMOffersNUsersRequest($m_offers, $n_users);
    $result = getMOffersNUsersPost($query_data);
    return $result;
}


function getMUsersNOffers($m_users, $n_offers){

    $query_data = createFakeMUsersNOffersRequest($m_users, $n_offers);
    $result = getMUsersNOffersPost($query_data);
    return $result;
}

?>