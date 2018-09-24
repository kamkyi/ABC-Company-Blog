//register form on submit
$('#register-form').on('submit',function(e){
     //preventing default
     e.preventDefault();
     
      //form data
      let formData=$(this).serializeArray();
      
      //check the password match
      if(formData[2]['value']!=formData[3]['value'])
      {
      	             //password do not match
      	               $.toast({
											    heading: 'Error',
											    text:"Passowrds do not match !",
											    showHideTransition: 'fade',
											    icon: 'error',
											    stack:0,
											    position:'bottom-right'
											});
      }else{
      	           //ajax request
			      $.ajax({
			      	     method:'POST',
			      	     url:"module/requestController.php",
			      	     data:{data:formData,action:'register-user'},
			      	     success:function(data,status){
			      	     	     
			      	     	    //parse the data into json
			      	     	    let jsonMsg=JSON.parse(data);

			      	     	    console.log(jsonMsg[0]['redirect']);
                             
                             //check returned json

    			      	     	    if(jsonMsg[0]['redirect']==true){
    			      	     	    	        //redirect to dashboad
    			      	     	    	        window.location.replace('View/dashboard.php?token='+jsonMsg[0]['token']);
    			      	     	    }else{
    			      	     	    	       // console.log(data);
    			      	     	    	       $.toast({
            											    heading: 'Error',
            											    text: jsonMsg[0]['message'],
            											    showHideTransition: 'fade',
            											    icon: 'error',
            											    stack:0,
            											    position:'bottom-right'
            											});
    			      	     	    }
			      	     }
			      });
      }
});


//login form on submit
$('#login-form').on('submit',function(e){
     //prevent default
     e.preventDefault();

     //form data
      let formData=$(this).serializeArray();

      //ajax request
      $.ajax({
      	     method:'POST',
      	     url:"module/requestController.php",
      	     data:{data:formData,action:'login-user'},
      	     success:function(data,status){
      	     	     
      	     	     // window.alert(data);
      	     	    //parse the data into json
      	     	    let jsonMsg=JSON.parse(data);

      	     	    console.log(jsonMsg[0]['redirect']);


      	     	    if(jsonMsg[0]['redirect']==true){
      	     	    	        //redirect to dashboad
      	     	    	        window.location.replace('View/dashboard.php?token='+jsonMsg[0]['token']);
      	     	    }else{
      	     	    	  
                             //password do not match
                             $.toast({
                                heading: 'No account !',
                                text:"User does not exist !",
                                showHideTransition: 'fade',
                                icon: 'error',
                                stack:0,
                                position:'bottom-left'
                            });
      	     	    }
      	     }
      });
});