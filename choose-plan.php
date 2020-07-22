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

                        if ($_SESSION['usr_avatar']!=NULL) {
                          echo "<img src=\"data:image/jpeg;base64,{$_SESSION['usr_avatar']}\" width=\"30\" height=\"30\" class=\"d-inline-block align-top profile_border\" >";
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

                $lite_1month_price='Rs.' . mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Lite 1 month'" ))['price'];
                $lite_1year_price='Rs.'. mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Lite 1 year'" ))['price'];
                $gold_1month_price='Rs.' . mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Golden 1 month'" ))['price'];
                $gold_1year_price='Rs.' . mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Golden 1 year'" ))['price'];

                /*$select_packages="SELECT * FROM package";
                $packages_results=mysqli_query($con,$select_packages);
                $packages_record=mysqli_fetch_assoc($packages_results);
                
                $lite_1month_price=  $packages_record['price'];
                 $packages_record=mysqli_fetch_assoc( $packages_results);
                $lite_1year_price=  $packages_record['price'];
                 $packages_record=mysqli_fetch_assoc( $packages_results);
                $gold_1month_price= $packages_record['price'];
                 $packages_record=mysqli_fetch_assoc( $packages_results);
                $gold_1year_price= $packages_record['price'];*/

                
                ?>				
        				<table style=" margin-top: 10px; ">
        					<tr  >
        						<td class="package_shaow_table" style="width:500px; border: 0px;">
        							<h4 id="magazin_name"></h4>
                      <p id="magazin_descript"></p>
        							
        						</td>
                    <form method="POST" action="">
        						<td class="package_shaow_table" id="lite_button_month" style="width:200px;line-height: 0pt;border: 0px;">
        							<p> 1 Month</p>
        							<h4 id="1month_lite"></h4>
        							<button class="btn btn-primary" name="1month_lite"  >CHOOSE</button>
        						</td>

                    <td class="package_shaow_table" id="gold_button_month" style="width:200px;line-height: 0pt;border: 0px;">
                      <p> 1 Month</p>
                      <h4 id="1month_gold"></h4>
                      <button class="btn btn-warning" name="1month_gold">CHOOSE</button>
                    </td>

        						<td class="package_shaow_table" id="lite_button_year" style="width:200px;line-height: 0pt;border: 0px;">
        							<p> 1 Year</p>
        							<h4 id="1year_lite"></h4>
        							<button class="btn btn-primary" name="1year_lite" >CHOOSE</button>
        						</td>

                    <td class="package_shaow_table" id="gold_button_year" style="width:200px;line-height: 0pt;border: 0px;">
                      <p> 1 Year</p>
                      <h4 id="1year_gold"></h4>
                      <button class="btn btn-warning" name="1year_gold" >CHOOSE</button>
                    </td>
                    </form>


        					</tr>
        					<tr>
        						<td class="package_shaow_table lead">
        							 Free  coupon available 
        						</td>
        						<td class="package_shaow_table blockquote" id="coupon3">
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
                      
                    </td>
                    <td class="package_shaow_table blockquote" id="shear4">
                      
                    </td>
                    <td class="package_shaow_table blockquote">
                     
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
    			
  				
  		
			});

		</script>
		<script> document.getElementById('magazin_name').innerHTML =   'Unlimited access to 3000+ magazins , newspapers & wonderful features' </script>
    <script> document.getElementById('magazin_descript').innerHTML =   '' </script>
		<script> document.getElementById('1month_gold').innerHTML =   '$gold_1month_price' </script>
    <script> document.getElementById('1year_gold').innerHTML =   '$gold_1year_price' </script>
    <script> document.getElementById('coupon3').innerHTML =   'Yes' </script>
    ";

    echo " <script>$('document').ready(function(){
                      $('#lite_button_month').hide();
                      $('#lite_button_year').hide();
                      $('#gold_button_year').show();
                      $('#gold_button_month').show();
                      
                        });";
     echo "</script>";           

}
if(isset($_POST['lite']) || $x==0){
  
  $subs_item_q="SELECT * FROM newspaper WHERE newspaper_id={$_GET['id-subscribe']}" ;
  $subs_item=mysqli_fetch_assoc(mysqli_query($con,$subs_item_q));
  $newspaper_name=$subs_item['name'];
  $newspaper_descript=$subs_item['description'];
  $_SESSION['subs_newspaper_id']=$subs_item['newspaper_id'];                
	echo "<script>
			$(document).ready(function(){
  				
    			$('#gold').css('background-color', '#f7f7f7');
    			
  		
	   });

      </script>
      <script> document.getElementById('magazin_descript').innerHTML =   '$newspaper_descript' </script>
      <script> document.getElementById('magazin_name').innerHTML =   '$newspaper_name' </script>
      <script> document.getElementById('1month_lite').innerHTML =   '$lite_1month_price' </script>
      <script> document.getElementById('1year_lite').innerHTML =   '$lite_1year_price' </script>
      <script> document.getElementById('coupon3').innerHTML =   'No' </script>";
      
      echo " <script>$('document').ready(function(){
                      $('#lite_button_month').show();
                      $('#lite_button_year').show();
                      $('#gold_button_year').hide();
                      $('#gold_button_month').hide();
                      
                        });";
     echo "</script>";  

}





