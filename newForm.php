<?php
include('processor/processor.php');

if (isset($_POST['submitNewForm'])) {
  $resp = $obj->addNewFormData();
  header("location: reglink.php?d=".$resp->unique_identifier);
  echo "<pre>" . var_export($resp,true) . "</pre>";
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

<body>
  <div class="position-absolute" style="left: 50%; top:0;  transform: translate(-50%);">
    <div id="error" class="alert alert-warning alert-dismissible fade" role="alert">
      <span id="error_message">hello world</span>
      <button type="button" class="btn-close" id="close_error"></button>
    </div>
  </div>
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="border p-lg-5 p-3 mt-4">

        <!-- <form action="newForm.php" method="POST">
          <div class="form-group mb-4">
            <label class="form-label mb-0">Title</label>
            <input type="text" class="form-control" id="title" value="<?php echo $resp->Title ?>" required name="title">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Phone Text</label>
            <input type="text" class="form-control" id="phone_text" value="<?php echo $resp->phone_text ?>" required name="phone_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Verification Text</label>
            <input type="text" class="form-control" id="verification_text" value="<?php echo $resp->verification_text ?>" required name="verification_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Verification Btn Text</label>
            <input type="text" class="form-control" id="verification_btn_text" value="<?php echo $resp->verification_btn_text ?>" required name="verification_btn_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Full Name Text</label>
            <input type="text" class="form-control" id="full_name_text" value="<?php echo $resp->full_name_text ?>" required name="full_name_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Email Text</label>
            <input type="text" class="form-control" id="email_text"  value="<?php echo $resp->email_text ?>" required name="email_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Birthday Text</label>
            <input type="text" class="form-control" id="birthday_text" value="<?php echo $resp->birthday_text ?>" required name="birthday_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Text</label>
            <input type="text" class="form-control" id="gender_text" value="<?php echo $resp->gender_text ?>" required name="gender_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender One</label>
            <input type="text" class="form-control" id="gender_one" value="<?php echo $resp->gender_one_text ?>" required name="gender_one_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Two</label>
            <input type="text" class="form-control" id="gender_two" value="<?php echo $resp->gender_two_text ?>" required name="gender_two_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Other</label>
            <input type="text" class="form-control" id="gender_other" value="<?php echo $resp->gender_other_text ?>" required name="gender_other_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Terms Text</label>
            <input type="text" class="form-control" id="terms_text" value="<?php echo $resp->terms_text ?>" required name="terms_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">SMS Popup Text</label>
            <input type="text" class="form-control" id="sms_text" value="<?php echo $resp->sms_popup_text ?>" required name="sms_popup_text">
          </div>
          <div>
            <button type="submit" name="submitNewForm" id="new_form" class="btn btn-primary w-100">Submit</button>
          </div>
        </form> -->


        <form action="newForm.php" method="POST" enctype="multipart/form-data">
          <div class="form-group mb-4">
            <label class="form-label mb-0">Company Token</label>
            <input type="text" class="form-control"  value="" required name="company_token">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Button Background Color</label>
            <input type="color" class="form-control" id="" value="" required name="button_background_color">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Button Text Color</label>
            <input type="color" class="form-control" id="button_text_color" value="" required name="button_text_color">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Background Color</label>
            <input type="color" class="form-control" id="background_color" value="" required name="background_color">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Title</label>
            <input type="text" class="form-control" id="title" value="" required name="title">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0" for="image">Image</label>
            <input type="file" class="form-control" id="image" value="" required name="image">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Phone Text</label>
            <input type="text" class="form-control" id="phone_text" value="" required name="phone_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Verification Text</label>
            <input type="text" class="form-control" id="verification_text" value="" required name="verification_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Verification Btn Text</label>
            <input type="text" class="form-control" id="verification_btn_text" value="" required name="verification_btn_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Full Name Text</label>
            <input type="text" class="form-control" id="full_name_text" value="" required name="full_name_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Email Text</label>
            <input type="text" class="form-control" id="email_text"  value="" required name="email_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Birthday Text</label>
            <input type="text" class="form-control" id="birthday_text" value="" required name="birthday_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Text</label>
            <input type="text" class="form-control" id="gender_text" value="" required name="gender_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender One</label>
            <input type="text" class="form-control" id="gender_one" value="" required name="gender_one_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Two</label>
            <input type="text" class="form-control" id="gender_two" value="" required name="gender_two_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Gender Other</label>
            <input type="text" class="form-control" id="gender_other" value="" required name="gender_other_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Submit Button Text</label>
            <input type="text" class="form-control" id="submit_btn_text" value="" required name="submit_btn_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Terms Text</label>
            <input type="text" class="form-control" id="terms_text" value="" required name="terms_text">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">SMS Popup Text</label>
            <input type="text" class="form-control" id="sms_text" value="" required name="sms_popup_text">
          </div>
          <div>
            <button type="submit" name="submitNewForm" id="new_form" class="btn btn-primary w-100">Submit</button>
          </div>
          
        </form>
      </div>
    </div>
    <div class="col-md-3"></div>

  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <script src="include/app.js"></script>
</body>

</html>