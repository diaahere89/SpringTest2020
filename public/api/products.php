<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

require_once('../../private/init.php');

$product = new Prodcut($db);
$results = $product->read_all();


while ($row = mysqli_fetch_assoc($results)) {
    $array[] = $row;
}

echo json_encode($array);
