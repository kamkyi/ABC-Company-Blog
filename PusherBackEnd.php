<?php
//pusher technology is used to refresh the specific page withoud reloading manually :D

   class PusherTech{
             //pusher now
             public static function pushNow($action)
             {
                      require __DIR__ . '/vendor/autoload.php';

                      $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                      );
                      $pusher = new Pusher\Pusher(
                        '1c9615015f2c6c4427c4',
                        'e09775f1027311df2fb5',
                        '603862',
                        $options
                      );

                      $data['action'] = $action;
                      $pusher->trigger('my-channel', 'my-event', $data);


             }

             //push no no with no action
             public static function pushNowNow()
             {
                     require __DIR__ . '/vendor/autoload.php';

                      $options = array(
                        'cluster' => 'ap1',
                        'useTLS' => true
                      );
                      $pusher = new Pusher\Pusher(
                        '1c9615015f2c6c4427c4',
                        'e09775f1027311df2fb5',
                        '603862',
                        $options
                      );

                      $data['action'] = "no";
                      $pusher->trigger('my-channel', 'my-event', $data);
             }
   }

?>