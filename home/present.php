<? //Підключення до бази даних перевірка на логін і опрацювання запитів 

require "include/php/db.php";
require "include/php/func.php";


if(!isset($_SESSION["login"]))
	header('Location: /login.php '); //Тут доступ тільки авторизованим


if(isset($_GET["gtext"]))
{
	//Будемо підправляти деякі теги
	$text = file_get_contents("AppData/temp/" . $_SESSION['login']);
	
	//$text = str_replace("<video","<video  allowfullscreen='true' controls autoplay ",$text);
	$text = str_replace("</video>","</video> <script></script>",$text);	
	
	exit($text);
}




?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/AppData/icon/icon.png" type="image/png">
<script src="/include/js/main.js"></script>


<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/noty.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/mint.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/light.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/metroui.css">

<link rel="stylesheet" type="text/css" href="/node_modules/tinymce/skins/content/document/content.css">
<link rel="stylesheet" type="text/css" href="/node_modules/tinymce/skins/content/document/content.min.css">


<title><? echo htmlspecialchars($_SESSION["login"]); ?></title>


<style>
body{
	max-width:98%;
	max-height:99%;
	width:98%;
	min-height:auto;
	padding:25px;
	margin:0px;
	position: absolute;
    top: 50%;
	left:50%;
    transform: translate(-50%,-50%);
	/*display: inline-block;*/
}
html
{
	width: 100%;
	height: 100%;
	max-width:100%;
	max-height:100%;
	padding:0px;
	
}
img 
{
	min-width:99%; 
	height:auto;
}
video,img
{
	position: absolute;
	width:100% !important;; 
	height:auto !important;;
	left:0px;
	right: 0px;
	transform: translate(0,-50%);
	//top:0px;
}
</style>


<style>
@media (orientation: portrait) { 
body{
	
	padding:30px;
	margin:0px;
		min-width:100%; 
}
html
{
max-width:100%; 
	padding:0px;
	font-size: 200%;
	margin:0px;
	
}/*
img
{
	max-width:99%; 
	min-width:99%; 
	height:auto;
}*/
}
</style>


 <script type="text/javascript">
 
 let content = "";
 
 function GetText(selector) //Функція зберігання документа
{
	let getq = "present.php?gtext=t";
	
		var httpReq = new XMLHttpRequest();
            httpReq.open("POST",getq);
			httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpReq.send(""); //Нічого не надсилаємо система і так знає хто авторизований
    
 
            httpReq.onreadystatechange = function () {
                if (httpReq.readyState != 4) return;
 
 
                if (httpReq.status != 200) {
				setTimeout(LOOP, 100);
				   
                } else {
					
					
					let text = "" + httpReq.responseText;
					if(content != text)
					{
	
						content = text;
						document.querySelector(selector).innerHTML = content;
						
					}

					setTimeout(LOOP, 2000);
                }
 
            }
}
 

 function LOOP()
 {
	// console.log("sdf");
	// $url = ("AppData/temp/<?echo $_SESSION['login'];?>");
	 GetText("body");
	 console.log("loop");
 }
setTimeout(LOOP, 200);




</script>


</head>
<body>
</body>
</html>