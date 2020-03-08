<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../../private/init.php');

$product = new Prodcut($db);

$product->read_single($_GET['id']);

$prod_arr = array(
    'id' => $product->id,
    'prod_name' => $product->prod_name,
    'prod_descr' => $product->prod_descr,
    'prod_price' => $product->prod_price,
);

echo json_encode($prod_arr);
