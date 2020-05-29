<!DOCTYPE html>

<?php

  require_once("inc/connection.php");
  session_start();


  if (isset($_POST['publish'])) {


    $target_dir = "products/";
    $file_name = $_FILES['file']['name'];
    $tmp_file = $_FILES['file']['tmp_name'];
    $path_for_save = $target_dir.$file_name;

    $fileuploaded = 0;

    $fileuploaded = move_uploaded_file($tmp_file, $path_for_save);

    if ($fileuploaded) {
      
         $imgData = addslashes(file_get_contents($_FILES['thumbnail']['tmp_name']));

         $publishQ = "INSERT INTO `newspaper`(`name`, `gross_price`, `supplier_id`, `Publish_duration`, `thumbnail`, `description`, `date`, `category_id`, `file`) VALUES ('{$_POST['newspaper_name']}',{$_POST['gross_price']},{$_SESSION['usr_id']},'{$_POST['duration']}','{$imgData}','{$_POST['description']}','{$_POST['date']}',{$_POST['category']}, '{$path_for_save}')";


         if(mysqli_query($con,$publishQ)){
            echo "<script>alert('File uploaded.')</script>";
         }

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
			<li class="nav-item active">
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


        <div class="container">
            
            <div class="row mt-4">

                <div class="col-md-6">
                    <h3 class="mb-3">Publisher form</h3>
                    <form action="publisher-form.php" method="post" enctype="multipart/form-data">
                    <table cellpadding="4">

                      <tr>
                        <td>
                          <div class="form-group">
                            
                            <select name="category" class="form-control text_width1" required>
                              <option disabled selected>Select category</option>
                              
                              <?php 

                                  $get_catsQ = "SELECT * FROM `category`";

                                  $res_cats = mysqli_query($con, $get_catsQ);

                                  if ($res_cats) {
                                    
                                     while($cat = mysqli_fetch_assoc($res_cats)){
                                        echo "<option value={$cat['category_id']}> {$cat['category_name']} </option>";
                                     }
                                  }


                               ?>

                            </select>

                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="form-group">
                            <input type="text" name="newspaper_name" placeholder="Name of Newspaper or Magazin" class="form-control text_width1" required>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="form-group">
                            
                            <select name="duration" class="form-control text_width1" required>
                              <option disabled selected>Select duration</option>
                              <option value="Daily" >Daily</option>
                              <option value="Weekly" >Weekly</option>
                              <option value="Monthly" >Monthly</option>
                            </select>

                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="form-group">
                            <textarea name="description" rows="5" placeholder="Type Description here..." class="form-control text_width1" required></textarea> 
                          </div>
                        </td>
                      </tr>

          
                      <tr>
                        <td>
                          <div class="form-group">
                             <input name="date" placeholder="Date" onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control text_width1" required>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <div class="form-group">
                             <input type="text" name="gross_price" placeholder="Gross Price (RS.)" class="form-control text_width1" required>
                          </div>
                        </td>
                      </tr>


                      <tr>
                        <td>
                          <div class="form-group">
                             Thumbnail : <input type="file" name="thumbnail" accept="image/*" id="fileToUpload" required> 
                          </div>
                        </td>
                      </tr>

                       <tr>
                        <td>
                          <div class="form-group">
                             File : <input type="file" name="file" accept=".pdf" id="fileToUpload" required>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td align="right"> 
                          <div class="form-group">
                            <input type="submit" name="publish" value="Publish now" class="btn btn-info" required>
                          </div>
                        </td>
                      </tr>




                    </table>
                  </form>
                   
                </div>

                <div class="col-md-6">
                 
                </div>

              
                          
            </div>

                    
        </div>




</body>
</html>