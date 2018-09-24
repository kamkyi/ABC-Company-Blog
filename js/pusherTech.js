    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('1c9615015f2c6c4427c4', {
      cluster: 'ap1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {

                   //returned data is json data so that ?

                   //check the return action to refresh the page by the action value

                  switch (data['action']) { 
                    case 'created-post':
                            //get post function 
                              // getPost(user_id);
                              //message
                                //creat post
                                $.toast({
                                  heading: 'Noti',
                                  text:"A Post" ,
                                  showHideTransition: 'slide',
                                  icon: 'success',
                                  stack:0,
                                  position:'bottom-right'
                              });
                      break;
                    case 'prototype': 
                      alert('prototype Wins!');
                      break;
                    case 'mootools': 
                      alert('mootools Wins!');
                      break;    
                    case 'dojo': 
                      alert('dojo Wins!');
                      break;
                    default:
                        
                        //call the refresh()
                        refresh();
                  }
    });