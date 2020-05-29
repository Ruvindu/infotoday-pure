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
                    <h3 class="mb-3">Feedback</h3>
                    <form action="aboutus.php" method="post">
                    <table cellpadding="4">
                      <tr>
                        <td>
                          <div class="form-group">
                            <input type="text" name="username" placeholder="Name" class="form-control text_width1" required>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td> 
                          <div class="form-group">
                            <input type="text" name="email" placeholder="Email" class="form-control text_width1" required>
                          </div>
                        </td>
                       
                      </tr>

                      <tr>
                        <td>

                          <div class="form-group">
                            <textarea name="message" rows="5" placeholder="Type your message..." class="form-control text_width1" required></textarea> 
                          </div>

                        </td>
                      </tr>
                    
                      <tr>
                        <td align="right"> 
                          <div class="form-group">
                            <input type="submit" name="send" value="Send" class="btn btn-info" required>
                          </div>
                        </td>
                       
                      </tr>


                    </table>
                  </form>
                   
                </div>

                <div class="col-md-6">
                  <table>
                    <tr>
                      <th>Contact us</th>
                    </tr>
                    <tr>
                      <td>infotoday@gmail.com</td>
                    </tr>
                    <tr>
                      <td>+94784446639</td>
                    </tr>
                  </table>
                  <table class="social mt-3" cellpadding="3px">
                    <tr>
                      <td><img src="imgs/fb.png" width="50px" height="50px"></td>
                      <td><img src="imgs/twitter.png" width="50px" height="50px"></td>
                      <td><img src="imgs/instagram.png" width="50px" height="50px"></td>
                      <td><img src="imgs/google.png" width="50px" height="50px"></td>
                    </tr>
                  </table><br>
                  <div class="card" style="background-color: rgba(245, 245, 245, -5); width: 700px;margin-top: 5px;">
                    <div class="card-body">
                      <p>
                        <b>InfoToday</b> will be a General partnership business registered in the state of <b>Wejewardana Mawaththa, Colombo 10, and Sri Lanka</b>. The company will be jointly owned by <b>Mr. Manura Lakshan, Ruvindu Madhushanka, Tharindu Madushanka and Fathima Minha</b>.
                       </p>
                       <p>
                         We are have various kinds of daily newspapers & magazines suppliers who wish to <b>sell in online </b>and Owing to that our company will gain some profit by selling those newspapers and various kinds of magazines. Our facility is a former <b>8,000 square ft. furniture store which allows the company to stock a large amount of inventory</b>.
                       </p>
                       <b>Aim</b>
                       <p>   
                          Our Aim is selling World populer and local populer magazins ,newspapers for fair price and those knoladge towords to your hand by one click.
                       </p>
                     
                    </div>
                  </div>

                </div>

              
                          
            </div>

                    
        </div>




</body>
</html>