<?php
require_once('../init.php');
require('../../vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client();


$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/albums'
);

$body = $response->getBody(); //object
$string = $body->getContents(); //string
$json = json_decode($string); //array

// Populating the DB with all 100 wishlists available
for ($i = 0; $i < 100; $i++) {

    $wishlist = new Wishlist($db);

    $wishlist->id = $json[$i]->id;
    $wishlist->title = $json[$i]->title;
    $wishlist->cust_id = $json[$i]->userId;

    if ($wishlist->insert_record()) {
        echo json_encode(
            array('message' => "{$json[$i]->id} - New wishlist is added!")
        );
    } else {
        echo json_encode(
            array('message' => 'Something went wrong unexpectedly!')
        );
    }
}
