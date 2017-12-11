<?php
require '../vendor/autoload.php'; 
$m = new MongoDB\Client;
$db = $m->shopping;
$collection = $db->cart;
$collection2 = $db->products;

$cursor = $collection->find(array('user_id' => new MongoDB\BSON\ObjectID('5a11de40cc2a291560000cfa')));

foreach ($cursor as $doc){

	$cursor2 = $collection2->find(array('_id'=>new MongoDB\BSON\ObjectID($doc["prod_id"])));
	foreach ($cursor2 as $doc2){
echo $doc2['title'];
}
}

?>