$getcoupon="SELECT * FROM coupon";
$coupon_results=mysqli_fetch_assoc(mysqli_query($con,$getcoupon));
$coupon_id=$coupon_results['coupon_id'];
$user_id=$_SESSION['usr_id'];

if(isset($_POST['1month_lite'])){

  /*$mydate=getdate(date("U"));
  $date=date_create( $mydate['month']- $mydate['mday']- $mydate['year']);
  date_add($date,date_interval_create_from_date_string("30 days"));
  $expired_date= date_format($date,"Y-M-d");*/

  $date = new DateTime(date('Y-m-d'));
  $date->modify('+30 day');
  $expired_date = $date->format('Y-M-d');


  $_SESSION['newspaper_name']=$newspaper_name;
  $_SESSION['duration']='1 Month';
  $_SESSION['amount']=$lite_1month_price;
  $_SESSION['expire']=$expired_date;
  $_SESSION['coupon_id']=null;
  unset($_SESSION['cart_total']);
  echo "<script> location.replace('paymentmethod.php'); </script>";
  
}
if(isset($_POST['1year_lite'])){

  /*$mydate=getdate(date("U"));
  $date=date_create($mydate['month']- $mydate['mday']- $mydate['year']);
  date_add($date,date_interval_create_from_date_string("1 year"));
  $expired_date= date_format($date,"Y-M-d");*/

  $date = new DateTime(date('Y-m-d'));
  $date->modify('+365 day');
  $expired_date = $date->format('Y-M-d');

  $_SESSION['newspaper_name']=$newspaper_name;
  $_SESSION['duration']='1 Year';
  $_SESSION['amount']=$lite_1year_price;
  $_SESSION['expire']=$expired_date;
  $_SESSION['coupon_id']=$coupon_id;
   unset($_SESSION['cart_total']);

  echo "<script> location.replace('paymentmethod.php'); </script>";
  
}
if(isset($_POST['1month_gold'])){

  /*$mydate=getdate(date("U"));
  $date=date_create( $mydate['month']- $mydate['mday']- $mydate['year']);
  date_add($date,date_interval_create_from_date_string("30 days"));
  $expired_date= date_format($date,"Y-M-d");*/

  $date = new DateTime(date('Y-m-d'));
  $date->modify('+30 day');
  $expired_date = $date->format('Y-M-d');

  $_SESSION['newspaper_name']=null;
   $_SESSION['duration']='1 Month';
  $_SESSION['amount']=$gold_1month_price;
  $_SESSION['expire']=$expired_date;
  $_SESSION['coupon_id']=$coupon_id;
   unset($_SESSION['cart_total']);

  echo "<script> location.replace('paymentmethod.php'); </script>";
 
}
if(isset($_POST['1year_gold'])){

  /*$mydate=getdate(date("U"));
  $date=date_create($mydate['month']- $mydate['mday']- $mydate['year']);
  date_add($date,date_interval_create_from_date_string("1 year"));
  $expired_date= date_format($date,"Y-M-d");*/

  $date = new DateTime(date('Y-m-d'));
  $date->modify('+365 day');
  $expired_date = $date->format('Y-M-d');

  $_SESSION['newspaper_name']=null;
   $_SESSION['duration']='1 Year';
  $_SESSION['amount']=$gold_1year_price;
  $_SESSION['expire']=$expired_date;
  $_SESSION['coupon_id']=$coupon_id;
   unset($_SESSION['cart_total']);
  
   echo "<script> location.replace('paymentmethod.php'); </script>";
}


?>