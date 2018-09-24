<?php
//session start
session_start();

//check the token to know user logged out or not

if(isset($_SESSION['token']))
{
	 //if user is not logged out
	 //rediret to dashboard
	 header('Location:View/dashboard.php?token='.$_SESSION['token']);
}else{
    ?>
      <!-- if token has unset -->
      <!DOCTYPE html>
		<html>
		<head>
			                            <title>ABC Company</title>
					                    <!-- font awesome cdn -->
										<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
										<!-- font awesome cdn end -->

		</head>
		<body>
		      <!-- jumbotron -->
		      <div class="jumbotron">
		      	 
		      </div>
		      <!-- jumbotron end -->
		      <!-- container -->
		      <div class="container">
		      	     <div class="row">
		                        
		      	     	     <!-- login column-->
		      	     	            <div class="col-sm-6">
		      	     	       	       <h2>Login Here :</h2>
		      	     	      	       <!-- form  -->
			      	     	      	       <form action="#" id='login-form'>
											  <div class="form-group">
											    <label for="allah">Email address:</label>
											    <input type="email" class="form-control" id="allah" name="email" autofocus="" required="">
											  </div>
											  <div class="form-group">
											    <label for="pwd">Password:</label>
											    <input type="password" class="form-control" id="pwd" autocomplete="" name="password" required="">
											  </div>
											   <input type="hidden" name="token" value="<?php echo generateRandomString(); ?>">
											  <div class="checkbox">
											    <label><input type="checkbox"> Remember me</label>
											  </div>
											  <button type="submit" class="btn btn-default">Login</button>
											  <button type="reset" class="btn btn-danger">Clear</button>
											</form>
		      	     	      	       <!-- form end -->
		      	     	      </div>
		      	     	     <!-- login column end -->
		      	     	     <!-- register column  -->
		      	     	       <div class="col-sm-6">
		      	     	      	         <h2>Register Here :</h2>
		      	     	      	       <!-- form  -->
			      	     	      	       <form action="#" id="register-form">
			      	     	      	       	  <div class="form-group">
											    <label for="name">User name :</label>
											    <input type="text" autofocus="" class="form-control" id="name" name="name" autofocus="" required="">
											  </div>
											  <div class="form-group">
											    <label for="email">Email address:</label>
											    <input type="email" class="form-control" id="email" name="email"  required="">
											  </div>
											  <div class="form-group">
											    <label for="blah">Password:</label>
											    <input type="password" class="form-control" id="blah" autocomplete="" name="password" required="">
											  </div>
											    <div class="form-group">
											    <label for="jesus">Password:</label>
											    <input type="password" class="form-control" id="jesus" autocomplete="" name="confirm_password" required="">
											  </div>

											  <input type="hidden" name="token" value="<?php echo generateRandomString(); ?>">
											
											  <div class="btn-group pull-right">
											  	     <button type="submit" class="btn btn-default">Register</button>
											         <button type="reset" class="btn btn-danger">Clear</button>
											  </div>
											</form>
		      	     	      	       <!-- form end -->
		      	     	      </div>
		      	     	     <!-- register column end -->
		      	     	
		      	     	     
		      	     </div>
		      </div>
		      <!-- container end -->

			<!-- jquery -->
			<script type="text/javascript" src="js/jquery.js"></script>
			<!-- jquery end -->

			<!-- bootstrap -->
			<!-- Latest compiled and minified CSS -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

			<!-- Optional theme -->
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

			<!-- Latest compiled and minified JavaScript -->
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
			<!-- bootstrap end -->

		    <!-- toast plugins -->
			<script type="text/javascript" src="node_modules/jquery-toast-plugin/src/jquery.toast.js"></script>
			<link rel="stylesheet" type="text/css" href="node_modules/jquery-toast-plugin/src/jquery.toast.css">
			<!-- toast plugins end -->


			<!-- custom js and css -->
			<script type="text/javascript" src="js/index.js"></script>
			<link rel="stylesheet" type="text/css" href="css/index.css">
			<!-- custom js and css end -->


		</body>
		</html>
      <!-- show the login and register page -->
    <?php
}
?>
<!-- php random string generator function default value is set to 60 char -->
<?php
       // randowm string generator don't worry it is easy :D

		function generateRandomString($length = 60) {
		    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
?>
<!-- php radom string genearaotr function end -->