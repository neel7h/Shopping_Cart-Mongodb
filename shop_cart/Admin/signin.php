<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();

if (isset($_POST["login"])) {

    try {
require '../../vendor/autoload.php';
$conn = new MongoDB\Client("mongodb://localhost:27017");

$db = $conn->shopping;
        $username = (isset($_POST["username"]) ? $_POST["username"] : $username = null);
        $password = (isset($_POST["password"]) ? $_POST["password"] : $password = null);

        $collection = $db->admin;
        $login = $collection->findOne(array("username" => $username, "password" => $password));
        if ($login) {
						header("location:college.php");
            $_SESSION["account"] = $login['_id'];
        } else {
            $_SESSION["account"] = null;
        }

    } catch (MongoConnectionException $e) {
        // if there was an error, we catch and display the problem here
        echo $e->getMessage();
    } catch (MongoException $e) {
        echo $e->getMessage();
    }
}

if (isset($_GET["logout"])) {
    session_destroy();
    header("Location:signin.php");
}

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Pooled Admin Panel Category Flat Bootstrap Responsive Web Template | Sign In :: w3layouts</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="css/morris.css" type="text/css"/>
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/jquery-ui.css"> 
<!-- jQuery -->
<script src="js/jquery-2.1.4.min.js"></script>
<!-- //jQuery -->
<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'/>
<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
</head> 
<body>
	<div class="main-wthree">
	<div class="container">
	<div class="sin-w3-agile">
		<h2>Sign In</h2>
							<?php 
														if(isset($_SESSION['account'])){ ?>
												<div class=""> Already Logged In &nbsp; &nbsp; &nbsp; &nbsp; <a style="color:black" href="index.php"> Go to Admin Panel  </a> &nbsp; &nbsp; &nbsp; &nbsp; <a style="color:black "href=?logout=yes>  Logout </a>   </div>
								<?php 
														} else { ?>
		<form role="form" method="post">
            <div class="form-group">
                <label for="email">Username:</label>
                <input required name="username" type="text" class="form-control" id="email" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="email">Password:</label>
                <input required name="password" type="password" class="form-control" id="email"
                       placeholder="Password"></input>
            </div>
            <input type="hidden" name="login" value="login">
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
			<?php } ?>
				<div class="back">
					<a href="../index.php">Back to home</a>
				</div>
				<div class="footer">
					<p>&copy; 2016 Pooled . All Rights Reserved | Design by </p>
				</div>
	</div>
	</div>
	</div>
</body>
</html>