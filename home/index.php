<?
require "include/php/db.php";
if(!isset($_SESSION["login"]))
	header('Location: /login.php '); //Тут доступ тільки авторизованим



//Якщо запит на створення нового проекту
if(isset($_GET["newDock"]))
{
	$dirName = "project/" . $_GET['newDock'];
	if (!mkdir($dirName, 0777, true)) 
    die('Проект не вдалось створити...');
	else
	{
		$dirName = $dirName."/media";
		mkdir($dirName, 0777, true);
		mkdir($dirName."/audio", 0777, true);
		mkdir($dirName."/image", 0777, true);
		mkdir($dirName."/video", 0777, true);
	
	}
	header('Location: /'); 

}

?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/AppData/icon/icon.png" type="image/png">
<script src="/node_modules/tinymce/tinymce.js"></script>
<link rel="stylesheet" type="text/css" href="include/css/style.css">
<title>Проекти</title>


</head>
<body>

<div  class = "project-conteiner">



<a href = 'present.php' target="_blank"><div class = 'project'><div class = 'viewB'></div><p></p>Презентація</div></a>






<?
$dir = opendir('project');
while($file = readdir($dir)) {
   if (is_dir('project/'.$file) && $file != '.' && $file != '..') {


   echo "<a href = 'editor.php?project={$file}' target='_blank'><div class = 'project'><div class = 'im'></div><p></p>{$file}</div></a>";
}
}


?>

<a><div class = 'project'><div  onclick = " if(document.querySelector('.newProg').style.display == '') document.querySelector('.newProg').style.display = 'block'; else document.querySelector('.newProg').style.display = '';" class = 'newDock'></div><p></p>Новий Документ</div></a>
</div>
<div id = "avtor">Розробник Писанка Юрій Християнин з України 
<a href = 'https://www.instagram.com/yriapisanka/'>INSTAGRAM</a> | 
<a href = 'https://www.youtube.com/channel/UC6B3OYWggycBpdEzJLEUuvg'>YOUTUBE</a>   | 
<a href = 'https://www.tiktok.com/@yuriypysanka?lang=uk-UA'>TIKTOK</a>   </div>


<div class = "newProg">
<form>
<input name = "newDock" type = 'text' placeholder = "Введіть назву проекта"/>
<form>
</div>



</body>



</html>