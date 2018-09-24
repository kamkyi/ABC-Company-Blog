//user id for this page
let user_id=$('#user_id').val();

$(document).ready(function(){
	  //call the refresh function
        refresh();

        //cancel post edit
        $('#cancel-post-edit').on('click',function(){
                  
                     //editor panel fade out
                     $('#editor-panel').fadeOut();
        });

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
      	     data:{data:formData,action:'create-post'},
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

function getPost(user_id)
{
	   //ajax request
     if(user_id==""){
         window.alert("User Id null");
     }else{
      //ajax request
              $.ajax({
                     method:'POST',
                     url:"../module/requestController.php",
                     data:{action:'get-posts',user_id:user_id},
                     success:function(data,status){
                           
                           //insert into post
                             $('#ajax-posts').html(data);              

                     }
              });
     }
}

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
     getPost(user_id);

     //get onlin user

     getOnlineOfflineUser(1);

     //get offline user

     getOnlineOfflineUser(0);

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



//edit on time line
function editOnTimeLine(event,user_id,post_id)
{

          //preventing default action

          event.preventDefault();

          $('#editor-panel').fadeIn();


                   //ajax request
                      $.ajax({
                             method:'POST',
                             url:"../module/requestController.php",
                           data:{action:'edit-posted',user_id:user_id,post_id:post_id},
                             success:function(data,status){
                                    
                                    //apend the return html into eidtor content
                                    $('#ajax-content-new').html(data);
                                    //post edit form
                                    $('#post-edit-form').on('submit',function(e){
                                         e.preventDefault();
                                         window.alert();

                                    });

                             }
                      });

}


//window on keydown event
$(window).on('keydown',function(e){


          //check the Esc (Escape key)
          if(e.keyCode==27)
          {
                //editor panel fade out
                 $('#editor-panel').fadeOut();
          }

});


