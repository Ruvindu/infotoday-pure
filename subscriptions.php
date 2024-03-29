	<?php

  require_once("inc/connection.php");
  session_start();
  
	?>
<DOCTYPE html>
<html>
<head>
	<title>SUbscribe Newspapers & Magazins </title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">  
  	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  	<link rel="stylesheet" type="text/css" href="css/custom.css">
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
    <br><br>

	<div class="container-fluid">
		<div class="row text-center">
			
		<?php
		if(isset($_GET['name'])){
			if($_GET['name'] == 'all'){

				$gold_package ="SELECT * FROM newspaper";
				$res_package = mysqli_query($con,$gold_package);

				echo "<div class=\"card\">
						<div class=\"card-header\">";
				echo "		<h3 class=\"lead\"> Golden Subscription</h3>";
				echo "	</div>
						<div class=\"card-body\">
							<div class=\"card-deck\" style=\"background-color: rgba(245, 245, 245, -5);\"> ";

								while($item = mysqli_fetch_assoc($res_package)){
									$thumbnail = base64_encode($item['thumbnail']);

				echo"				<div class=\"col-lg-2 col-md-5 mb-2\" >
									<div class=\"card\" style=\"width: 14rem;\">
										<div class=\"card-body\">
											<img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
											<h5 class=\"card-title\">{$item['name']}</h5>
		                	    			<p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>
               								<a href=\"{$item['file']}\" class=\"btn btn-primary mr-1\">Read</a> 
										</div>
									</div>
									</div>";
								}

				echo"		</div>
						</div>

					</div>
					";	
			}
			else{
				$p_name=$_GET['name'];
				$lite_package = "SELECT * FROM `newspaper` n ,`subscribe` b WHERE  `customer_id` = {$_SESSION['usr_id']}  and n.name='$p_name'";
				$result_package = mysqli_query($con,$lite_package);
		

				echo "<div class=\"card\">
						<div class=\"card-header\">";
				echo "		<h3 class=\"lead\"> Lite Subscription</h3>";
				echo "	</div>
						<div class=\"card-body\">
							<div class=\"card-deck\" style=\"background-color: rgba(245, 245, 245, -5);\"> ";

								while($item = mysqli_fetch_assoc($result_package)){
									$thumbnail = base64_encode($item['thumbnail']);

				echo"				<div class=\"col-lg-2 col-md-5 mb-2\" >
									<div class=\"card\" style=\"width: 14rem;\">
										<div class=\"card-body\">
											<img class=\"card-img-top\" src=\"data:image/jpeg;base64,{$thumbnail}\" alt=\"Thumbnail\" >
											<h5 class=\"card-title\">{$item['name']}</h5>
		                	    			<p class=\"card-text\">{$item['description']},<b> {$item['date']}</b></p>
               								<a href=\"{$item['file']}\" class=\"btn btn-primary mr-1\">Read</a> 
										</div>
									</div>
									</div>";
								}

				echo"		</div>
						</div>

					</div>
					";	
			}
		}
						
		?>
				
				
						
						
		</div>
	</div>
	

</body>
</html>


				

