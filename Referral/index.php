<?php
include('../processor/processor.php');

$id = $_GET['id'];
$resp = $obj->getReferralData($id);
//  echo "<pre>" . var_export($resp,true) . "</pre>";
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
        <form>
        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
            <img src='../assets/images/Alexandroupoli souvenirs-07.jpg' width="20%"></img>
            <?php echo $resp->text_one ?>

        </div>

        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
        <?php echo $resp->text_two ?><br>
            <!-- <input type='text' placeholder="phone" name='user' style="height:38px;" value="<?php $_GET['user'] ?>"></input> -->
            <input id="sender_number" type='text' placeholder="phone" name='sender_number' style="height:38px;" value=""/>

        </div>
        <div style='background-color:#ffffff;border-radius:5px;width:600px;margin:10px;padding:30px;'>
        <?php echo $resp->text_three ?><br>
            <input id="receiver_number" type='text' placeholder="phone" name="receiver_number" style="height:38px;"/>
            <!-- <button type="submit" name="submit" class="text-white" value="Invite" style='background-color:#000000;padding:10px;margin:4px;'> <?php echo $resp->invite_btn_text ?></button> -->
            <!-- <a href="#" id="send_invitation_btn" > asdf</a> -->
            <a  id="send_invitation_btn"  style='background-color:#000000;font-color:#ffffff;padding:10px;margin:4px;' href="sms://+14035550185?&amp;body=<?php echo $resp->invite_text ?>"><?php echo $resp->invite_btn_text ?></a>
        </div>
        </form>
    </center>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
    <script src="../assets/app.js"></script>
</body>

</html>