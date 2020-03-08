<?php
require_once('../init.php');
require('../../vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client();


$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts'
);

$body = $response->getBody(); //object
$string = $body->getContents(); //string
$json = json_decode($string); //array

// populating the DB with 70 products
for ($i = 0; $i < 70; $i++) {

    $product = new Prodcut($db);

    $product->id = $json[$i]->id;
    $product->prod_name = $json[$i]->title;
    $product->prod_descr = $json[$i]->body;
    // $product->prod_price = NULL;


    if ($product->insert_record()) {
        echo json_encode(
            array('message' => "{$json[$i]->id} - New product is added!")
        );
    } else {
        echo json_encode(
            array('message' => 'Something went wrong unexpectedly!')
        );
    }
}
