<?php
include('processor/processor.php');

$unique_identifier = $_GET['d'];

$isSecure = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';

$protocol = $isSecure ? "https://" : "http://";

$host = $_SERVER['HTTP_HOST'];

$currentHost = $protocol.$host;

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
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="border p-lg-5 p-3 mt-4">
                    <h1><a href="<?php echo $currentHost."/reg.php?d=".$unique_identifier ?>" target="_blank"><?php echo $currentHost."/reg.php?d=".$unique_identifier ?></a></h1>
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