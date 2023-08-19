<?php
include('processor/processor.php');

$unique_identifier = (int) $_GET['d'];

if($unique_identifier == '' || $unique_identifier < 0){

}
$form_data = $obj->getNewFormData($unique_identifier);
// echo "<pre>" . var_export($resp,true) . "</pre>";
$obj->initalizeApiKey($form_data->id);
// die;
$countries = $obj->getCountries();
// $countries['data'] =  [];
// echo "<pre>" . var_export($countries->data[0]->code, true) . "</pre>";
// die;

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Php Url Regenerator</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/style.css">
  
  <link rel="stylesheet" href="sweetalert2.min.css">
</head>

<body style="background-color: <?php echo $form_data->background_color ?> ;">
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
        <div class="d-flex justify-content-center align-items-center">
          <img src="<?php echo $form_data->image_url ?>" class="d-block" width="300px" height="100%" alt="image">
        </div>
        <h1 class="text-center mb-4"><?php echo $form_data->title ?></h1>

        <!-- <form action="">
          <div class="row mb-4">
            <div class="col-md-2">
              <input type="text" id="GR" class="form-control" placeholder="GR" disabled>
            </div>
            <input type="hidden" id="user_registration_identifier">
            <div class="col-md-7 my-2 my-lg-0">
              <input type="number" id="number" class="form-control" required placeholder="Phone" name="phone">
            </div>
            <div class="col-md-3">
              <a href="javascript:void(0)" id="validate" class="btn btn-success w-100">Vaidate</a>
            </div>
          </div>
          <div class="form-group mb-4">
            <input type="text" class="form-control" id="full_name" placeholder="Full Name" name="full_name">
          </div>
          
          <div class="d-flex mb-4">
            <div class="form-check">
              <input class="form-check-input" type="radio" value="male" id="male" name="gender">
              <label class="form-check-label" for="male">Male</label>
            </div>
            <div class="form-check mx-5">
              <input class="form-check-input" type="radio" value="" id="female" name="gender">
              <label class="form-check-label" for="female">Female</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="" id="other" name="gender">
              <label class="form-check-label" for="other">Other</label>
            </div>
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Birhtdate</label>
            <input type="date" class="form-control" placeholder="" name="birhdate">
          </div>
          <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" value="" id="male" name="">
            <label class="form-check-label" for="male">Terms & Conditions</label>
          </div>
          <div>
            <button type="submit" id="submit_form" class="btn btn-primary w-100">Submit</button>
          </div>
        </form> -->
        <form action="">
          <div class="row mb-4">
            <div class="col-md-3">
              <select class="form-select" id="country_id" aria-label="Default select example">
                <option selected disabled>Select Country</option>
                <?php
                foreach ($countries->data as $country) { ?>
                  <option value="<?php echo $country->country_id ?>"><?php echo $country->name . " (" .  $country->phone_code . ")"; ?></option>
                <?php
                }
                ?>
              </select>
              <!-- <input type="text" id="GR" class="form-control" placeholder="GR" disabled> -->
            </div>
            <input type="hidden" id="user_registration_identifier">
            <input type="hidden" id="company_id" value="<?php echo $form_data->id ?>">
            <div class="col-md-6 my-2 my-lg-0">
              <input type="number" id="number" class="form-control" required placeholder="Phone" name="phone">
            </div>
            <div class="col-md-3">
              <a href="javascript:void(0)" id="validate" class="btn w-100"  style="background-color:<?php echo $form_data->button_background_color ?>; color:<?php echo $form_data->button_text_color ?>"><?php echo $form_data->verification_btn_text ?>	</a>
              <span id="verified_text" class="btn btn-success w-100 disabled d-none" >Verified</span>
            </div>
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0"><?php echo $form_data->email_text ?></label>
            <input type="email" class="form-control" id="email" required autocomplete="off" name="email">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Password</label>
            <input type="password" class="form-control" id="password" required autocomplete="off" name="password">
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0">Confirm Password</label>
            <input type="password" class="form-control" id="c_password" required placeholder="" name="c_password">
          </div>
          <div class="d-flex mb-4">
            <label class="form-label me-2"><?php echo $form_data->gender_text ?></label>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="male" id="male" name="gender">
              <label class="form-check-label" for="male"><?php echo $form_data->gender_one_text ?></label>
            </div>
            <div class="form-check mx-5">
              <input class="form-check-input" type="radio" value="female" id="female" name="gender">
              <label class="form-check-label" for="female"><?php echo $form_data->gender_two_text ?></label>
            </div>
            <div class="form-check">
              <input class="form-check-input" type="radio" value="other" id="other" name="gender">
              <label class="form-check-label" for="other"><?php echo $form_data->gender_other_text ?></label>
            </div>
          </div>
          <div class="form-group mb-4">
            <label class="form-label mb-0"><?php echo $form_data->birthday_text ?></label>
            <input type="date" class="form-control" id="birthdate" placeholder="" name="birthdate">
          </div>
          <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="" name="terms">
              <label class="form-check-label" for="other"><?php echo $form_data->terms_text ?></label>
            </div>
          <div>
            <button type="submit" id="submit_form" class="btn mt-3 w-100" style="background-color:<?php echo $form_data->button_background_color ?>; color:<?php echo $form_data->button_text_color ?>"><?php echo $form_data->submit_btn_text ?></button>
          </div>
        </form>
        <button id="ref_button">click me</button>
      </div>
    </div>
    <div class="col-md-3"></div>

  </div>

  <!-- OTP popup -->
  <div class="otp-pop-up d-none">
    <div class="border px-5 py-4 bg-white rounded text-dark">
      <h5 class=""><?php echo $form_data->sms_popup_text ?></h5>
      <div class="otp-container mt-5">
        <input type="text" class="otp-input" id="otp-1" maxlength="1" />
        <input type="text" class="otp-input" id="otp-2" maxlength="1" />
        <input type="text" class="otp-input" id="otp-3" maxlength="1" />
        <input type="text" class="otp-input" id="otp-4" maxlength="1" />
      </div>
    </div>
  </div>

  <!-- loader -->
  <div id="loader_wrapper" class="d-none">
    <div class="loader"></div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
  <!-- <script src="sweetalert2.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="assets/app.js"></script>
  <script>
  
  </script>
</body>

</html>