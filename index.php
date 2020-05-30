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
      <li class="nav-item active">
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
                <div class="col-md-3">
                    <h3>Categories</h3>

                    <div id="accordion" class="mt-4 mb-4">
                     

                      <?php 

                          $get_catsQ = "SELECT * FROM `category`";

                          $res_cats = mysqli_query($con, $get_catsQ);

                          if ($res_cats) {
                                    
                          while($cat = mysqli_fetch_assoc($res_cats)){

                              /* get all newspapers category wise */

                              $cat_itemsQ = "SELECT `name` FROM `newspaper` WHERE `category_id` = {$cat['category_id']} GROUP BY `name`";

                              $res_cat_items = mysqli_query($con, $cat_itemsQ);

                              echo "<div class=\"card\">
                                    <div class=\"card-header\" id=\"headingOne\">
                                    <h5 class=\"mb-0\">
                                    <button class=\"btn btn-link custom_link\" data-toggle=\"collapse\" data-target=\"#collapse{$cat['category_id']} \" aria-expanded=\"false\" aria-controls=\"collapse{$cat['category_id']}\">

                                            {$cat['category_name']}
                                    </button>
                                    </h5>
                                    </div>


                                    <div id=\"collapse{$cat['category_id']}\" class=\"collapse\" aria-labelledby=\"headingOne\" data-parent=\"#accordion\">
                                    <div class=\"card-body\">
                                          <dt>";

                                            while ($item = mysqli_fetch_assoc($res_cat_items)) {
                                              echo "<dd><a href='index.php?item={$item['name']}' >{$item['name']} </a></dd>";
                                            }
                              
                              echo        "</dt>
                                    </div>
                                    </div>
                                    </div>
                              ";
                          }
                         }

                   ?>
                    
                  </div>

                </div>

                <div class="col-md-9">
                    

                    <!-- carosol -->
                    <div class="bd-example">
                      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img src="imgs/carousel/1.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>First slide label</h5>
                              <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            <img src="imgs/carousel/2.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Second slide label</h5>
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                          </div>
                          <div class="carousel-item">
                            <img src="imgs/carousel/3.jpg" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                              <h5>Third slide label</h5>
                              <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                            </div>
                          </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                        </a>
                      </div>
                    </div>

                    <!--          Items display            -->
                    <div class="card-deck mt-3 ">
                        <?php
                          //require_once("inc/item-loader.php"); meken db  eken load wenne data
                        ?>
                        <!-- Me tike structure eka hadapan -->
                          <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="imgs/products/1.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Pariganaka</h5>
                              <p class="card-text">Wijaya pariganaka monthly magazine,<b>September 2018</b></p>
                              <a href="#" class="btn btn-primary">Preview</a>
                              <a href="#" class="btn btn-danger">Add to cart</a>
                            </div>
                          </div>

                          <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="imgs/products/2.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Pariganaka</h5>
                              <p class="card-text">Wijaya pariganaka monthly magazine,<b> February 2016</b></p>
                              <a href="#" class="btn btn-primary">Preview</a>
                              <a href="#" class="btn btn-danger">Add to cart</a>
                            </div>
                          </div>
                          <div class="w-100 d-none d-sm-block d-md-none"><!-- wrap every 2 on sm--></div>
                          <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="imgs/products/3.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Pariganaka</h5>
                              <p class="card-text">Wijaya pariganaka monthly magazine,<b> January 20218</b></p>
                              <a href="#" class="btn btn-primary">Preview</a>
                              <a href="#" class="btn btn-danger">Add to cart</a>
                            </div>
                          </div>

                           <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="imgs/products/3.jpg" alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">Pariganaka</h5>
                              <p class="card-text">Wijaya pariganaka monthly magazine,<b> January 20218</b></p>
                              <a href="#" class="btn btn-primary">Preview</a>
                              <a href="#" class="btn btn-danger">Add to cart</a>
                            </div>
                          </div>
                          
                    </div>
                      <!-- Me tike structure eka hadapan -->
                    
                </div>


            </div>

            

        </div>




</body>
</html>