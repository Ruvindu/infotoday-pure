<!DOCTYPE html>

<?php

  require_once("inc/connection.php");
  session_start();

  /*Create publisher account*/

  if (isset($_GET['user'])) {
    
    $update_usertypeQ = "UPDATE `user` SET `role`='supplier' WHERE `user_id` = {$_GET['user']}";

    
    if (mysqli_query($con,$update_usertypeQ)) {
      echo "<script>alert('Your account coverted to publisher account.');</script>";
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
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cart.php">Cart</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="aboutus.php">About us</a>
      </li>

      <?php

         if (isset($_SESSION['role'])){

          if (strcmp($_SESSION['role'], "supplier") == 0) {
            echo "<li class=\"nav-item\">";
            echo "<a class=\"nav-link\" href=\"publisher-form.php\">Publish New</a>";
            echo "</li>";
          }
        } 

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


        <div class="container-fluid">
            
            <div class="row mt-4">
                <div class="col-md-4">
                   
                  <div class="card" style="width: 18rem;">
                      <img class="card-img-top p-2" src="imgs/users/user.png" alt="Card image cap">
                      <div class="card-body">
                        <a href="#" class="btn btn-primary">Change photo</a>
                        <a href="#" class="btn btn-danger">Remove</a>
                      </div>
                    </div>

                    <div class="card mt-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Name</h5>
                              <p class="card-text">
                                Address :<br>
                                Phone :<br>
                                Email :<br>
                                Joind :<br>
                              </p>
                              <a href="#" class="btn btn-primary">Edit privacy</a>
                            </div>
                    </div>


                    <div class="card mt-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Change  password</h5>
                              <form action="profile.php" method="post">
                                <div class="form-group">
                                  <input type="text" class="form-control" id="currentpwd" placeholder="Current password">
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="newpwd"  placeholder="New password">
                                </div>
                                <div class="form-group">
                                  <input type="text" class="form-control" id="confirmpwd" placeholder="Confirm password">
                                </div>
                              </form>
                              <a href="#" class="btn btn-primary">Save changes</a>
                            </div>
                    </div>


                    <div class="card mt-3 mb-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Change account type</h5>

                              <?php
                                echo $_SESSION['role'];
                                if ( strcmp($_SESSION['role'], "supplier") == 0) {
                                  echo "You are already Publisher. Publisher account can't change to customer account.";
                                }else{
                                  
                                  echo "
                                      <p class=\"card-text\">
                                      Change your customer account as a <a href=\"profile.php?user={$_SESSION['usr_id']}\" ; >publisher</a>.
                                      </p>
                                  ";
                                }
                              ?>
                              
                            </div>
                    </div>


                </div>

                <div class="col-md-8">
                    

                    

                    
                </div>


            </div>

            

        </div>




</body>
</html>