<!DOCTYPE html>

<?php

	require_once("inc/connection.php");
	session_start();

	//sigin in process

	function sign_in($con,$email_or_phone,$password){

		$encryted_pwd = sha1($password);

		$signin_user_q = "SELECT `user_id`, `role`, `first_name`, `avatar` FROM `user` WHERE `email` = '{$email_or_phone}' OR `phone` = '{$email_or_phone}' AND `password` = '{$encryted_pwd }'" ;

		$result = mysqli_query($con,$signin_user_q);

		if (mysqli_num_rows($result)>0) {

			$current_user = mysqli_fetch_assoc($result);
			var_dump($current_user);

			$_SESSION['usr_id'] = $current_user['user_id'];
			$_SESSION['usr_fname'] = $current_user['first_name'];
			
			if ($current_user['avatar']!=NULL){
				$_SESSION['usr_avatar'] = base64_encode($current_user['avatar']);
			}else{$_SESSION['usr_avatar'] = NULL;}

			$_SESSION['role'] = $current_user['role'];
			
			header("location:index.php");
		}else{
			echo "<script>alert('Incorrect email or password.')</script>";
		}

	}


	if (isset($_POST['signin'])) {
		sign_in($con,$_POST['email_or_phone'], $_POST['pwd']);
	}


	//sign up process

	if (isset($_POST["signup"])) {

		$today = date("Y-m-d");
		$encryted_pwd = sha1($_POST['pwd']);

		$reg_new_user_q = "INSERT INTO `user`( `first_name`, `last_name`, `role`, `phone`, `email`, `join_date`, `avatar`, `password` ) VALUES ('{$_POST["fname"]}', '{$_POST["lname"]}', 'customer', '{$_POST["phone"]}', '{$_POST["email"]}', '{$today}', NULL ,'{$encryted_pwd}')";

		//echo $reg_new_user_q;

		if (mysqli_query($con,$reg_new_user_q)) {

			//if user successfuly registerd, then sign in automaticaly
			sign_in($con,$_POST["email"],$_POST['pwd']);

		}
	}

?>



<html>
<head>
	<title>InfoToday</title>

	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
      
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    
  	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



  	<link rel="stylesheet" type="text/css" href="css/custom.css">



  	<script type="text/javascript">
  		
  		function pre_validate(which_one) {
  			
  			if (which_one=="fname") {
  				//------
  				var val=document.getElementById("fname").value;  
  				

  				if (val!="") {
  					document.getElementById("fname").classList.remove("text_wanning");
  					document.getElementById("fname").classList.add("text_correct");
  				}else{
  					document.getElementById("fname").classList.add("text_wanning");
  				}
  				//----
  			}else if (which_one=="lname") {
  				//------
  				var val=document.getElementById("lname").value;  
  				

  				if (val!="") {
  					document.getElementById("lname").classList.remove("text_wanning");
  					document.getElementById("lname").classList.add("text_correct");
  				}else{
  					document.getElementById("lname").classList.add("text_wanning");
  				}
  				//----
  			}else if (which_one=="email") {
  				//------
  				var val=document.getElementById("email").value;  
  				

  				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(val)) {
  					document.getElementById("email").classList.remove("text_wanning");
  					document.getElementById("email").classList.add("text_correct");
  				}else{
  					document.getElementById("email").classList.add("text_wanning");
  				}
  				//----
  			}else if (which_one=="phone") {
  				//------
  				var val=document.getElementById("phone").value;  
  				

  				if (/^\d{10}$/.test(val)) {
  					document.getElementById("phone").classList.remove("text_wanning");
  					document.getElementById("phone").classList.add("text_correct");
  				}else{
  					document.getElementById("phone").classList.add("text_wanning");
  				}
  				//----
  			}else if (which_one=="password") {
  				//------
  				var val=document.getElementById("pwd").value;  
  				

  				if (val.length>=7) {
  					document.getElementById("pwd").classList.remove("text_wanning");
  					document.getElementById("pwd").classList.add("text_correct");
  				}else{
  					document.getElementById("pwd").classList.add("text_wanning");
  				}
  				//----
  			}

  		}

  	</script>


</head>
<body class="background">

		<!-- Image and text -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

		<a class="navbar-brand" href="#">
			<img src="imgs/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
			InfoToday
		</a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	            <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarText">
	        <ul class="navbar-nav mr-auto">
	      <li class="nav-item active">
	        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="aboutus.php">About us</a>
	      </li>

			
			
		</div>
		</nav>



	<div class="container">
		
		<div class="row">
	

			<div class="col-12">
				<div class="custom_border signin">
				<form action="sign.php" method="post">
				<table>
					<tr>
						<th colspan="2">
							<div class="form-group">
						    	<h4>Sign in</h4>
						    </div>
						</th>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-group">
						    	<input type="text" name="email_or_phone" placeholder="Email or Phone" class="form-control text_width" required>
						    </div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-group">
						    	<input type="Password" name="pwd" placeholder="Password" class="form-control text_width" required>
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="checkbox">
						    <label><input type="checkbox"> Remember me</label>
						  </div>
						</td>
						<td align="right">
							<input type="submit" name="signin" value="Sign in" class="btn btn-info">
						</td>
					</tr>
				</table>
			</form>
			</div>




			<div class="custom_border signup mb-3">
				<form action="sign.php" method="post">
				<table>
					<tr>
						<th>
							<div class="form-group">
						    	<h4>Sign up</h4>
						    </div>
						</th>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="text" name="fname" placeholder="First name" class="form-control text_width " onblur="pre_validate('fname')"  onkeypress="pre_validate('fname')" id="fname" required>
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="text" name="lname" placeholder="Last name" class="form-control text_width" onblur="pre_validate('lname')" onkeypress="pre_validate('lname')" id="lname" required>
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="Email" name="email" placeholder="Email" class="form-control text_width" onblur="pre_validate('email')" onkeypress="pre_validate('email')" id="email" required> 
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="text" name="phone" placeholder="Phone" class="form-control text_width" onblur="pre_validate('phone')" onkeypress="pre_validate('phone')" id="phone" required>
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="Password" name="pwd" placeholder="Password" class="form-control text_width" onkeypress="pre_validate('password')" id="pwd" required>
						    </div>
						</td>
					</tr>

					<tr>
						<td align="right">
							<input type="submit" name="signup" value="Sign up" class="btn btn-info">
						</td>
					</tr>
				</table>
			</form>
			</div>

			</div>
		</div>

	</div>

</body>
</html>