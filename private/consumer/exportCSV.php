<?php
// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=wishlist-data.csv');

require_once('../init.php');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Customer ID', 'Customer fullname', 'Customer username', 'Wishlist title', 'Items listed'));


// fetching the data
$sql = "SELECT customers.id AS 'Customer ID', customers.fullname ";
$sql .= "AS 'Customer fullname', customers.username AS 'Customer username',";
$sql .= " subq.wtitle AS 'Wishlist title', subq.items AS 'Items listed'FROM";
$sql .= " customers LEFT JOIN (SELECT wishproducts.wish_id AS wid, wishlists.";
$sql .= "cust_id AS cid, wishlists.title AS wtitle, COUNT(*) AS items FROM ";
$sql .= "wishproducts LEFT JOIN wishlists ON wishproducts.wish_id = wishlists.id";
$sql .= " GROUP BY wishproducts.wish_id ORDER BY wishproducts.wish_id) AS subq ";
$sql .= "ON customers.id = subq.cid GROUP BY subq.wid ORDER BY customers.fullname;";

$result = mysqli_query($db, $sql);

// loop over the rows, outputting them
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, $row);
}
