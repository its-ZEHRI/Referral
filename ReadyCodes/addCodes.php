<body style='background-color:#f0f0f0;'>

<div style="background-color:#ffffff;margin:auto; border-style:solid;border-width:0px;border-radius:5px;  width:600px;padding:30px;">
    
    <center>
        <h1>Ready Codes Setup</h1><br>
        Add ready made codes to be redeemed by one or more users in physical<br> stores POS devices and increase or decrease user points and assign<br> coupons and discounts. These codes will not be attached with spesific registered user till redemption.<br><br>
<form action='./addCodes.php'>
    <table><td valign='top'>
<input name='storeID' placeholder='RoadCube Store ID'> </input><br><br>
<input name='name' placeholder='Coupons Group Name'> </input><br><br>
<input name='token' placeholder='RoadCube Company Token'> </input><br><br>
<input name='points' placeholder='How many points the coupons will give'> </input><br><br>
</td><td>
<input name='multi' placeholder='How many times each coupon can be redeemed'> </input><br><br>
<textarea name='de' placeholder="Enter the description of the gift you will get"></textarea><br><br>
<textarea name='codes' placeholder="enter here the codes separated with commas ex. code1,code2..."></textarea><br><br>
    </td></table>
    <input type='submit'> </input>

</form>

</div>
<?php

$letmecall=0;

$storeID=$_GET['storeID'];
if (!isset($storeID))
   $letmecall++;
   
$name=$_GET['name'];
if (!isset($name))
  $letmecall++;
   
   $de=$_GET['de'];
if (!isset($de))
    $letmecall++;
   
     $token=$_GET['token'];
if (!isset($token))
   $letmecall++;
   
$points=$_GET['points'];
if (!isset($points))
    $letmecall++;
   
$multi=$_GET['multi'];
if (!isset($multi))
   $letmecall++;

$codes=$_GET['codes'];
if (!isset($codes))
    $letmecall++;

if ( $letmecall==0){
    

$table=explode(",",$codes);

  
// Create connection
//mysql credentials
$servername = "localhost";
$username = "l8x0cbaa8922";
$password = "RC1821!dim";
$database = "ReadyCodes";

try {
  $conn = new PDO("mysql:host=$servername;dbname=".$database, $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "MSQL connection is done!<br><br>";
  
  $sql = "INSERT INTO codes (storeID, token,name,description)
  VALUES ('".$storeID."', '".$token."','".$name."','".$de."')";
  // use exec() because no results are returned
  $conn->query($sql);
  
  $last_id = $conn->lastInsertId();
  
  foreach ($table as $value) {
  $sql = "INSERT INTO list (codesID, points,code,burn,multi,distributed)
  VALUES ('".$last_id."', '".$points."','".$value."','0','".$multi."','0')";
  // use exec() because no results are returned
  $conn->exec($sql);
    }
  

  
} catch(PDOException $e) {
  die("Connection failed: " . $e->getMessage());
}

  

echo "<br><br><div style='padding:30px;background-color:#ffffff;margin:auto; border-style:solid;border-width:0px;border-radius:5px; width:600px;'>The codes are enabled successfully and can be redeemed on the POS of the store ".$storeID."</div>";

echo "<br><br><div style='padding:30px;background-color:#ffffff;margin:auto; border-style:solid;border-width:0px;border-radius:5px;  width:600px;'>Social Media Promotion URL:<br>https://roadcu.be/ReadyCodes/autogenerate.php?s=".$storeID."<br><br>*This url can auto-generate codes that can be redeemed in offline stores via the RoadCube POS</div>";

}
else{
    echo "<center>*You need to fill all the parameters to make it work";
}

?>