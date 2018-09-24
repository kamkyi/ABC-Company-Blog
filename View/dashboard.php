<?php
     //session start
     session_start();
     //open the page by token

     if(isset($_GET['token']) and isset($_SESSION['token'])){
     	   if($_GET['token']==$_SESSION['token']){
     	   	   ?>

     	   	      <!-- html -->
     	   	      <!DOCTYPE html>
							<html>
							<head>
								<title>ABC Company</title>
							
								<!-- font awesome cdn -->
								<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
								<!-- font awesome cdn end -->
								<!-- pusher tech js -->
								  <script src="https://js.pusher.com/4.3/pusher.min.js"></script>
								  <script type="text/javascript" src="../js/pusherTech.js"></script>
								<!-- pusher tech js end -->

							</head>
							<body>

								   <!-- hidden user id-->
								     <?php
								               if(isset($_SESSION['user_id'])){
								              ?>
                                      <!-- hidden user id -->
								      <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                                      <!-- hidden user id -->
								              <?php
								               }
								     ?>
								   <!-- hidden user id  -->
							    
							      <!-- navbar  -->
							      <nav class="navbar navbar-default">
									  <div class="container-fluid">
									    <div class="navbar-header">
									      <a class="navbar-brand" href="#">ABC Company</a>
									    </div>
									    <ul class="nav navbar-nav">
									      <li class="active"><a href="#">News Feeds</a></li>
									      <li><a href="timeline.php?token=<?php echo $_SESSION['token']; ?>">Timeline</a></li>
									      <li><a href="followed.php?token=<?php echo $_SESSION['token']; ?>">Following</a></li>
									      <li><a href="blocking.php?token=<?php echo $_SESSION['token']; ?>">Block List</a></li>
									      <li><a href="">Notification <span class="label label-success">12</span></a></li>
									    </ul>
									    <form class="navbar-form navbar-right" action="/action_page.php">
									        <a href="timeline.php?token=<?php echo $_SESSION['token']; ?>" class="btn btn-default">
									        	<?php echo (isset($_SESSION['username']))?$_SESSION['username']:"" ?><i> ( You )</i></a>
									      <div class="form-group">
									        <input type="text" class="form-control" placeholder="Search">
									      </div>
									      <button type="submit" class="btn btn-default">Search</button>
									         <button type="button" class="btn btn-danger" id="logout" email="<?php echo $_SESSION['email']; ?>">Logout</button>
									    </form>
									  </div>
									</nav>
							      <!-- navbar end -->



							      <!-- container -->
							      <div class="container">
							      	            <div class="col-md-3">
							      	            	    <!-- create post form -->
							      	            	    <h2>Create Post</h2>
							      	            	    <form id="create-post">
														  <div class="form-group">
														  	  <input type="hidden" name="user_mail" value="<?php echo $_SESSION['email']; ?>">
														  	  <label for="post-content">What is on your mind?</label>
														      <textarea class="form-control" id="post-content" name="post-content" autofocus="" placeholder="what is on your mind....?" required=""></textarea>
														  </div>
														
														  <button type="submit" class="btn btn-primary">Post</button>
														  <button type="reset" class="btn btn-danger">Clear</button>
														</form>
							      	            	    <!-- create post form end -->
							      	            </div>
							      	            <div class="col-md-6">
							      	            	     <!-- posted text -->
							      	            	     <div id="posted-texts">
							      	            	     	     <!-- card -->
							      	            	     	     <div class="container-fluid">
							      	            	     	     	    <div id="ajax-posts">
							      	            	     	     	    	          <!-- ajax content will come here -->
							      	            	     	     	    </div>
							      	            	     	     </div>
							      	            	     	     <!-- card end -->
							      	            	     </div>
							      	            	     <!-- posted text end -->
							      	            </div>
							      	            <div class="col-md-3">
							      	            	        <!-- online user -->
							      	            	         <div id="online-offline-users">
							      	            	         	     <!-- online  -->
							      	            	         	     <h2>Online</h2>
							      	            	         	     <!-- online end -->
							      	            	         	       <ul class="list-group" id="online-user">
																		   <!-- ajax content will come here -->
																		</ul>
																		<!-- offline  -->
							      	            	         	     <h2>Offline</h2>
							      	            	         	     <!-- online end -->
							      	            	         	       <ul class="list-group" id="offline-user">
																		   <!-- ajax content will come here -->
																		</ul>
							      	            	         </div>
							      	            	        <!-- online user end -->
							      	            </div>
							      </div>
							      <!-- container end -->
							    

								<!-- jquery -->
								<script type="text/javascript" src="../js/jquery.js"></script>
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
								<script type="text/javascript" src="../node_modules/jquery-toast-plugin/src/jquery.toast.js"></script>
								<link rel="stylesheet" type="text/css" href="../node_modules/jquery-toast-plugin/src/jquery.toast.css">
								<!-- toast plugins end -->

								<!-- custom js and css -->
						        <script type="text/javascript" src="../js/dashboard.js"></script>
						        <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
								<!-- custom js and css end -->

                                


							</body>
							</html>
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
     	   	      <!-- html end -->
     	   	   <?php
     	   }
     }else{
     	   //if token is destoryed,redirect to main page
     	   header("Location:../index.php");
     }
?>