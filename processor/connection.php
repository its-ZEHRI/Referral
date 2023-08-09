<?php
    class Connection{
        function connect($DB_DATABASE,$DB_USERNAME,$DB_PASSWORD)
        {
            $servername = "localhost";

            $database_name = $DB_DATABASE;
	          $username = $DB_USERNAME;
	          $password = $DB_PASSWORD;

	        try{
	        	$db_conn = new PDO("mysql:host=$servername;dbname=".$database_name, $username, $password);
                return $db_conn;
	        } catch (PDOException $e) {
	        	echo "Connection failed: " . $e->getMessage();
	        }
        }
    }
    
?>