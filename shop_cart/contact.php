<?php require 'header.php';
 if (isset($_POST["submit"])) 
	 {
		 $collection = $db->complaint;
		try {
		$name = (isset($_POST["name"]) ? $_POST["name"] : $title = '0');
        $email = (isset($_POST["email"]) ? $_POST["email"] : $title = '0');
        $query = (isset($_POST["query"]) ? $_POST["query"] : $description = '0');

        $complaint = array(
			'name'=> $name,
            'email' => $email,
            'query' => $query,
        );

        // insert the array
        $collection->insertOne($complaint);
} catch (MongoConnectionException $e) {
        // if there was an error, we catch and display the problem here
        echo $e->getMessage();
    } catch (MongoException $e) {
        echo $e->getMessage();
    }
	}
	 ?>
	<div class="contact">
		<div class="container">
			<div class="contact-grids">
				<div class="col-md-4 contact-grid text-center animated wow slideInLeft" data-wow-delay=".5s">
					<div class="contact-grid1">
						<i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>
						<h4>Address</h4>
						<p>12K Street, 45 Building Road <span>New York City.</span></p>
					</div>
				</div>
				<div class="col-md-4 contact-grid text-center animated wow slideInUp" data-wow-delay=".5s">
					<div class="contact-grid2">
						<i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>
						<h4>Call Us</h4>
						<p>+1234 758 839<span>+1273 748 730</span></p>
					</div>
				</div>
				<div class="col-md-4 contact-grid text-center animated wow slideInRight" data-wow-delay=".5s">
					<div class="contact-grid3">
						<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
						<h4>Email</h4>
						<p><a href="mailto:info@example.com">info@example1.com</a><span><a href="mailto:info@example.com">info@example2.com</a></span></p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<br><br><br>
			<h3 class="tittle">Contact Form</h3>
			<form method="POST" action="">
				<div class="contact-form2">
					<input name="name" type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
					<input name="email" type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<textarea name= "query" type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
					<input name="submit" type="submit" value="Submit" >
				</div>
			</form>
		</div>
	</div>
	
<!-- //contact -->

<!-- //product-nav -->
<?php require "footer.php"?>