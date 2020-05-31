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
                    <?php
                      $quary_get_img="SELECT * FROM user WHERE user_id={$_SESSION['usr_id']}";
                      $ecord=mysqli_fetch_assoc(mysqli_query($con,$quary_get_img));
                    ?>

                      <img class="card-img-top p-2"   src="data:upload/jpeg;base64,<?php echo base64_encode($ecord['avatar']);?>" alt="Card image cap">
                      
                      <div id="abc">
                        
                      </div>
                      <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                          <button class="btn btn-primary" id="btReload" name="change_profilepic">Change photo</button>
                          <a href="#" class="btn btn-danger">Remove</a>
                          <p style="font-size: 15px;"><br>
                           Thumbnail :<input type="file" name="fileToUpload" id="fileToUpload" >
                          </p>
                        </form>
                      </div>
                    </div>

                    <div class="card mt-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Personal Details</h5>
                              <div id="old_details">
                              <p class="card-text" >
                                First Name  : <?php echo $ecord['first_name']; ?><br>
                                Last Name  : <?php echo $ecord['last_name']; ?><br>
                                Phone : <?php echo $ecord['phone']; ?><br>
                                Email : <?php echo $ecord['email']; ?><br>
                                Joined : <?php echo $ecord['join_date']; ?><br>
                              </p>

                              <form method="POST" action="">
                                 <button name="upadate_details" class="btn btn-primary">Edit privacy</button>
                              </div>   
                              <div id="new_details">
                                First Name : <input type="text" placeholder="First Name" name="fname" style=" margin-left: 57px;"><br>
                                Last Name  : <input type="text" placeholder="Last Name" name="lname" style="margin-left: 57px;"><br><br>
                                Phone  : <input type="text" placeholder="Phone" name="phone" style=""><br><br>
                                Email  : <input type="text" placeholder="Email" name="email" style="margin-left: 7px;"><br><br>
                                Joined  : <input type="text" placeholder="Joined" name="date" style="margin-left: -1px;"><br><br>
                                <input type="submit" name="add_data"  class="btn btn-primary" value="submit">
                              </div>
                              
                                
                              </form> 
                            </div>
                    </div>


                    <div class="card mt-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Change  password</h5>
                              <form action="profile.php" method="POST">
                                <div class="form-group">
                                  <input type="text" name="current_p" class="form-control" placeholder="Current password">
                                  <p id="currentpwd" style="font-size: 11px; position: absolute;margin-left: 130px;color: red;"></p>
                                </div>
                                <div class="form-group">
                                  <input type="text" name="new_p" class="form-control" id="newpwd"  placeholder="New password">
                                </div>
                                <div class="form-group">
                                  <input type="text" name="confirm_p" class="form-control" placeholder="Confirm password">
                                  <p id="confirmpwd" style="font-size: 11px; position: absolute;margin-left: 130px;color: red;"></p>
                                </div>
                                <button name="changepass" class="btn btn-primary">Save changes</button>
                              </form>
                            </div>
                    </div>


                    <div class="card mt-3 mb-3" style="width: 18rem;">
                            <div class="card-body">
                              <h5 class="card-title">Change account type</h5>

                              <?php
                             
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

      <?php
            
        
           if(isset($_POST['change_profilepic'])) {
               if($_FILES['fileToUpload']['tmp_name'] != null){
                   $imgData = addslashes(file_get_contents($_FILES['fileToUpload']['tmp_name']));
                   $quary = "UPDATE user SET avatar='$imgData' WHERE user_id={$_SESSION['usr_id']}";
                    mysqli_query($con,$quary);
                      }     
                      echo " <script type='text/javascript'>

                              (function()
                                        {
                                  if( window.localStorage )
                                       {
                                    if( !localStorage.getItem('firstLoad') )
                                          {
                                      localStorage['firstLoad'] = true;
                                        window.location.reload();
                                    }  
                                   else
                                    localStorage.removeItem('firstLoad');
                                  }
                                })();

                              </script>";
                  }


            echo " <script>$('document').ready(function(){
                      $('#old_details').show();
                      $('#new_details').hide();
                      
                        });";
                echo "</script>";      

            if(isset($_POST['upadate_details'])){
                echo " <script>$('document').ready(function(){
                      $('#old_details').hide();
                      $('#new_details').show();
                      
                        });";
                echo "</script>";

                

            }
            if(isset($_POST['add_data'])){
                $fname=$_POST['fname'];
                $lname=$_POST['lname'];
                $phone=$_POST['phone'];
                $email=$_POST['email'];
                $join_date=$_POST['date'];


                $personal_update="UPDATE user SET first_name='$fname' , last_name='$lname' ,phone=' $phone',email='$email',join_date='$join_date' WHERE user_id={$_SESSION['usr_id']}";
                   mysqli_query($con,$personal_update);
                 echo " <script>$('document').ready(function(){
                      $('#old_details').show();
                      $('#new_details').hide();
                        });";
                echo "</script>";
            }      
        // ----------------------------------------- Check Current Password ---------------------------------------------------------------//
            
        //------------------------------------------- Add New Password ---------------------------------------------------------------//
            if(isset($_POST['changepass'])){

              $cunntpass="SELECT * FROM user WHERE user_id={$_SESSION['usr_id']}";
              $cat = mysqli_fetch_assoc(mysqli_query($con,$cunntpass));

              $encripted_current_pass=sha1($_POST['current_p']);
              $encripted_new_pass=sha1($_POST['confirm_p']);
             
                if( $encripted_current_pass == $cat['password']){

                  echo"<script> document.getElementById('currentpwd').innerHTML = ''; </script>";

                  if($_POST['new_p'] == $_POST['confirm_p'] ){

                      $changepass="UPDATE user SET password='$encripted_new_pass' WHERE user_id={$_SESSION['usr_id']}";
                      mysqli_query($con,$changepass);

                      echo"<script> document.getElementById('confirmpwd').innerHTML = ''; </script>";
                      echo"<script> alert('Your Password Changed.'); </script>";
                      
                  }
                  else{
                            
                        echo"<script> document.getElementById('confirmpwd').innerHTML = 'Re-enter correct Password'; </script>";
                      }
                }
                else{
                  
                      echo"<script> document.getElementById('currentpwd').innerHTML = 'Enter Correct Password'; </script>";
                   }
            }                  

      ?>

