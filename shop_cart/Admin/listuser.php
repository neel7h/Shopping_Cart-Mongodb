	<?php
 include 'header.php';

?>
		<style>
input[type="submit"]{
background-color: transparent;
background-image: url(delete.png);
display: inline-block;
cursor: pointer;
width:20px;
height:20px;
  background-size: 20px;
  border:none;
      font-size: 0px;
}
</style>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
           
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <?php
 include 'menu.php';

?>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Front Image
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-table"></i> Frontpage Image
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
						
                                     <table class="table table-bordered table-hover table-striped">
                                <thead style="background: none repeat scroll 0% 0% rgb(231, 76, 60);
color: rgb(255, 255, 255);
text-transform: uppercase;">
                                    <tr>
                                       <th>ID</th>
							<th width="300px">Image</th>
							<th>Action</th>
							
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php



$sql="select * from frontimg ";
if ($result = $mysqli->query($sql)) {
if ($result->num_rows > 0) {
while($row = $result->fetch_array())
{
	$id=$row['id'];
	$name=$row['img'];
	
	
	
		

	echo "	<tr><td> $id</td><td > <img style='width:10%' src='".$name."'></td>
	<td> <form method='POST'> <input type='submit' id='delete' name='submit'  value='".$id."'> </form></td></tr>";


}
}
}
?>
                                </tbody>
                            </table>

</div>
</div>
   
                        </div>
                    </div>
                    
                    </div>
                   
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
 if(isset($_POST["submit"])){

$id = $_POST['submit'];

//$id=0;$table=""
//$con = mysqli_connect("localhost","root","","abhyuday") or die("Some error occurred during connection " . mysqli_error($con));

$strSQL = "DELETE FROM frontimg WHERE id='".$id."'";
if ($mysqli->query($strSQL) === TRUE) {
    echo "<script>alert('Record deleted successfully');</script>";
	echo "<script>location.assign('frontimage.php')</script>";
} else {
    echo "Error deleting record: " . $mysqli->error;
}
 }
?>