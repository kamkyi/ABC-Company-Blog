<?php
    
    // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');


  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

 //check the email request
  if(isset($_GET['email']))
  {
  	        echo count($_GET['email']);
  }

?>