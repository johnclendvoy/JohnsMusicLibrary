<!-- Example of MVC  for the Web
Ref.: http://requiremind.com/a-most-simple-php-mvc-beginners-tutorial/

		Pitt, C., & SpringerLink. (2012). Pro PHP MVC.
-->
<head>
      <title>John's Music Library</title>
      <link href='https://fonts.googleapis.com/css?family=Viga' rel='stylesheet' type='text/css'>
      <link href="./views/style.css" media="all" rel="stylesheet" type="text/css">
  </head>

<?php
// This is the user interface
  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    $controller = 'pages';
    $action     = 'home';
  }
  require_once('views/layout.php');
?>

