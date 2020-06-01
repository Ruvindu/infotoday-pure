<!DOCTYPE html>
<html>
<head>
	<?php

  require_once("inc/connection.php");
  session_start();
  
	?>
	<title>Payment Method</title>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">  
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="css/custom.css">

  	<style type="text/css">
  		.card_heandler{
  				height: 800px; 
  				width: 1000px; 
  				margin-left: 100px; 
  				border: 0px; 

  		}
  		.form_a{
  			width:400px;
  		}
  		.credilogo1{
  			height: 35px;
  			width: 150px; 
  			margin-left: -15px;
  			margin-top: 5px;
  		}
  		.credilogo2{
  			height: 35px;
  			width: 150px; margin-left: -5px;  
  			position: absolute;
  			margin-top: -5px;
  		}
  		.cvvtext{
  			font-size: 10px;
  			position: absolute;
  			margin-top: -43px; 
  			margin-left: 320px;
  			line-height: 12pt;
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
        		<div class="card-deck ">
        			<div class="card card_heandler"><br>
        				<div class="card">
        					<div class="card-body" style="line-height: 23pt;">
        						<form method="POST" action="">
        						<dd>
        							<div class="bg-secondary credilogo1">
        							<div class="btn-primary credilogo2">
        								Debit/Credit Card
        							</div>
        							</div>
        						</dd>
        						<dt>
        							Card Number
        						</dt>
        						<dd>
        							<input type="text" name="creaditcard" placeholder="Card Number" class="form_a" required>
        						</dd>
        						<dt>
        							Expiry &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&emsp;
        							CVV
        						</dt>
        						<dd>
        							<input type="text" name="cardexpire" placeholder="MM/YY" required>&emsp;
        							<input type="text" name="cardcvv" placeholder="CVV" style="width: 100px;" required> <dd class="cvvtext" >Last 3 or 4 digits<br> on back of card</dd> 
        						</dd>
        						<dt>
        							Name on Card
        						</dt>
        						<dd>
        							<input type="text" name="cardname" placeholder="Name on Card" class="form_a" required>
        						</dd>
        						<dt>
        							Email ID
        						</dt>
        						<dd>
        							<input type="text" name="emailid" placeholder="Email ID" class="form_a" required>
        						</dd>
        						<dt style="margin-top: 20px;">
        							<input type="submit" name="paysubmit" value="Pay Now" class="btn btn-primary form_a" >
        						</dt>
        						</form>
        					</div>
        				</div><br>
        				<div class="card">
        					<div class="card-body" id="subscribe_error">
                    <h3 style="color: red;" id="error_head"></h3>
                    <p class="lead" id="error_body"></p>
                    <p id="error_link" ></p>
                    <form method="POST" action="">
                      <input type="submit" name="end_subscribe" class="btn btn-lite lead" style="color:blue;" value="End current subscription !">  
                    </form>
        						
        					</div>
        				</div><br>
        			</div>
        			<div class="card" style="border: 0px;"><br>
        				<div class="card" style="line-height: 23pt; width: 400px; height: 200px;">
        					<div class="card-body">
        						<table>
        							<tr>
        								<dd>
        									<div class="bg-secondary credilogo1">
        										<div class="btn-primary credilogo2">
        											Voucher/Coupon
        										</div>
        									</div>
        								</dd>
        							</tr>
        							<tr>
                        <form method="POST" action="">
        								<td>
        									<input type="text" name="couponcode" placeholder="Coupon Code" style="margin-left: 50px; margin-top: 10px;width: 200px;">
        								</td>
        								<td>
        									<input type="submit" name="couponsubmit" value="Apply" class="btn btn-primary" style="margin-top: 10px; width: 90px;margin-left: 3px;">
        								</td>
                        </form>
        							</tr>
        							<tr>
        								
        								<th class="text-center"><br>
        									Check your coupon&emsp;&emsp; <input type="submit" name="vouchorsubmit" value="+" style="margin-right: -70px;background-color:  white;border: none;">
        								</th>
        							</tr>

        						</table>
        					</div>
        				</div><br>
        				<div class="card " style="height: 300px; width: 400px;">
        					<div class="card-body">
        						<?php

                    


        							if(isset($_SESSION['cart_total'])){

        								$total=$_SESSION['cart_total'];
        								$buy="newpaper buying";
        								echo "<h5>Info-Today ". $buy." </h5>";
        								echo "<h4>You will be charged</h4>";
        								echo"<h4 style='color:red;'>".$_SESSION['cart_total']."</h4>";
        								echo"<dd> You bought Magazins will never be expired</dd>";
        								echo "<dd>Note:You can cancel the auto-renewal at any time during the period.</dd>";
        								echo "<dt>No commitment. Cancel at any time.</dt>	";
        							}



                      if(isset($_SESSION['amount'])){
                        $expir=$_SESSION['expire'];
                        $total=$_SESSION['amount'];
                        $buy="newpaper buying";

                        if($_SESSION['newspaper_name']==null){
                          $_SESSION['subcript_type'] ='Gold';
                        }else{
                          $_SESSION['subcript_type']='Lite';
                        }
                        echo "<h5>Info-Today ". $_SESSION['subcript_type']." ".$_SESSION['duration']." Subscription </h5>";
                        echo "<h4>You will be charged</h4>";
                        echo"<h4 style='color:red;'>".$_SESSION['amount']."</h4>";
                        echo"<dd> After ".$_SESSION['duration']." , we will automatically renew your Subscription at ".$_SESSION['amount']." on ".$_SESSION['expire'].".</dd>";
                        echo "<dd>Note:You can cancel the auto-renewal at any time during the period.</dd>";
                        echo "<dt>No commitment. Cancel at any time.</dt> ";
                      }
                      


        						?>
        						
        						
        						
        						
        					</div>
        				</div><br>
        				<div class="card" style="height: 100px; width: 400px;">
        					<div class="card-body" >
        						
        					</div>
        				</div><br>
        			</div>
        		</div>
        	</div>
        </div>
</body>
</html>
<?php
  echo "<script>
        $('document').ready(function(){
        $('#end_sbus_hide').hide();
                                });
        </script>";
                             
        $chech_to_subscribe="SELECT * FROM subscribe WHERE user_id={$_SESSION['usr_id']}";
            $apply_subscribe_results=mysqli_fetch_assoc(mysqli_query($con,$chech_to_subscribe));
		          if(isset($_POST['paysubmit'])){

                       if(isset($_SESSION['amount'])){

                          if($apply_subscribe_results['user_id']==null){

                            $expir=$_SESSION['expire'];
                            $user_id=$_SESSION['usr_id'];
                            $coupon_id=$_SESSION['coupon_id'];
                            $newspaper_id=$_SESSION['subs_newspaper_id'];
                            $subcript_type=$_SESSION['subcript_type'];

                            $subscribe_query="INSERT INTO subscribe (expire_date,customer_id,coupon_id,newspaper_id,package)VALUES('$expir','$user_id','$coupon_id', '$newspaper_id','$subcript_type')";
                            mysqli_query($con,$subscribe_query);
                          }
                          else{
                            echo"<script> document.getElementById('error_head').innerHTML = 'subscribe error'; </script>";
                            echo"<script> document.getElementById('error_body').innerHTML = 'You already applied a package.<br>If you want apply another package please confirm deactivate current package'; </script>";
                            echo"<script> document.getElementById('error_head').innerHTML = 'subscribe error'; </script>";
                            echo"<script> document.getElementById('error_link').innerHTML = 'Click the link for'; </script>"; 
                            echo "<script> location.replace('#subscribe_error'); </script>";
                            
                            echo "<script>
                                $('document').ready(function(){
                                $('#end_sbus_hide').show();
                                 });
                                    </script>";
                          }
                       }
                          

                     

                       if(isset($_SESSION['cart_total'])){

                          
                      
                            $but_query="INSERT INTO buy  SELECT * FROM cart WHERE user_id={$_SESSION['usr_id']}";
                            mysqli_query($con,$but_query);

                            
                          }

                          
                        
                      $RemoveAllInCart="TRUNCATE TABLE cart;";
                      mysqli_query($con,$RemoveAllInCart);
                      unset($_SESSION['cart_total']) ;
                      unset($_SESSION['amount']);

                      echo "<script> location.replace('index.php'); </script>";
                    }

    if(isset($_POST['couponsubmit'])){
            $chech_to_apply_coupon="SELECT * FROM subscribe WHERE user_id={$_SESSION['usr_id']}";       
            $apply_coupon_results=mysqli_fetch_assoc(mysqli_query($con,$chech_to_apply_coupon));

            if( $apply_coupon_results['coupon_id']>0){


            }


    }

    if(isset($_POST['end_subscribe'])){
                            
                            $delete_subscribe="DELETE FROM subscribe where user_id={$_SESSION['usr_id']}";
                            mysqli_query($con,$delete_subscribe);
                            echo"<script> document.getElementById('error_head').innerHTML = ''; </script>";
                            echo"<script> document.getElementById('error_body').innerHTML = ''; </script>";
                            echo"<script> document.getElementById('error_head').innerHTML = ''; </script>";
                            echo"<script> document.getElementById('error_link').innerHTML = ''; </script>"; 
                            
                            echo "<script>
                                $('document').ready(function(){
                                $('#end_sbus_hide').hide();
                                 });
                                    </script>";
                          }

?>