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

     //get users to follow of block
     getUsers(user_id);


 
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

//get users
function getUsers(user_id)
{
                   //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'get-users-to-follow-or-block',data:user_id},
                             success:function(data,status){

                         
                                 
                                  //online user
                           
                                  // //convert the return json string to json obj
                                  //  let jsonData=JSON.parse(data);


                                  //  console.log(jsonData);


                                  //  //looping throung pure user
                                  //  $.each(jsonData[1],function(i,item){
                                                   
                                                  
            

                                  //                 //loop loopthroung the clear untouched users

                                  //                 $('#user-to-follow-or-block').append('<li style="background:linear-gradient(white,lightgrey)" class="list-group-item">'+item['username']+'<a  href="" class="btn btn-danger btn-xs pull-right" onclick="block(event,'+item['id']+')" id="'+item['id']+'">Block</a><a  href="" style="margin-right:5px;"  class="btn btn-success  btn-xs pull-right" onclick="follow(event,'+item['id']+')" id="'+item['id']+'">Follow</a></li>');
                                  //  });


                                  $('#user-to-follow-or-block').html(data);

                             


                             }
                      });
}


//follow
function follow(event,id)
{
  //preventing default
  event.preventDefault();
   
                 //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'follow-user',data:id,follower_id:user_id},
                             success:function(data,status){
                                    //online user
                                    refresh();

                                      //creat post
                                      $.toast({
                                        heading: 'Noti',
                                        text:data ,
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        stack:0,
                                        position:'bottom-right'
                                    });

                             }
                      });

                    return false;
}

//block
function block(event,id)
{
                 //preventing default
                event.preventDefault();
   
                 //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                             data:{action:'block-user',data:id,blocker_id:user_id},
                             success:function(data,status){
                                    // //online user
                                    refresh();

                                    // window.alert(data);
                                      //creat post
                                      $.toast({
                                        heading: 'Noti',
                                        text:data ,
                                        showHideTransition: 'slide',
                                        icon: 'success',
                                        stack:0,
                                        position:'bottom-right'
                                    });

                             }
                      });

                    return false;
}