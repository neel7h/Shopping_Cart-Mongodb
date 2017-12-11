
		<?php
 include 'header.php';



$tot = $mysqli->query("SELECT count(DISTINCT(REF)) as totcol FROM teamreg");
$row=$tot->fetch_array(); 
Global $spent;  
$spent=$row['totcol'];
    
	
$tot1 = $mysqli->query("SELECT count(*) as tot from events ");
$row1=$tot1->fetch_array(); 
Global $events;  
$events=$row1['tot'];
//mysqli_close($con);

 
$tot2 = $mysqli->query("SELECT count(DISTINCT(name)) as tot1 from student ");
$row2=$tot2->fetch_array(); 
Global $events2;  
$events2=$row2['tot1'];

$tot3 = $mysqli->query("SELECT count(DISTINCT(name)) as tot4 from teamreg ");
$row3=$tot3->fetch_array(); 
Global $totamnt;  
$totamnt=$row3['tot4'];
$ttt=$events2+$totamnt;
?>
					
						

		<ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a> <i class="fa fa-angle-right"></i></li>
            </ol>
<!--four-grids here-->
		<div class="four-grids">
					<div class="col-md-3 four-grid">
						<div class="four-agileits">
							<div class="icon">
								<i class="glyphicon " aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>No of Events</h3>
								<h4> <?php echo $events ?>  </h4>
								
							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-agileinfo">
							<div class="icon">
								<i class="glyphicon " aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>College Partcipated</h3>
								<h4><?php echo $spent ?></h4>

							</div>
							
						</div>
					</div>
					<div class="col-md-3 four-grid">
						<div class="four-w3ls">
							<div class="icon">
								<i class="glyphicon " aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3>No of user Registered</h3>
								<h4><?php echo $ttt ?></h4>
								
							</div>
							
						</div>
					</div>
					<!--<div class="col-md-3 four-grid">
						<div class="four-wthree">
							<div class="">
								<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
							</div>
							<div class="four-text">
								<h3></h3>
								<h4>14,430</h4>
								
							</div>
							
						</div>-->
					</div>
					<div class="clearfix"></div>
					<div class="clearfix"></div>
				</div>
				<script>
		$(document).ready(function() {
			 var navoffeset=$(".header-main").offset().top;
			 $(window).scroll(function(){
				var scrollpos=$(window).scrollTop(); 
				if(scrollpos >=navoffeset){
					$(".header-main").addClass("fixed");
				}else{
					$(".header-main").removeClass("fixed");
				}
			 });
			 
		});
		</script>
		<!-- /script-for sticky-nav -->
<!--inner block start here-->

<div class="clearfix"></div>
					<div class="clearfix"></div>
<!--inner block start here-->
<div class="inner-block">
<?php include 'footer.php'?>

</div>
				<?php include 'menu.php'?>
