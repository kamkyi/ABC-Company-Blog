<?php
   
   //require
   require_once('../config/database.php');
   require_once('../view/view.php');

   //class request controller
   class requestController extends database{

   	         private $action;

   	         public function __construct()
   	         {
                         if(isset($_POST['action']))
                         {
                         	      //set the section value

                         	      $this->action=$_POST['action'];

                                  //check the action value
                         	      switch ($this->action) {
                         	      	//case register user
                         	      	case 'register-user';
                         	      	     //do stuff here
                         	      	     $this->registerUser($_POST['data']);

                         	      		break;
                         	       case 'create-post';
                         	      	     //do stuff here
                         	      	     $this->createPost($_POST['data'],$_POST['user_id']);

                         	        break;
                                  case 'get-followed-users':


                                        //dot the followed users
                                        $multi_arr=$this->getFollowedUsers($_POST['data']);

                                        view::showFollowers($multi_arr);


                                    break;
                                  case 'edit-posted':
                                            //get the post to edit
                                            $res=$this->getPostToEdit($_POST['user_id'],$_POST['post_id']);

                                             //call the view class
                                              view::showPostToEdit($res);
                                            
                                    break;
                         	        case 'get-posts':
                         	                //user id
                                          $user_id=$_POST['user_id'];

                                          //dataObj
                                          $dataObj=$this->getPosts($user_id);

                                        

                         	        	    //parst the value into view
                         	        	     view::Posts($dataObj);

                         	        break;
                         	        case 'login-user':

                         	                //data
                         	                 $this->loginUser($_POST['data']);
                         	            
                         	        break;
                                  case 'follow-unfollow-users':
                                            //follow now
                                            $this->followNow($_POST['follower_id'],$_POST['data']);
                                    break;
                                      case 'block-user':
                                            //follow now
                                            $this->blockNow($_POST['blocker_id'],$_POST['data']);
                                    break;
                         	        case 'logout':
                         	        	   
                         	        	   //unset the session token
                         	        	   
                         	        	   unset($_SESSION['token']);

                                       unset($_SESSION['user_id']);


                         	        	   //logout fromt the database
                         	        	   $this->logOut($_POST['data']);





                         	        	break;
                                    case 'get-users-to-follow-or-block':

                                            //get users to follow of bloack
                                           // 0 array must be normal usesr 1 array must be blocked user

                                           $multi_array=$this->getUsersToFollowOrBlock($_POST['data']);


                                          //show users in types
                                           view::showUsersType($multi_array);




                                      break;

                                    case 'news-feeds':
                                            //$this-
                                            $posts=$this->newsFeeds($_POST['data']);

                                            view::newsFeeds($posts);

                                      break;

                                 case 'online-offline-users':

                                         //get online offline user

                                          $res=$this->getOnlineOfflineUsers($_POST['data']);

                                          //parse into view
                                           view::OnLineOfflineUsers($res);
                                   break;
                         	      	
                         	      	default:
                         	      	            echo "Action Blocked !";
                         	      		break;
                         	      }
                         }
   	         }
   }



   //run request controller
   new requestController();
?>