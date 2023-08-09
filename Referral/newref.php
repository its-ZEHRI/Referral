<?php
include('../processor/processor.php');

if (isset($_POST['submit_referral_form'])) {
    // echo 'hello';
    $resp = $obj->storeReferralFormData();
    header("location: index.php?id=" . $resp->id);
    echo "<pre>" . var_export($resp, true) . "</pre>";
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
    <link rel="stylesheet" href="assets/style.css">

    <link rel="stylesheet" href="sweetalert2.min.css">
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
            <h1 class="text-center mb-4">Referral Form</h1>

            <form action="newref.php" method="POST" enctype="multipart/form-data" class="px-2">

                <div class="form-group mb-2">
                    <label class="form-label mb-0">Token</label>
                    <input type="text" class="form-control" placeholder="Token" required name="token">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0">Points</label>
                    <input type="text" class="form-control" placeholder="Points" required name="points">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0">Regisgter Url</label>
                    <input type="text" class="form-control" placeholder="Register url" required name="register_url">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0" for="image">Image</label>
                    <input type="file" class="form-control" value="" name="image">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0" for="image">Text one</label>
                    <input type="text" class="form-control" value="" name="text_one">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0" for="image">Text two</label>
                    <input type="text" class="form-control" value="" name="text_two">
                </div>

                <div class="form-group mb-2">
                    <label class="form-label mb-0" for="image">Text three</label>
                    <input type="text" class="form-control" value="" name="text_three">
                </div>
                <div class="form-group mb-2">
                    <label class="form-label mb-0" for="image">Invite text</label>
                    <input type="text" class="form-control" value="" name="invite_text">
                </div>
                <div class="form-group mb-4">
                    <label class="form-label mb-0" for="image">Invite button text</label>
                    <input type="text" class="form-control" value="" name="invite_btn_text">
                </div>

                <div>
                    <button type="submit" name="submit_referral_form" class="btn btn-primary w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-3"></div>

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