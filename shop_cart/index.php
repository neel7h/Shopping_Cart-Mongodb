<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php require 'header.php' ?>
<?php

if (isset($_POST["abc"])) {
	require_once 'db.php';

        // a new products collection object
        $collection = $db->cart;
 $prod_id = (isset($_POST["id"]) ? $_POST["id"] : $prod_id = null);
       $user_id = (isset($_SESSION["account"]) ? $_SESSION["account"] : $user_id = null);
  $cart = array(
            'prod_id' => $prod_id,
            'user' => $user_id
        );
		        $collection->insertOne($cart);
}	
?>
<div class="electronics" style="margin-top:-10%">
	<div class="container">
					<div class="ele-bottom-grid">
				<h3><span>Latest </span>Collections</h3>
				 <?php if (!isset($_GET["abc"])) { ?>
        <div id="products" class="row list-group">
            <?php
         
                // loop over the results
                foreach ($cursor as $obj) {
					if ($obj['category']=="laptop")
					{
                    ?>	<div class="col-md-3 product-men">
							<div class="men-pro-item simpleCart_shelfItem">
								<div class="men-thumb-item">
									<img src="uploads/<?php echo $obj['image']; ?>" alt="" width="200px" height="200px"class="pro-image-front">
									<img src="uploads/<?php echo $obj['image']; ?>" alt="" class="pro-image-back">
										<div class="men-cart-pro">
											<div class="inner-men-cart-pro">
												<a href="single.html" class="link-product-add-cart">Quick View</a>
											</div>
										</div>										
								</div>
								<div class="item-info-product ">
									<h4><a href="single.php?id=<?php echo $obj['_id']; ?>"><?php echo $obj['title']; ?></a></h4>
									<div class="info-product-price">
										<span class="item_price" >$ <?php echo $obj['price']; ?></span>
									</div>
									 <?php if (!isset($_SESSION["account"])) { ?>
									<a href="#" style="pointer-events: none;"class="item_add gray-btn single-item hvr-outline-out button2">Add to cart</a>									
                <?php }else {?>
				        <form role="form" method="post">
            <input type="hidden" name="abc" value="alpha">
            <input type="hidden" name="id" value="<?php echo $obj['_id']; ?>">

								<input type="submit" id="submit" class="item_add single-item hvr-outline-out button2" value="submit">				
				</form>
				<?php } ?>
								</div>
							</div>
						</div>
					


                    <?php
                }}
             


            ?>
        </div>

    <?php } 


            
        
    

    // close the connection to MongoDB
    ?>

						
			</div>
	</div>
</div>
<!-- //Electronics -->
<!-- //product-nav -->
<?php require "footer.php" ?>