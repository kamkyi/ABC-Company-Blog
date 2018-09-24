<?php
 //class config

    class config{

    	    private $HOST='localhost';
    	    private $DB='blog_app';
    	    private $USERNAME='root';
    	    private $PASSWORD='';

    	    //mysql return the connection

    	    protected function getConnection()
    	    {
                  // Create connection
					$conn = new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB);
					// Check connection
					if ($conn->connect_error) {
					    die("Connection failed: " . $conn->connect_error);
					    $conn->close();
					}else{
						   //connection successful return the connection
						   return $conn;
					}

					
    	    }

            //get connection 
            public function connect()
            {
                   // Create connection
                    $conn = new mysqli($this->HOST, $this->USERNAME, $this->PASSWORD, $this->DB);
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                        $conn->close();
                    }else{
                           //connection successful return the connection
                           return $conn;
                    }
            }
    }
?>