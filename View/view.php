<?php
//session start(0)
session_start();

  //class view 
  class view{

           //show posts to edit
          public static function showPostToEdit($res)
          {
                       while ($rows=$res->fetch_assoc()) {
                                ?>
                                   <!-- container -->
                                
                                          <!-- updat post form -->
                                                    <form id="post-edit-form">
                                                              <textarea required="" class="form-control" style="height:100%;margin-top:3px;resize: vertical;"><?php echo $rows['post'];

                                                                   echo $rows['id'];
                                                              ?>
                                                                </textarea>
                                                                <div class="jumbotron">
                                                                         <center><label>Update your post</label></center>
                                                                </div>
                                                                <div class="btn-group pull-right">
                                                                  <input type="submit" name="" class="btn btn-primary" value="Save">
                                                                  
                                                                </div>
                                                    </form>
                                          <!-- update post form end -->
                                  
                                   <!-- container end -->
                                <?php
                       }
          }

          //news feeds 
            public static function newsFeeds($posts)
            {
                   //loop through the posts
                   foreach ($posts as $post) {
                              
                        ?>
                        <!-- posts  -->
                        <div class="panel panel-default">
                          <div class="panel-heading">

                          <?php 
                             echo  ($post['online'])?'<span class="label label-success"> online</span>':'<span class="label label-primary"> offline</span>';  
                          ?>

                          <?php echo $post['username']; ?>

                         
                            
                          </div>
                          <div class="panel-body"><?php echo $post['post']; ?></div>
                          <div class="panel-footer">Hello</div>
                        </div>
                        <!-- posts end -->
                        <?php
                   }
            }

            //show followed or unfollowed user
           public static function showFollowers($multi_arr)
           {
                     //array zero is followed user info
                      //array 1 is unfollowed user info
                     foreach ($multi_arr[0] as $f_user) {
                               echo '<li class="list-group-item">'.$f_user['username'].'<a onclick="follow(event,'.$f_user['user_id_two'].')"  href="#" class="btn btn-danger btn-xs pull-right">Following</a></li>';
                     }

                     //array zero is followed user info
                      //array 1 is unfollowed user info
                     foreach ($multi_arr[1] as $un_f_user) {
                                 
                                echo '<li class="list-group-item">'.$un_f_user['username'].'<a onclick="follow(event,'.$un_f_user['id'].')"  href="#" class="btn btn-success btn-xs pull-right">Follow</a></li>';
                     }
                    



           }

            //follow user
            public static function followUser($res)
            {
                      while ($rows=$res->fetch_assoc()) {
                                  echo "<li class='list-group-item'>".$rows['username']."<span class='btn btn-success btn-xs pull-right' >Follow</span><span class='btn btn-success btn-xs pull-right' style='margin-right:2px'>Timeline</span><span class='btn btn-danger btn-xs pull-right' style='margin-right:2px'>Block</span></li>";
                      }
            }
            
            public static function Greeting($data)
            {
                    echo var_dump($data);
            }
            //show user time

            public static function showUsersType($multi_array)
            {             
                          //blocked users
                          foreach ($multi_array[0] as $blocked) {
                            # code...
                                       

                                        echo '<li class="list-group-item">'.$blocked['username'].'<a onclick="block(event,'.$blocked['id'].')"  href="#" class="btn btn-primary btn-xs pull-right">Un-Block</a></li>';
                          }

                          //un blocked users
                          foreach ($multi_array[1] as $un_blocked) {
                            # code...
                                      

                                  echo '<li class="list-group-item">'.$un_blocked['username'].'<a onclick="block(event,'.$un_blocked['id'].')"  href="#" class="btn btn-danger btn-xs pull-right">Block</a></li>';
                          }
            }

            public static function OnLineOfflineUsers($res)
            {
                   if($res->num_rows>0)
                   {
                          while($rows=$res->fetch_assoc())
                          {
                                   //online offline variable
                                    $online_offline=($rows['online'])?'<span class="label label-success">online</span>':'<span class="label label-danger">offline</span>';
                                    
                                    //online offline variable

                                    echo '<li class="list-group-item">'.$rows['username'].' '.$online_offline.'</li>';
                          }
                   }else{
                           echo "<li class='list-group-item'>No users</li>";
                   }
            }


            //posts 
            public static function Posts($data)
            {
                  

                   if($data=="0")
                   {
                         echo ' <div class="panel panel-default">
                                  <div class="panel-body" style="text-align:center">No posts !</div>
                                </div>';
                   }else{
                          
                            //cchek the data
                            if($data->num_rows>0)
                            {     
                                    /*panel groue*/
                                    echo "<div class='panel-group'>";
                                      
                                      while ($rows=$data->fetch_assoc()) {
                                                 
                                                 echo   ' <!-- bootstarp panel -->
                                                         <div class="panel panel-default">
                                                            <div class="panel-heading">'.$rows['username'].' <i> ( You )</i></div>
                                                            <div class="panel-body">'.$rows['post'].'</div>
                                                            <div class="panel-footer">
                                                                <div class="btn-group">
                                                                      
                                                                    <a href="" class="btn btn-xs btn-success"><i>Uploaded at : </i>'.$rows['created_at'].'</a>
                                                                    <a href="" class="btn btn-xs btn-danger">Delete</a>
                                                                    <a href="" class="btn btn-xs btn-primary" onclick="editOnTimeLine(event,'.$rows['user_id'].','.$rows['id'].')">Edit</a>
                                                                </div>
                                                            </div>
                                                          </div>
                                                          <!-- bootstrap panel end -->';
                                      }

                                    echo "</div>";
                                    /*panel group end*/
                            }

                   }
                 
            }
  }
?>