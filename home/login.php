<?php
require "include/php/db.php";

$result = "";
if(isset($_GET['login']) && isset($_GET['pasword']))
{
	$result = Login($_GET['login'],$_GET['pasword']);
}

if($result == "true")
$_SESSION["login"] = $_GET['login'];

if(isset($_SESSION["login"]))
	header('Location: / ');

//Login($login,$password);
?>   
<!doctype html>
<html lang="ua">
<head>
  <meta charset="utf-8" />
  <link rel="shortcut icon" href="/AppData/icon/icon.png" type="image/png">
  <title></title>
  <link rel="stylesheet" type="text/css" href="include/css/login.css">

</head>
<body>

<form>
<div class = "login_onteiner">
	<div class = "login">
		<h1>Авторизація</h1>
		<input type = "text" name = "login" placeholder = "login" value = "<? echo $_GET['login'];  ?>"/>
		<?
		if($result == "NULL") echo "<p>Не вірний логін</p>";
		?>
		<p></p>
		<input type = "password" name = "pasword"; placeholder = "password"/>
		<?
		if($result == "false") echo "<p>Не вірний пароль</p>";
		?>
		<p></p>
		<div><input type = "submit" value = "Вхід" /></div>
	</div>
</div>
</form>

</body>
</html>