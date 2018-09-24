//user id for this page
let user_id=$('#user_id').val();

$(document).ready(function(){
    //call the refresh function
        refresh();


});


//
$('#logout').on('click',function(e){

        //email
        let email=$(this).attr('email');

          //ajax request
        $.ajax({
               method:'POST',
               url:"../module/requestController.php",
             data:{action:'logout',data:email},
               success:function(data,status){
                      
                      //window.location.replace thre ur
                      window.location.replace('../index.php');       

               }
        });
    
       return false;
});

//refresh function
function refresh()
{
   

     getOnlineOfflineUser(1);

     //get offline user

     getOnlineOfflineUser(0);
    
    getFollowedUsers(user_id);

 
}


//get online offline user
function getOnlineOfflineUser(online_offline)
{
         //on 1 off 0
         if(online_offline==1){
                      //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'online-offline-users',data:online_offline},
                             success:function(data,status){
                                    //online user
                                    $('#online-user').html(data);

                                 

                             }
                      });
         }else{

                    //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                           data:{action:'online-offline-users',data:online_offline},
                             success:function(data,status){
                                    //online user
                                    $('#offline-user').html(data);

                             }
                      });
         }
}

//get follwed users 
function getFollowedUsers(user_id)
{
          
                     //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'get-followed-users',data:user_id},
                             success:function(data,status){
                                          
                                          $('#followed-unfollowed').html(data);

                             }
                      });
}

//follow un follow
function follow(event,id)
{                    

                  //follow unfollow user
          
                   $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'follow-unfollow-users',data:id,follower_id:user_id},
                             success:function(data,status){
                                    
                                      getFollowedUsers(user_id);

                             }
                      });
       
}

//function to unfollow
function unfollow(event,id)
{
        window.alert(id);
        window.alert(user_id);
}