<?php

    session_start();
     
    unset($_SESSION['LoggedIn']);
    unset($_SESSION['Username']);
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<div class="login">
<a id="nav" class="login" href="welcome.php">Back</a>
</div>

<link rel="stylesheet" href="common/style.css" type="text/css" />

</head>

</html>