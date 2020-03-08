<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../private/init.php');

$wishproduct = new WishProduct($db);

$wishproduct->wish_id = $_GET['wish_id']; //should be stored already by logged-in customer 
$wishproduct->prod_id = $_GET['prod_id']; //should be linked to the product being previewed 


if ($wishproduct->insert_record()) {
    echo json_encode(
        array('message' => "Random combination is added!")
    );
} else {
    echo json_encode(
        array('message' => 'Something went wrong unexpectedly!')
    );
}
