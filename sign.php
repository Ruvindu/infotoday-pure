<!DOCTYPE html>
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
				<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Cart</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Broudgt</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">About us</a>
			</li>
			</ul>
			
			
		</div>
		</nav>



	<div class="container">
		
		<div class="row">
	

			<div class="col-12">
				<div class="custom_border signin">
				<form action="login.php" method="post">
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
						    	<input type="Email" name="user_mail" placeholder="Email" class="form-control text_width">
						    </div>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="form-group">
						    	<input type="Password" name="user_mail" placeholder="Password" class="form-control text_width">
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




			<div class="custom_border signup">
				<form action="/login" method="post">
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
						    	<input type="text" name="fname" placeholder="First name" class="form-control text_width">
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="text" name="lname" placeholder="Last name" class="form-control text_width">
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="Email" name="email" placeholder="Email" class="form-control text_width">
						    </div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="form-group">
						    	<input type="Password" name="user_mail" placeholder="Password" class="form-control text_width">
						    </div>
						</td>
					</tr>
					<tr>
						<td align="right">
							<input type="submit" name="signin" value="Sign up" class="btn btn-info">
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