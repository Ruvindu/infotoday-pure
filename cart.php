<!DOCTYPE html>

<?php

  require_once("inc/connection.php");
  session_start();

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
</head>

<body class="background">

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
			<li class="nav-item ">
				<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link" href="cart.php">Cart</a>
			</li>
			<li class="nav-item">
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
            
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
        </nav>

        <br><br>
        <div class="container" >
          <div class="row">
            <div class="card-deck ">
             <div class="card text-center " style="width: 700px; background-color: rgba(245, 245, 245, -5);" >

               <?php
                $cartQuery="SELECT newspaper.*,user.*,cart.* FROM cart,newspaper,user where cart.user_id=user.user_id and cart.newspaper_id=newspaper.newspaper_id group by cart.cart_id";
                  $CartResult=mysqli_query($con,$cartQuery);
                  while($Cartrecord=mysqli_fetch_assoc($CartResult)){
               ?>


                <br>
                <div class="card " style="height: 200; width: 250px; ">         
                  <div class="card-header" style="height: 280px; width: 250px;">
                      <br>
                      <img src="data:upload/jpeg;base64,<?php echo base64_encode($Cartrecord['thumbnail']);?>" class="mx-auto center-block img-fluid"style="height: 200px; width: auto;">
                  </div>
                  <div class="card-body" style="height: 100px; width: 250px;"> 
                      <b><p style="margin-top: -10px;"><?php echo $Cartrecord['name'];  ?></p></b>
                       <p style="margin-top: -20px;"><?php echo $Cartrecord['description'];  ?></p>

                  </div> 
                  <div class="card-footer" style="height:auto; width: 250px;">
                      <button class="btn btn-success">Add</button>
                  </div>  
                </div>               
                      <br><br>

              <?php
                }
              ?>
            
            </div> 
            <div class="card" style="width: 700px; background-color: rgba(245, 245, 245, -5);opacity: .9;">
              <p>sdsdsdd</p>
            </div>  
          
          </div>
        </div>
      </div>



</body>
</html>