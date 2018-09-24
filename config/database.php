<?php

//require
 require_once('../config/config.php');
 require_once('../PusherBackEnd.php');

//class database
class database extends config{

	      //get post to edit
	      protected function getPostToEdit($user_id,$post_id)
	      {
                 //get the specific post to edit by user id
	      	     $sql='select * from posts where user_id="'.$user_id.'" and id="'.$post_id.'"';

	      	       //get the connection 
		      	    $conn=$this->getConnection();

                    //result
		      	    $res=$conn->query($sql);

                   //check the number ros
		      	    if($res->num_rows>0)
		      	    {
                             return $res;
		      	    }else{
		      	    	     return 0;
		      	    }



	      }

	      //get followed users
	      protected function getFollowedUsers($user_id)
	      {
                     //followed user array and  unfollowed user array and multi array
                     $multi=$followed_users=$un_followed_users=array();

                     //followed user sql
	      	         $followed_user_sql='select * from users inner join followed on users.id=followed.user_id_two where followed.user_id_one="'.$user_id.'" and not followed.user_id_two in(select user_id_two  from blocked where user_id_one="'.$user_id.'")';

	      	         //not followed user sql
	       $un_followed_user_sql='select * from users where id not in (select user_id_two from followed where user_id_one="'.$user_id.'") and id not in(select user_id_two from blocked where user_id_one="'.$user_id.'") and id!="'.$user_id.'"';


		     	    //get the connection 
		      	    $conn=$this->getConnection();


		      	   //followed user res
                   $followed_res=$conn->query($followed_user_sql);


                   if($followed_res->num_rows>0)
                   {
                   	           while ($rows=$followed_res->fetch_assoc()) {
                   	           	           
                   	           	           //array push
                   	           	           array_push($followed_users,$rows);
                   	           }
                   }

                   //unfollowed user
                   $unfollowed_res=$conn->query($un_followed_user_sql);

                   if($unfollowed_res->num_rows>0)
                   {
                   	         while ($rows=$unfollowed_res->fetch_assoc()) {
                   	           	           
                   	           	           //array push
                   	           	           array_push($un_followed_users,$rows);
                   	         }

                   }


                   //push the array in multi
                   array_push($multi,$followed_users,$un_followed_users);

                   //return multi
                   return $multi;



	      }
	      //block now
	      protected function blockNow($blocker_id,$blocked_id)
	      {
	      	      //insert blocker id into user_id_one
	      	      //insert blocked id int user_id_two
	      	      //blocker id is your id
	      	      //blocked id is blocked userid


		     	    //get the connection 
		      	    $conn=$this->getConnection();

	      	      
                   //select * if user is alrady blocked or not
                   $sql='select id from blocked where user_id_one="'.$blocker_id.'" and user_id_two="'.$blocked_id.'"';
                  
                   //$res
                   $res=$conn->query($sql);


                   //check the result
                   if($res->num_rows>0)
                   {
                   	       //delect blocked
                   	      $sql="DELETE FROM blocked WHERE user_id_one='".$blocker_id."' and user_id_two='".$blocked_id."'";
                          //unblock
                   	      $conn->query($sql);

                   	      echo "Unblocked !";
                   }else{

                   	     //sql to block 
	      	             $sql='insert into blocked (user_id_one,user_id_two) values("'.$blocker_id.'","'.$blocked_id.'")';

                   	     //block now
                   	     $conn->query($sql);

                   	     //And also remove follow information list

                	     $sql="DELETE FROM followed WHERE user_id_one='".$blocker_id."' and user_id_two='".$blocked_id."'";


                         //unfollow now
                   	     $conn->query($sql);

                   	     echo "Blocked!";

                   }



          
                   


	      }

	     //follow now
	     protected function followNow($follower_id,$followed_id)
	     {
                 //insert follower id into user_id_one
	     	     //insert was followed user id into user_id_two
	     	     //follower id is your id
	     	     //followed id is has followed user id 

	     	  

	     	    //get the connection 
	      	    $conn=$this->getConnection();

	      	    //sql to check already followed or not
                
                $sql='select id from followed where user_id_one="'.$follower_id.'" and user_id_two="'.$followed_id.'"';


                //res
                $res=$conn->query($sql);

                //check res
                if($res->num_rows>0)
                {
                	 //if followed delete the request
                	  $sql="DELETE FROM followed WHERE user_id_one='".$follower_id."' and user_id_two='".$followed_id."'";

                	 //unfollowed

		     	     $conn->query($sql);

		     	     echo "Un Followed !";

                }else{

	                 //sql insert into data
		     	     $sql="insert into followed (user_id_one,user_id_two) values('".$follower_id."','".$followed_id."')";

		     	     //followed 

		     	     $conn->query($sql);


		     	     echo "Followed !";

                }




	     	   
	     }

