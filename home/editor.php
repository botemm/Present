<? //Підключення до бази даних перевірка на логін і опрацювання запитів 

require "include/php/db.php";
require "include/php/func.php";


if(!isset($_SESSION["login"]))
	header('Location: /login.php '); //Тут доступ тільки авторизованим

$dirProject = "";
if(!isset($_GET["project"]))
	header('Location: / '); //Якщо не вказано що редагувати 

$dirProject = "project/".$_GET["project"];
if(!is_dir($dirProject))
	header('Location: / '); //Якщо папки проекту немає то і нікуди його зберігати на головну кидаємо


//Запит на завантажені медіа
if(isset($_GET["project"]) && isset($_GET["type"]))
{
	exit("111");
}


if(isset($_POST["text"])) //Якщо надіслано зі змінною текст значить не відображаємо сторінку це запит на збереження зберігаєм і кажемо що все ок
{
	//file_put_contents("1.txt",$_POST["text"]);
	//exit($_POST["text"]);
	exit(SaveProjects($dirProject,$_POST["text"]));
}
//==========================================================================
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/AppData/icon/icon.png" type="image/png">
<script src="/node_modules/tinymce/tinymce.js"></script>
<script src="/node_modules/tinymce/langs/uk.js"></script>
<script src="/node_modules/noty/lib/noty.js"></script>
<script src="/node_modules/bounce/bounce.min.js"></script>
<script src="/node_modules/dropzone/dist/dropzone-min.js"></script>
<script src="/include/js/main.js"></script>
<!--link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" /-->


<link rel="stylesheet" type="text/css" href="/include/css/style.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/noty.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/mint.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/light.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/metroui.css">


<title><? echo htmlspecialchars($_GET["project"]); ?></title>

<style>
@media (orientation: portrait) { 
body{
	

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


function MySave() //Функція зберігання документа
{
	let getq = "editor.php?project=" + encodeURIComponent("<? echo $_GET['project'];?>");
	
		var httpReq = new XMLHttpRequest();
            httpReq.open("POST",getq);
			httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpReq.send("text="+encodeURIComponent(tinyMCE.activeEditor.getContent()));
           //httpReq.send("text="+encodeURI(tinyMCE.activeEditor.getContent()));
 
            httpReq.onreadystatechange = function () {
                if (httpReq.readyState != 4) return;
 
 
                if (httpReq.status != 200) {
                //   alert(httpReq.status + ': ' + httpReq.statusText);
				PushText('Сервер не доступний','error','bottom');
				   
                } else {
					let text = "" + httpReq.responseText;
                   console.log(text);
				  //if(text != "true")
				  //PushText('Запит не коректний','error','bottom');
					//else
				  PushText('Проект збережено','success','bottom');
                }
 
            }
}
 
tinymce.init({//Ініціалізація і налаштування текстового редактора
    selector: "#textEdit",
	language : 'uk',
	gecko_spellcheck:true,
	browser_spellcheck: true,
	content_css: "/include/css/editor.css",
	 toolbar: 'mySave | media Image link unlink removeformat |  bullist numlist | forecolor  backcolor | styleselect | bold italic strikethrough | outdent indent   alignleft aligncenter alignright alignjustify | table tablecellborderwidth  tablecellborderstyle  tablecellbackgroundcolor tablecellbordercolor \n tablecellvalign | blockquote ',
	plugins: 'anchor autosave fullscreen help image insertdatetime nonbreaking preview save visualblocks visualchars table  advlist link image lists media pagebreak searchreplace',
	autosave_interval: '20s',
	fullscreen_native: false,
	
  setup: (editor) => {
    editor.ui.registry.addButton('mySave', {
     // text: 'My Custom Button',
		icon: 'Save',
		onAction: () => MySave()
    });
  }
 });
 
//Дані з php в js
let project = "<? htmlspecialchars($_GET['project']); ?>"; //Назва проекту а по сумісності і папка проекту
</script>

<script>
  // Note that the name "myDropzone" is the camelized
  // id of the form.
  Dropzone.options.myDropzone = {
    // Configuration options go here
  };
</script>
</head>
<body>



<!--form action = "editor.php" method="get" -->
    <textarea name = "textEdit" id = "textEdit">
	<? echo Open($dirProject)->text;?>
	</textarea>
	
	<div   class = "btPlane">
	
	<div class = "btl" onclick = " Display('#vdBlock','');	Display('#auBlock',''); DisplayINV('#ImBlock','inline-block');" id  = "pic"></div>
	<div class = "btl" onclick = " Display('#ImBlock','');  Display('#auBlock','');   DisplayINV('#vdBlock','inline-block');" id  = "vid"></div>
	<div class = "btl" onclick = " Display('#ImBlock','');  Display('#vdBlock','');   DisplayINV('#auBlock','inline-block');" id  = "aud"></div>
	<a href = "view.php?project=<?echo $_GET["project"];?>"><div class = "btl" id  = "view"></div></a>
	<!--div onclick = "PushText('onclick','error','bottomRight')" id  = "pic"></div-->
	</div>
<!--/form-->

	
	
<!--=============================================================Панель зображень с-->
<div class = "media" id = "ImBlock">
<?
$files = scandir($dirProject."/media/image");
foreach ($files as $f)
{
	if($f != "." && $f != "..")
	{
		echo  GetHtmlButton($f,"image",$dirProject);
	}
}
	
?>
</div>


<? echo GetHtmlGegDrob("div#ImBlock","image",$_GET["project"]); ?>

<!--================================================================================-->
	
	

<!--=============================================================Панель Відео с-->
<div class = "media" id = "vdBlock">
<?



$files = scandir($dirProject."/media/video");
foreach ($files as $f)
{
	if($f != "." && $f != "..")
	{
		echo GetHtmlButton($f,"video",$dirProject);
	}
}

	
?>
</div>
<? echo GetHtmlGegDrob("div#vdBlock","video",$_GET["project"]); ?>
<!--================================================================================-->


<!--=============================================================Панель аудіо с-->
<div class = "media" id = "auBlock">
<?


$files = scandir($dirProject."/media/audio");
foreach ($files as $f)
{
	if($f != "." && $f != "..")
	{
		echo GetHtmlButton($f,"audio",$dirProject);
	}
}
/*
$files = scandir($dirProject."/media/audio");
foreach ($files as $f)
{
	$fvalue = $f;
	if($fvalue != "." && $fvalue != "..")
	{
		$src = "/" .  $dirProject . "/media/audio/".$fvalue; 
		$str =  "<div onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '<img src = ".$src.">');\"><img src=\"".$src."\" ><p></p>".$fvalue."</div>";
		echo  $str;
	}
}*/
	
?>
</div>
<? echo GetHtmlGegDrob("div#auBlock","audio",$_GET["project"]); ?>
<!--================================================================================-->
	


</body>


<script>
  //Dropzone.discover();
</script>
 
 
</html>