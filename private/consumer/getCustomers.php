<?php
require_once('../init.php');
require('../../vendor/autoload.php');

use GuzzleHttp\Client;

$client = new Client();


$response = $client->request(
    'GET',
    'http://jsonplaceholder.typicode.com/users'
);

$body = $response->getBody(); //object
$string = $body->getContents(); //string
$json = json_decode($string); //array

// Populating the DB with all 10 customers available
for ($i = 0; $i < 10; $i++) {

    $customer = new Customer($db);

    $customer->id = $json[$i]->id;
    $customer->fullname = $json[$i]->name;
    $customer->username = $json[$i]->username;
    $customer->email = $json[$i]->email;
    $customer->phone = $json[$i]->phone;
    $customer->website = $json[$i]->website;

    if ($customer->insert_record()) {
        echo json_encode(
            array('message' => "{$json[$i]->id} - New customer is added!")
        );
    } else {
        echo json_encode(
            array('message' => 'Something went wrong unexpectedly!')
        );
    }
}
