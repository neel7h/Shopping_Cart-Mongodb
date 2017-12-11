<?php require 'header.php' ?>
<?php
if (isset($_POST["register"])) {
    try {
        require_once 'db.php';

 $collection = $db->cart;
$collection2 = $db->products;
$collection3 = $db->orders;
	
$cursor = $collection->find(array('user' => new MongoDB\BSON\ObjectID($_SESSION["account"])));

foreach ($cursor as $doc){

	$cursor2 = $collection2->find(array('_id'=>new MongoDB\BSON\ObjectID($doc["prod_id"])));
	foreach ($cursor2 as $doc2){
		
		$product = array(
		'userid' => $_SESSION["account"],
            'username' => $_SESSION["name"],
            'title' => $doc2['title'],
            'pid' => $doc2['_id'],
            'price' => $doc2['price']
        );
		        $collection3->insertOne($product);

	}
	
        // a new pro
        // a new products collection object
        
}
		               $collection->deleteMany(array('user' => new MongoDB\BSON\ObjectID($_SESSION["account"])));

        // insert the array


        // close connection to MongoDB

    } catch (MongoConnectionException $e) {
        // if there was an error, we catch and display the problem here
        echo $e->getMessage();
    } catch (MongoException $e) {
        echo $e->getMessage();
    }
}
?>
	

<!-- //banner -->
<!-- check out -->
<div class="checkout">
	<div class="container">
		<h3>My Shopping Bag</h3>
		<div class="table-responsive checkout-right animated wow slideInUp" data-wow-delay=".5s">
			<table class="timetable_sub">
				<thead>
					<tr>
						<th>Remove</th>
						<th>Product</th>
						<th>Quantity</th>
						<th>Product Name</th>
						<th>Price</th>
					</tr>
				</thead>
				<?php
try {
		require_once 'db.php';

    // a new products collection object
   $collection = $db->cart;
$collection2 = $db->products;
	
		              
$cursor = $collection->find(array('user' => new MongoDB\BSON\ObjectID($_SESSION["account"])));

foreach ($cursor as $doc){

	$cursor2 = $collection2->find(array('_id'=>new MongoDB\BSON\ObjectID($doc["prod_id"])));
	foreach ($cursor2 as $doc2){

$i=1;

				echo'	<tr class="rem'.$i++.'">
						<td class="invert-closeb">
							<div class="rem">
								<div class="close1"> </div>
							</div>
							
						</td>
						<td class="invert-image"><a href="single.html"><img src="uploads/'.$doc2["image"].'" alt=" " class="img-responsive" /></a></td>
						<td class="invert">
							 <div class="quantity"> 
								<div class="quantity-select">                           
									<div class="entry value-minus">&nbsp;</div>
									<div class="entry value"><span>1</span></div>
									<div class="entry value-plus active">&nbsp;</div>
								</div>
							</div>
						</td>
						<td class="invert">'. $doc2['title'].' </td>
						<td class="invert">'.  $doc2['price'].'</td>
					</tr>
					
					
								<!--quantity-->
								
								<!--quantity-->
			';
		

}
}
}		catch (MongoConnectionException $e) {
    // if there was an error, we catch and display the problem here
    echo $e->getMessage();
} catch (MongoException $e) {
    echo $e->getMessage();
} ?></table>
		</div>
		<?php
try {
    // a new products collection object
   $collection = $db->cart;
$collection2 = $db->products;


    if (isset($_GET["search_cat"]) && isset($_GET["keyword"])) {
        $keyword = $_GET["keyword"];
        $value = $_GET["search_cat"];
        $query = array($value => array('$regex' => new MongoRegex("/$keyword/i")));
        $cursor = $collection->find($query);
    } else {


				}
    }

    // How many results found
    //$num_docs = $cursor->count();


catch (MongoConnectionException $e) {
    // if there was an error, we catch and display the problem here
    echo $e->getMessage();
} catch (MongoException $e) {
    echo $e->getMessage();
}


?>
<div style="margin-left:400px;" data-wow-delay=".5s">
                                                <form role="form" method="post" action="">

									 <input type="hidden" name="register" value="checkout">
				<input type="submit" name="" value="checkout">

									 </form>
				</div>
		<div class="checkout-left">	
						

				<div class="checkout-right-basket animated wow slideInRight" data-wow-delay=".5s">
					<a href="index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Back To Shopping</a>
				</div>
				<div class="checkout-left-basket animated wow slideInLeft" data-wow-delay=".5s">
					
				</div>
				<div class="clearfix"> </div>
			</div>
	</div>
</div>	
<!-- //check out -->
<!-- //product-nav -->
<?php require "footer.php"?>