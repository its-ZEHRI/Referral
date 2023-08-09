<?php
include('../processor/processor.php');

if (isset($_POST['submit'])) {
    // echo 'hello';
    $resp = $obj->storeRequest();
    // header("location: index.php?d=".$resp->id);
    echo 'request saved';
    // echo "<pre>" . var_export($resp,true) . "</pre>";
    die;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Php Url Regenerator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="include/style.css">
</head>

<body style="background-color:#f0f0f0;">
    <center>
        <form action="index.php" method="POST">
        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
            <img src=''></img>
            {INITIAL TEXT (txt1)}

        </div>

        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
            {WHO GET POINTS TEXT(txt2)}<br>
            <!-- <input type='text' placeholder="phone" name='user' style="height:38px;" value="<?php $_GET['user'] ?>"></input> -->
            <input type='text' placeholder="phone" name='sender_number' style="height:38px;" value=""/>

        </div>
        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
            {INVITE FRIENDS TEXT(txt3)}<br>
            <input type='text' placeholder="phone" name="receiver_number" style="height:38px;"/>
            <button type="submit" name="submit" class="text-white" value="Invite" style='background-color:#000000;padding:10px;margin:4px;' >Invite</button>
            <!-- <a style='background-color:#000000;font-color:#ffffff;padding:10px;margin:4px;' href="sms://+14035550185?&amp;body=I%27m%20interested%20in%20your%20product.%20Please%20contact%20me.">{INVITE TEXT}</a> -->
        </div>
        </form>
    </center>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="include/app.js"></script>
</body>

</html>