<?php
require('../private/init.php');

$parser = new ParseCSV('wishlist-data.csv');
$result = $parser->parse();

var_dump($result);
