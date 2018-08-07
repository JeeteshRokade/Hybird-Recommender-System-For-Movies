<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['logged_in']);

header("Location:reclogin.php");
?>
</body>
</html>