

<!--Header-->

<?php
  if(!isset($page_title)) { $page_title = 'Header Area'; }
//
$public_key = "6Le0QcYZAAAAAC75zwkg7uMqBCwTPnE0WFdObupY";
$private_key = "6Le0QcYZAAAAAP8qlD72kvNppI7gq1su1I0uCn5y";
$url = "https://www.google.com/recaptcha/api/siteverify";

?>

<!doctype html>

<html lang="en">
  <head>
    <title><?php echo $page_title; ?></title>
    <meta charset="utf-8">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link rel="stylesheet" media="all" href="main.css" />
  </head>

  <body>
    <header>
        <p class="text-center">Header</p>
    </header>
<div class="container-fluid">
    <nav>
      <ul>
        <li><a href="index.php" class="btn btn-primary home ">Home</a></li>
      </ul>
    </nav>
</div>
