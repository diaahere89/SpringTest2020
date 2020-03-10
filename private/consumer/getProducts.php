<?php
require_once('../init.php');
require('../../vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client();

global $db;

$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/posts'
);

$body = $response->getBody(); //object
$string = $body->getContents(); //string
$json = json_decode($string); //array


foreach ($json as $row_arr) {
    echo "ID: {$row_arr->id} <br />- Prod. name: {$row_arr->title} <br />- Prod. description: {$row_arr->body} <br /><hr /> \r\n";
}
// populating the DB with 70 products
// for ($i = 0; $i < 70; $i++) {

//     $product = new Prodcut($db);

//     $product->id = $json[$i]->id;
//     $product->prod_name = $json[$i]->title;
//     $product->prod_descr = $json[$i]->body;
//     // $product->prod_price = NULL;


//     if ($product->insert_record()) {
//         echo json_encode(
//             array('message' => "{$json[$i]->id} - New product is added!")
//         );
//     } else {
//         echo json_encode(
//             array('message' => 'Something went wrong unexpectedly!')
//         );
//     }
// }
