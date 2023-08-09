<?php 
    
    include('getData.php');
    // include('../configuration/config.php');
    require __DIR__ . '/../configuration/config.php';
 
    $obj = new getData($DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);

?>