
<?php

$token=$_GET['token'];
    if (!isset($token))
        $token= "ffhng3r4-76ac-elcd-g0k1-m5p2sc7uw29o";

$storeID=$_GET['storeID'];
if (!isset($storeID))
    $storeID="2664";

//URL for RoadCube API.
$url = "https://api.roadcube.io/v1/p/stores/".$storeID."/products/";

$json=$_GET['products'];
if (!isset($json))
    $json = '{"1111":65.53,"222":55.87}';

 
$table=json_decode($json, true);

foreach($table as $key=>$value){
   // echo "Entering ID:".$key . " with value: " . $value ;
    //echo "<br>Calling RoadCube API....<br>";
  
    
 
// Initialize a CURL session.
$newCurl = curl_init();
 
//grab URL and pass it to the variable.
curl_setopt($newCurl, CURLOPT_URL, $url);

curl_setopt($newCurl, CURLOPT_POSTFIELDS, '{"published": true,"name": {"el": "'.$key.'","en": "'.$key.'","it": "'.$key.'"},"description": {"el": "'.$key.'","en": "'.$key.'","it": "'.$key.'"},"retail_price": '.$value.',"wholesale_price": '.$value.',"product_category_id": 1543,"group_product": false,"availability_days": [0,1,2,3,4,5,6]}');

curl_setopt($newCurl, CURLOPT_HTTPHEADER, [
    'Content-Type:application/json',
    'Accept:application/json',
    'X-Api-Token:'.$token
]);

// Return Page contents.
curl_setopt($newCurl, CURLOPT_RETURNTRANSFER, true);
 
$output = curl_exec($newCurl);

$obj = json_decode($output);

$RID=$obj->data->product->product_id;
//echo "Saving with RoadCube ID:".$RID."<br>";
 
//echo $output;


 // echo "Inserting ".$key." to database ....<br>";
  
// Create connection
//mysql credentials
$servername = "localhost";
$username = "l8x0cbaa8922";
$password = "RC1821!dim";
$database = "ProductsProxy";

try {
  $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "MSQL connection is done!<br><br>";
  
  $sql = "INSERT INTO ProductsMap (storeID, XID, RID,PRICE)
  VALUES ('".$storeID."', '".$key."', '".$RID."','".$value."')";
  // use exec() because no results are returned
  $conn->exec($sql);
  

  
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

  


}

echo "SUCCESS";
?>

</div>