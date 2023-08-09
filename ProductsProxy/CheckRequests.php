<?php

$storeID=$GET['storeID'];
if (!isset($storeID))
    $storeID="2664";

//check for the storeID if there is a transactions with product to get
//mysql credentials
$servername = "localhost";
$username = "l8x0cbaa8922";
$password = "RC1821!dim";
$database = "ProductsProxy";

$response="NULL";

try {
  $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "MSQL connection is done!<br>";

  $stmt = $conn->prepare("SELECT * FROM Request WHERE storeID=".$storeID);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
      if ($v['TAKEN']==0){
          $response= $v['RIDs'];
      }
      
  }
 $sql = "UPDATE Request SET TAKEN=1 WHERE storeID=".$storeID;
  // use exec() because no results are returned
  $conn->exec($sql);
  
 echo $response;
  
$conn->close();
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


?>