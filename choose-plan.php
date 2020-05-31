<!DOCTYPE html>
<html>
<head>
	<?php

  require_once("inc/connection.php");
  session_start();
  
	?>
	<title>Choose Plan</title>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">  
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="css/custom.css">
  	<style type="text/css">
  		
  		.packagebutton{
  				color: gold; 
  				background-color: white; 
  				height: 50px;
  				margin-top: -12px;
  				margin-left: -20px; 
  				width: 200px; 
  				border: 0px;

  		}
  		.package_shaow_table{
  				
  				border: 0px solid black; 
  				height:80px;
  		}
  		
  	</style>
</head>

<body>

        <!-- Image and text -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">

        <a class="navbar-brand" href="index.php">
            <img src="imgs/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
            InfoToday
        </a>

    
        
    
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="cart.php">Cart</a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="aboutus.php">About us</a>
			</li>

      <?php

        

        if (isset($_SESSION['usr_id'])) {
          echo "<li class=\"nav-item\">";
          echo "<a class=\"nav-link\" href=\"signout.php\">Sign out</a>";
          echo "</li>";
        }
        
      ?>


			</ul>
            

                    <?php

                      if (isset($_SESSION['usr_id'])) {
                        echo "<a class=\"navbar-brand\" href=\"profile.php\">";

                        if ($_SESSION['usr_avatar']!="") {
                         echo "<img src=\"{$_SESSION['usr_avatar']}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"Avatar\">";
                        }else{
                           echo "<img src=\"imgs/user.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"Avatar\">";
                        }
                        
                        echo "{$_SESSION['usr_fname']}";
                        echo "</a>";

                      }else{
                        echo "<a class=\"navbar-brand\" href=\"sign.php\">";
                        echo "<img src=\"imgs/user.png\" width=\"30\" height=\"30\" class=\"d-inline-block align-top\" alt=\"Avatar\">";
                        echo "Sign in";
                        echo "</a>";
                      }

                    ?>

        </div>
        </nav>

        <div class="container">
        	<div class="row">
        		<div class="card" style="width: 1000px; height :500px; margin-left: 60px; margin-top: 50px;">
        			<div class="card-header" style="height: 51px; ">
        				<table>
        					<tr>
        						<form method="POST" action=""><!----------------Gold & lite button control area------------------------------>
        							<td>
        								<button class="navbar-brand text-center packagebutton" id="lite" name="lite" style="color: #0099ff;" >
        								<img src="imgs/logo.png" width="30" height="30" class="d-inline-block align-top" alt="" >
            							LITE
            							</button>
        							</td>
        							<td>
        								<button class="navbar-brand text-center packagebutton" id="gold" name="gold" style="color: gold; margin-left: -15px;">
        								<img src="imgs/logo.png" width="30" height="30" class="d-inline-block align-top " alt="">
            							GOLDERN
            							</button>
        							</td>
        						</form>
        					</tr>
        				</table>
        			</div>
        			<div class="card-body text-center ">
     <!---------------------------------------------------------Table start--------------------------------------------------------------------->   
                <?php
                $lite_1month_price='Rs.1100.50';
                $lite_1year_price='Rs.9000.00';
                $gold_1month_price='Rs.5100.50';
                $gold_1year_price='Rs.15000.00';
                ?>				
        				<table style=" margin-top: 10px; ">
        					<tr  >
        						<td class="package_shaow_table" style="width:500px; border: 0px;">
        							<h4>Pariganaka</h4>
                      <p>Wijaya pariganaka monthly magazine</p>
        							
        						</td>
        						<td class="package_shaow_table" style="width:200px;line-height: 0pt;border: 0px;">
        							<p> 1 Month</p>
        							<h4 id="1month">Price</h4>
        							<button class="btn btn-lite" id="choosebtn" style="color: white;">CHOOSE</button>
        						</td>
        						<td class="package_shaow_table" style="width:200px;line-height: 0pt;border: 0px;">
        							<p> 1 Year</p>
        							<h4 id="1year">Price</h4>
        							<button class="btn btn-lite" id="choosebtn1" style="color: white;">CHOOSE</button>
        						</td>

        					</tr>
        					<tr>
        						<td class="package_shaow_table lead">
        							 Free 3 coupon available 
        						</td>
        						<td class="package_shaow_table blockquote">
        							Yes
        						</td>
        						<td class="package_shaow_table blockquote">
        							Yes
        						</td>
        					</tr>
        					<tr>
        						<td class="package_shaow_table lead">
        							 Cancle subscription Any time
        						</td>
        						<td class="package_shaow_table blockquote">
        							Yes
        						</td>
        						<td class="package_shaow_table blockquote">
        							Yes
        						</td>
        					</tr>
                  <tr>
                    <td class="package_shaow_table lead">
                       Shear with 4 members
                    </td>
                    <td class="package_shaow_table blockquote">
                      No
                    </td>
                    <td class="package_shaow_table blockquote">
                      Yes
                    </td>
                  </tr>
        				</table>
 <!------------------------------------------------Table end--------------------------------------------------------------------------------->       				
        			</div>
        		</div>
        	</div>
        </div>
</body>
</html>
<?php
	$x=0;
	if(isset($_POST['gold'])){
		$x=1;
	echo "<script>
			$(document).ready(function(){
  				
    			$('#lite').css('background-color', '#f7f7f7');
    			$('#choosebtn').css('background-color', 'gold');
    			$('#choosebtn1').css('background-color', 'gold');
  				
  		
			});

		</script>
			
		<script> document.getElementById('1month').innerHTML =   '$gold_1month_price' </script>
    <script> document.getElementById('1year').innerHTML =   '$gold_1year_price' </script>
    ";

}
if(isset($_POST['lite']) || $x==0){
	echo "<script>
			$(document).ready(function(){
  				
    			$('#gold').css('background-color', '#f7f7f7');
    			$('#choosebtn').css('background-color', '#0099ff');
    			$('#choosebtn1').css('background-color', '#0099ff');
  		
	   });

      </script>
      <script> document.getElementById('1month').innerHTML =   '$lite_1month_price' </script>
      <script> document.getElementById('1year').innerHTML =   '$lite_1year_price' </script>";

}
?>