	     //get users to follow or block
	     protected function getUsersToFollowOrBlock($user_id)
	     {
	     	      
	     	      //blocked user array adm unblocked user array and multi array
	     	      $multi=$blocked_users=$unblocked_users=array();

	     	      //sql to pull blocked user
	     	      $sql='select * from users where id in (select user_id_two from blocked where user_id_one="'.$user_id.'")';

	     	     //get the connection 
	      	     $conn=$this->getConnection();

	      	     //result from the blocked user
	      	     $res=$conn->query($sql);

	      	     //check the res
	      	     if($res->num_rows>0)
	      	     {
	      	     	    while ($rows=$res->fetch_assoc()) {
	      	     	               
                                array_push($blocked_users,$rows);
	      	     	    }
	      	     }

                  //sql to pull blocked user
	     	      $sql='select * from users where id not in (select user_id_two from blocked where user_id_one="'.$user_id.'") and id !="'.$user_id.'"';

	     	      //result from the blocked user
	      	     $res=$conn->query($sql);

	      	     //check the res
	      	     if($res->num_rows>0)
	      	     {
	      	     	    while ($rows=$res->fetch_assoc()) {
	      	     	               
                                array_push($unblocked_users,$rows);
	      	     	    }
	      	     }

	      	     //push the array in 
	      	     array_push($multi,$blocked_users,$unblocked_users);


	      	     //return multi array
	      	     return $multi;


	     }

	     //news feedsf function
	     protected function newsFeeds($user_id)
	     {
               
              /*new feed*/
              $sql='select * from posts inner join users on users.id=posts.user_id where posts.user_id in(select user_id_two from followed where user_id_one="'.$user_id.'") and posts.user_id not in(select user_id_two from blocked where user_id_one="'.$user_id.'" ) order by created_at desc limit 5';

               //post array
               $posts=array();

	     	     //get the connection 
	      	     $conn=$this->getConnection();

	      	     //result from the blocked user
	      	     $res=$conn->query($sql);

	      	     //check the res
	      	     if($res->num_rows>0)
	      	     {
	      	     	    while ($rows=$res->fetch_assoc()) {
	      	     	               
                                array_push($posts,$rows);
	      	     	    }
	      	     }else{
	      	     	          array_push($posts,array('username'=>'Follow Favourite Users to See their Posts !',

	      	     	          	'post'=>'<center><h1>Follow Now</h1><a class="btn btn-info" href="followed.php?token='.$_SESSION['token'].'">Follow Users Now !</a></center>',
	      	     	          	'online'=>true
	      	     	          ));
	      	     }
                 

                 //return posts array;
                 return $posts;
	      	     

	     }

	      //get online offline users
	      protected function getOnlineOfflineUsers($online_offline_users)
	      {
	      	    //check
	      	    if($online_offline_users==1)
	      	    {
	      	    	   $sql="select * from users where online='1'";
	      	    }else{

	      	    	   $sql="select * from users where online='0'";
	      	    }

	      	     //get the connection 
	      	     $conn=$this->getConnection();

	      	     //return res

	      	     return $conn->query($sql);
	      }

	       //logout the user

	      protected function logOut($email)
	      {
	      	     //get the connection 
	      	     $conn=$this->getConnection();

	      	     //query the user
	      	     $sql='UPDATE users SET online="0" WHERE email="'.$email.'"';

			       if($conn->query($sql))
			       {
			       	     echo "Logged Out !";
			       }else{
			       	     echo "Error";
			       }
                                //push serv

			       	      	    $push=new PusherTech();
			       	      	    $push->pushNowNow();
	      }

