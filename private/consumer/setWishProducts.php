<?php
require_once('../init.php');

for ($i = 0; $i < 300; $i++) {

    $wishproduct = new WishProduct($db);

    $wishproduct->wish_id = rand(1, 100);
    $wishproduct->prod_id = rand(1, 70);

    if ($wishproduct->insert_record()) {
        echo json_encode(
            array('message' => "Random combination is added!")
        );
    } else {
        echo json_encode(
            array('message' => 'Something went wrong unexpectedly!')
        );
    }
}
