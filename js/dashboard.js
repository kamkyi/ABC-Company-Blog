//user id for this page
let user_id=$('#user_id').val();

$(document).ready(function(){
	  //call the refresh function
        refresh();
});
//create post
$('#create-post').on('submit',function(e){
	   //preventing default
	    e.preventDefault();
	   

	   //form data
      let formData=$(this).serializeArray();

      //ajax request
      $.ajax({
      	     method:'POST',
      	     url:"../module/requestController.php",
      	     data:{data:formData,action:'create-post',user_id:user_id},
      	     success:function(data,status){
      	     	     
      	     	        //creat post
                          $.toast({
                            heading: 'Noti',
                            text:"A Post" ,
                            showHideTransition: 'slide',
                            icon: 'success',
                            stack:0,
                            position:'bottom-right'
                        });


      	     }
      });
});
//get the posts function

// function getPost(user_id)
// {
// 	   //ajax request
//       $.ajax({
//       	     method:'POST',
//       	     url:"../module/requestController.php",
//       	     data:{action:'get-posts',data:user_id},
//       	     success:function(data,status){
      	     	     
//       	     	     //insert into post
//                      $('#ajax-posts').html(data);      	     	 

//       	     }
//       });
// }

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
     //get post
     // getPost(user_id);

     //get onlin user

     getOnlineOfflineUser(1);

     //get offline user

     getOnlineOfflineUser(0);

     //news feed
     newsFeeds(user_id);
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

//function to get news feed
function newsFeeds(user_id)
{
                   //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                           data:{action:'news-feeds',data:user_id},
                             success:function(data,status){
                                    
                                  //
                                  $('#ajax-posts').html(data);

                             }
                      });
}