	       //login the database
	      protected function loginUser($data)
	      {
	      	      //user array
	       	      $user=array(
	       	      	     'email'=>$data[0]['value'],
	       	      	     'password'=>$data[1]['value'],
	       	      	     'token'=>$data[2]['value']
	       	      );
                  
                  //messages array
                  $message=array();

	       	      //sql query 
	       	      $sql="select * from users where email='".$user['email']."'";

	       	      //query the data into the database
	       	      $conn=$this->getConnection();
                  
                  //messasge
                  $messasge=array();

	       	      //res
	       	      $res=$conn->query($sql);
                   
                  //check the user
	       	      if($res->num_rows>0)
	       	      {
	       	      	     
	       	      	   //check the password 
	       	      	   while ($rows=$res->fetch_assoc()) {
	       	      	               
                                   //verify the password
	       	      	                if(password_verify($user['password'],$rows['password'])){
	       	      	                	     //  //online user

					                            $sql='UPDATE users SET online="1" WHERE email="'.$user['email'].'"';

					                            $conn->query($sql);

					                               //set the user name and passwor and token into session
					                                
					                                $_SESSION['user_id']=$rows['id'];
					                                $_SESSION['username']=$rows['username'];
								       	      	    $_SESSION['email']=$user['email'];
								       	      	    $_SESSION['password']=$user['password'];
								       	      	    $_SESSION['token']=$user['token'];

								       	      	    //push the messages into message array

								       	      	    array_push($message,array(
								       	      	    	  'message'=>'Successfully Logged in !',
								       	      	    	  'redirect'=>true,
								       	      	    	  'token'=>$_SESSION['token']
								       	      	    ));
	       	      	                }else{

								       	      	    //push the messages into message array

								       	      	    array_push($message,array(
								       	      	    	  'message'=>'Password Do not match !',
								       	      	    	  'redirect'=>false
								       	      	    ));
	       	      	                }
	       	      	   }





	       	      }else{
	       	      	        
			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'No user !',
			       	      	    	  'redirect'=>false
			       	      	    ));
	       	      }
                   //return json
	       	      echo json_encode($message);
	      }

	       //get the posts
	       protected function getPosts($user_id){

	       	      //query the data into the database
	       	      $conn=$this->getConnection();

	       	      //sql to get the posts

	       	      $sql='select * from users inner join posts on users.email=posts.user_email where users.id="'.$user_id.'" order by created_at desc limit 20';

	       	      // echo $sql;

	       	      // posts array;
	       	      $posts=array();
                  
                  //query the posts
	       	      if($conn->query($sql)->num_rows>0){
                           
                           //return $res 
	       	      	       $res=$conn->query($sql);

	       	      	       //return res
	       	      	       $data=$res;


	       	      }else{
	       	      	       $data=0;
	       	      }
              
                //return the data
	       	    return $data;

	       	      
	       }
           
           //create post
	       protected function createPost($data,$user_id)
	       {
	       	       session_start();
	       	       //user array
	       	      $user=array(
	       	      	      'email'=>$data[0]['value'],
	       	      	      'post_content'=>$data[1]['value']
	       	      );

	       	      //message array
	       	      $message=array();

	       	     //sql to query
	       	      $sql="insert into posts(user_id,user_email,post) values('".$_SESSION['user_id']."','".$user['email']."','".$user['post_content']."')";


	       	      //query the data into the database
	       	      $conn=$this->getConnection();


	                      //if not created users !
	       	      	      if($conn->query($sql)==TRUE)
			       	      {

			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'Successfully Posted !',
			       	      	    	  'redirect'=>false,
			       	      	    ));

			       	      	    //push the notification via the pusher web services

			       	      	    $push=new PusherTech();
			       	      	    $push->pushNow('created-post');


			       	       }else{
                               

			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'Successfully Posted !',
			       	      	    	  'redirect'=>false,
			       	      	    ));

			       	       }

	       	      echo json_encode($message);
	       }

           //register the user here

	       protected function registerUser($data)
	       {
                  //user array
	       	      $user=array(
	       	      	     'username'=>$data[0]['value'],
	       	      	     'email'=>$data[1]['value'],
	       	      	     'password'=>password_hash($data[2]['value'],PASSWORD_DEFAULT),
	       	      	     'token'=>$data[4]['value']
	       	      );
                  
                  //messages array
                  $message=array();

	       	      //sql query 
	       	      $sql="insert into users (username,email,password) values('".$user['username']."','".$user['email']."','".$user['password']."')";

	       	      //sql to check already registered or not
	       	      $sql_to_check_alredy_registered_or_not='select email from users where email="'.$user['email'].'"';

	       	      //query the data into the database
	       	      $conn=$this->getConnection();

	       	      //check the user already existed !

	       	      if($conn->query($sql_to_check_alredy_registered_or_not)->num_rows>0)
	       	      {
	       	      	      
			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'User already existed !',
			       	      	    	  'redirect'=>false
			       	      	    ));
	       	      }else{
	       	      	      //if not created users !
	       	      	      if($conn->query($sql)==TRUE)
			       	      {
			       	      	    //get the inserted auto user id from the user table
			       	            $user_id=mysqli_insert_id($conn);

                                //set the user name and passwor and token into session
                                $_SESSION['username']=$user['username'];
                                $_SESSION['user_id']=$user_id;
			       	      	    $_SESSION['email']=$user['email'];
			       	      	    $_SESSION['password']=$user['password'];
			       	      	    $_SESSION['token']=$user['token'];

			       	      	     //sql the to update the suer
			       	      	    $sql_to_update_online="update users set online='1' where id='".$user_id."'";

			       	      	    $conn->query($sql_to_update_online);

			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'Successfully registered !',
			       	      	    	  'redirect'=>true,
			       	      	    	  'token'=>$_SESSION['token']
			       	      	    ));


			       	      }else{
			       	      	    
			       	      	    //push the messages into message array

			       	      	    array_push($message,array(
			       	      	    	  'message'=>'Error Creating  !',
			       	      	    	  'redirect'=>false
			       	      	    ));
			       	      }
	       	      }
                  //return json message
	       	      echo json_encode($message);

	       	     
	       }
}

?>