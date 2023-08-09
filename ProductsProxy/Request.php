<?php

$pos=-1;


$token=$_GET['token'];
if (!isset($token))
    $token= "ffhng3r4-76ac-elcd-g0k1-m5p2sc7uw29o";
    
$storeID=$GET['storeID'];
if (!isset($storeID))
    $storeID="2664";
    
$products=$_GET['products'];
if (!isset($products))
    $products = '1111,222';
  
$table = explode(",", $products);
$table2=$table;
//var_dump($table);

    
// convert XIDs to RIDs


//mysql credentials
$servername = "localhost";
$username = "l8x0cbaa8922";
$password = "RC1821!dim";
$database = "ProductsProxy";

try {
  $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "MSQL connection is done!<br>";

  
 $stmt = $conn->prepare("SELECT * FROM ProductsMap WHERE storeID=".$storeID);
  $stmt->execute();

  // set the resulting array to associative
  $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
  foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
      $position=posfnd($table,$v['XID']);
    if ($position>-1){
        
            //echo "<br>changing ".$position."<br>";
          $table2[$position]=$v['RID'];
          
    }
      
  }
  //var_dump($table2);
  
  $x=implode(',',$table);
  $r=implode(',',$table2);
  $sql = "INSERT INTO Request (storeID, XIDs, RIDs,TAKEN)VALUES ('".$storeID."', '".$x."', '".$r."',0)";
  // use exec() because no results are returned
  $conn->exec($sql);
  
  echo "SUCESS";
  
$conn->close();
  
} catch(PDOException $e) {
  die("FAIL");
}


function posfnd($array,$txt)
{
    for ($i=0;$i<sizeof($array);$i++){
        //echo "<br>(".$i.")comparing ".$array[$i]." with ".$txt."<br>";
        if ($array[$i]==$txt){
           // echo "EXIT".$i;
            return $i;
        }
            
    }
    return -1;
}


?>