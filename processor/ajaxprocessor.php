<?php 
    
    include('getData.php');
    // include('../configuration/config.php');
    require __DIR__ . '/../configuration/config.php';
 
    $obj = new getData($DB_DATABASE,$DB_USERNAME,$DB_PASSWORD);

    if (!isset($_POST['op'])){
        echo "No Direct Access is allowed";
        exit();
    }
    
    $op = $_POST['op'];
    if ($op == "validate_mobile"){
        // echo "Working";
        $resp = $obj->initalizeUserRequest();
	    echo json_encode($resp);
    }elseif($op == 'verify_otp'){
        // echo json_encode(['message' => "working"]);
        // die;
        $resp = $obj->mobileVerification();
        echo json_encode($resp);
    }
    elseif($op == 'form_submit'){
        // echo json_encode(['message' => "working"]);
        // die;
        $resp = $obj->finalRegistration();
        echo json_encode($resp);
    }
?>