<?php
// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Acces-Control-Allow-Headers: Acces-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once('../../private/init.php');

$wishlist = new Wishlist($db);

// $wishlist->id = $_GET['id']; // auto_increment
$wishlist->title = $_GET['title']; // given by the client
$wishlist->cust_id = $_GET['cust_id']; // should be stored in a session


if ($wishproduct->insert_record()) {
    echo json_encode(
        array('message' => "Random combination is added!")
    );
} else {
    echo json_encode(
        array('message' => 'Something went wrong unexpectedly!')
    );
}
