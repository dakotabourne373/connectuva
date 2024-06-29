<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Component</title>
  <base href="/db2nb/connectuva/profile/">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/db2nb/connectuva/favicon.ico">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="/db2nb/connectuva/templates/angular/styles.css">
  <link rel="stylesheet" href="<?= " {$this->url}/styles/main.css" ?>">

<body>
  <?php include "templates/header.php" ?>
  <app-root></app-root>
  <?php include "templates/footer.php" ?>

  <script src="/db2nb/connectuva/templates/angular/runtime.js" type="module"></script>
  <script src="/db2nb/connectuva/templates/angular/polyfills.js" type="module"></script>
  <script src="/db2nb/connectuva/templates/angular/main.js" type="module"></script>


</body>

</html>