<?php


$user=$_GET['user'];
$code=$_GET['code'];
$ip=$_SERVER['REMOTE_ADDR'];

$servername = "localhost";
$username = "l8x0cbaa8922";
$password = "RC1821!dim";
$database = "ReadyCodes";


try {
  $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "MSQL connection is done!<br><br>";
  
  
  
  //first get the multiple
  $sql = "SELECT * FROM list WHERE code='".$code."' LIMIT 1;";
  echo $sql;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  echo "IN";
  while($row = $result->fetch_assoc()) {
    $multi=$row['multi'];
    die("GOOD".$multi);
  }
} else {
  die("FAIL".$multi);
}
  
  //update the burn +user + ip
  
  $sql = "UPDATE list SET burn=burn+1, user='".$user."',ip='".$ip."' WHERE code='".$code."' LIMIT 1;";
  // use exec() because no results are returned
  $conn->query($sql);
  
  
  

  
} catch(PDOException $e) {
  die("FAIL");
}

echo "SUCCESS";

?>