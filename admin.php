<!DOCTYPE html>

<?php

  require_once("inc/connection.php");
  session_start();

  if (!isset($_SESSION['role']) and $_SESSION['role']!="admin" ) {
    header("location:sign.php");
  }


  /* approve pending newspapers*/

  if (isset($_GET['action'])) {
      $approveQ = "UPDATE `newspaper` SET `status`='approved' WHERE `newspaper_id`= {$_GET['action']}";
      mysqli_query($con,$approveQ);
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
                        echo "<a class=\"navbar-brand\" href=\"#\">";

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
            
            <div class="row mt-4">

              <div class="col-12">

                <div class="card" >
                    <div class="card-body">
                      <h5 class="card-title"><font color="#34a5eb">P</font>ending <font color="#34a5eb">N</font>ewspapers</h5>

                      <div class="table-wrapper-scroll-y my-custom-scrollbar">
                        <table class="table table-bordered table-striped mb-0">
                          <thead>
                            <tr>
                              <th scope="col">Name</th>
                              <th scope="col">Gross price</th>
                              <th scope="col">Supplier</th>
                              <th scope="col">Publish duration</th>
                              <th scope="col">Description</th>
                              <th scope="col">Date</th>
                              <th scope="col">Category</th>
                              <th scope="col">File</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php 

                                $get_pendingQ = "SELECT `newspaper`.* , `category`.* , `user`.* FROM `newspaper`, `category` , `user` WHERE `status` = 'pending' AND `newspaper`.`category_id` = `category`.`category_id` AND `newspaper`.`supplier_id` = `user`.`user_id`";

                                $res_pending = mysqli_query($con,$get_pendingQ);

                                if ($res_pending) {
                                  
                                    while ($PI= mysqli_fetch_assoc($res_pending)) {
                                                                            
                                        echo "<tr>
                                                <th scope=\"row\">{$PI['name']}</th>
                                                <td>Rs.{$PI['gross_price']}</td>
                                                <td>{$PI['first_name']} {$PI['last_name']}</td>
                                                <td>{$PI['Publish_duration']}</td>
                                                <td>{$PI['description']}</td>
                                                <td>{$PI['date']}</td>
                                                <td>{$PI['category_name']}</td>
                                                <td> <a href='{$PI['file']}' traget='_blank' class='btn btn-outline-primary'>View</a></td>

                                                <td><a href='admin.php?action={$PI['newspaper_id']}' traget='_blank' class='btn btn-outline-danger'>Approve</a> </td>

                                              </tr>";
                                    }
                                }

                             ?>
                            
                          </tbody>
                        </table>

                      </div>
                      
                    </div>
                </div>

              </div>

              <div class="col-3">
                  <div class="card mt-3" style="width:200px;">
                    <div class="card-body">
                      <h5 class="card-title">Active Customers</h5>
                      
                      <font class="card-text" style="font-size: 40px" color="#34a5eb">
                      <?php
                          $countQ = "SELECT count(`role`) as `count` FROM `user` WHERE `role`='customer'";
                          $result = mysqli_query($con,$countQ);
                          if ($result) {
                            echo mysqli_fetch_assoc($result)['count'];
                          }
                      ?>
                      </font>
                      
                    </div>
                  </div>
              </div>

              <div class="col-3">
                  <div class="card mt-3" style="width:200px;">
                    <div class="card-body">
                      <h5 class="card-title">Active suppliers</h5>
                      
                      <font class="card-text" style="font-size: 40px" color="#34a5eb">
                      <?php
                          $countQ = "SELECT count(`role`) as `count` FROM `user` WHERE `role`='supplier'";
                          $result = mysqli_query($con,$countQ);
                          if ($result) {
                            echo mysqli_fetch_assoc($result)['count'];
                          }
                      ?>
                      </font>
                      
                    </div>
                  </div>
              </div>
                
              <div class="col-3">
                  <div class="card mt-3" style="width:240px;">
                    <div class="card-body">
                      <h5 class="card-title">Available newspapers</h5>
                      
                      <font class="card-text" style="font-size: 40px" color="#34a5eb">
                      <?php
                          $countQ = "SELECT COUNT(*) as `count` FROM `newspaper`";
                          $result = mysqli_query($con,$countQ);
                          if ($result) {
                            echo mysqli_fetch_assoc($result)['count'];
                          }
                      ?>
                      </font>
                      
                    </div>
                  </div>
              </div>
              
               <div class="col-3">
                  <div class="card mt-3" style="width:240px;">
                    <div class="card-body">
                      <h5 class="card-title">Sales</h5>
                      
                      <font class="card-text" style="font-size: 40px" color="#34a5eb">
                      <?php
                          $countQ = "SELECT COUNT(*) as `count` FROM `purchases`";
                          $result = mysqli_query($con,$countQ);
                          if ($result) {
                            echo mysqli_fetch_assoc($result)['count'];
                          }
                      ?>
                      </font>
                      
                    </div>
                  </div>
              </div>


              <?php


                  $lite1month = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Lite 1 month'" ))['price'];
                  $lite1year = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Lite 1 year'" ))['price'];
                  $gold1month = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Golden 1 month'" ))['price'];
                  $gold1year = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `package` WHERE `pkg_name`='Golden 1 year'" ))['price'];

                  

                  /*add new price to pkgs*/
                  if (isset($_POST['save'])) {
                    

                    $res_count = mysqli_query( $con,"SELECT COUNT(*) as `count` FROM `package` WHERE `pkg_name`='{$_POST['pkg']}' ");

                    if (1 == mysqli_fetch_assoc($res_count)['count']) {
                      $add_pkgQ = "UPDATE `package` SET `price`= {$_POST['price']} WHERE `pkg_name`='{$_POST['pkg']}'";
                    }else{
                      $add_pkgQ = "INSERT INTO `package` (`pkg_name`,`price`) VALUES ('{$_POST['pkg']}' ,{$_POST['price']} ) ";
                    }

                    
                    $res_addpkg = mysqli_query($con, $add_pkgQ);

                    if($res_addpkg){
                        //echo "<script>alert('Successfuly update package.')</script>";
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


              ?>


              <div class="col-12 mt-5">
                <div class="card" >
                    <div class="card-body">
                      <h5 class="card-title"><font color="#34a5eb">P</font>ackages</h5>

                
                <table class="table table-striped ">
                  <thead>
                    <tr>
                      <th scope="col">Package name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <form action="admin.php" method="post">
                      <td>Lite 1 month</th>
                      <td> 
                        <div class="form-group row">
                          <label for="price" class="col-sm-1 col-form-label">Rs.</label>
                             <input type="text" name="price" value=<?php echo "'{$lite1month}'"; ?> class="form-control text_width">
                          </div>
                       </td>
                      <td>
                        <input type="hidden" name="pkg" value="Lite 1 month" >
                        <input type="submit" name="save" value="Save" class="btn btn-primary">  
                      </td>
                     </form>
                    </tr>
                    <tr>
                      <form action="admin.php" method="post">
                      <td>Lite 1 year</th>
                      <td> 
                        <div class="form-group row">
                          <label for="price" class="col-sm-1 col-form-label">Rs.</label>
                             <input type="text" name="price" value=<?php echo "'{$lite1year}'"; ?> class="form-control text_width">
                          </div>
                       </td>
                      <td>
                        <input type="hidden" name="pkg" value="Lite 1 year" >
                        <input type="submit" name="save" value="Save" class="btn btn-primary">  
                      </td>
                      </form>
                    </tr>
                    <tr>
                      <form action="admin.php" method="post">
                      <td>Golden 1 month</th>
                      <td> 
                        <div class="form-group row">
                          <label for="price" class="col-sm-1 col-form-label">Rs.</label>
                             <input type="text" name="price" value=<?php echo "'{$gold1month}'"; ?> class="form-control text_width">
                          </div>
                       </td>
                      <td>
                        <input type="hidden" name="pkg" value="Golden 1 month" >
                        <input type="submit" name="save" value="Save" class="btn btn-primary">  
                      </td>
                      </form>
                    </tr>
                    <tr>
                      <form action="admin.php" method="post">
                      <td>Golden 1 year</th>
                      <td> 
                        <div class="form-group row">
                          <label for="price" class="col-sm-1 col-form-label">Rs.</label>
                             <input type="text" name="price" value=<?php echo "'{$gold1year}'"; ?> class="form-control text_width">
                          </div>
                       </td>
                      <td>
                        <input type="hidden" name="pkg" value="Golden 1 year" >
                        <input type="submit" name="save" value="Save" class="btn btn-primary">  
                      </td>
                     </form>
                    </tr>
                  </tbody>
                </table>

              </div>

            </div>
          </div>


          <?php

            if (isset($_POST['insert'])) {
              
              $insert_catQ = "INSERT INTO `category` (`category_name`) VALUES ('{$_POST['cat_insert']}')";
              mysqli_query($con,$insert_catQ );
            }
          ?>

          <div class="col-12">
            <div class="card mt-5" >
                    <div class="card-body">
                      <h5 class="card-title"><font color="#34a5eb">C</font>ategory</h5>

                      <form action="admin.php" method="post">
                    
                        <div class="form-group row">
                          <label for="cat_insert" class="col-sm-2 col-form-label">Insert category</label>
                            <input type="text" name="cat_insert" class="form-control text_width">
                            <input type="submit" name="insert" value="Insert" class="btn btn-primary ml-2">  
                          </div>
                       
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">Category name</th>
                       </tr>
                      </thead>
                      <tbody>

                        <?php

                            $get_catsQ = "SELECT * FROM `category`";

                                  $res_cats = mysqli_query($con, $get_catsQ);

                                  if ($res_cats) {
                                    
                                     while($cat = mysqli_fetch_assoc($res_cats)){
                                        echo "<tr>                    
                                                <td>{$cat['category_name']}</td>
                                              </tr>";

                                     }
                                  }
                        ?>
                       
                        
                      </tbody>
                    </table>
                       
                       
                     
                     </form>

                    </div>
              </div>
          </div>

                

              
                          
            </div>

                    
        </div>




</body>
</html>