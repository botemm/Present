<? //Підключення до бази даних перевірка на логін і опрацювання запитів 

require "include/php/db.php";
require "include/php/func.php";


if(!isset($_SESSION["login"]))
	header('Location: /login.php '); //Тут доступ тільки авторизованим



if(isset($_POST["text"])) //Якщо надіслано зі змінною текст значить не відображаємо сторінку це запит на збереження зберігаєм і кажемо що все ок
{

	file_put_contents("AppData/temp/" . $_SESSION["login"],$_POST["text"]);
	exit("ok");

}

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


<!--link rel="stylesheet" type="text/css" href="/include/css/style.css"-->
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/noty.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/mint.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/light.css">
<link rel="stylesheet" type="text/css" href="/node_modules/noty/lib/themes/metroui.css">








<link rel="stylesheet" type="text/css" href="/node_modules/tinymce/skins/content/document/content.css">
<link rel="stylesheet" type="text/css" href="/node_modules/tinymce/skins/content/document/content.min.css">


<title><? echo htmlspecialchars($_GET["project"]); ?></title>



<style>
img
{
	max-width:100%; 
	height:auto;

}

@media (orientation: portrait) { 
body{
	
	padding:30px;
	margin:0px;
		min-width:100%; 
		font-size: 
		200%;
}
html
{
max-width:100%; 
	padding:0px;
	
	margin:0px;
	
}


.mce-content-body div:active
{
	border: 3px solid #333;
}



</style>

 <script type="text/javascript">


function SendText(textA) //Функція зберігання документа
{
	let getq = "view.php";
	
		var httpReq = new XMLHttpRequest();
            httpReq.open("POST",getq);
			httpReq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            httpReq.send("text="+encodeURIComponent(textA));
    
 
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
				  PushText(httpReq.responseText,'success','topRight');
                }
 
            }
}
 
function Touch(T)
{
	//console.log(T);
	//alert("Touch");
	SendText(T.innerHTML);
}




</script>


</head>
<body>


<div id="tinymce" class="mce-content-body " data-id="textEdit">
<!--form action = "editor.php" method="get" -->
    <!--textarea name = "textEdit" id = "textEdit"-->
	<? 
	$text = Open($dirProject)->text;
	$text = str_replace("<table","<div onclick = 'Touch(this);'> <table",$text);
	$text = str_replace("</table>","</table></div>",$text);
	
	
	$text = str_replace("<p","<div onclick = 'Touch(this);'> <p",$text);
	$text = str_replace("</p>","</p></div>",$text);
	
	
	$text = str_replace("<h1","<div onclick = 'Touch(this);'> <h1",$text);
	$text = str_replace("</h1>","</h1></div>",$text);
	
		$text = str_replace("<h2","<div onclick = 'Touch(this);'> <h2",$text);
	$text = str_replace("</h2>","</h2></div>",$text);
	
		$text = str_replace("<h3","<div onclick = 'Touch(this);'> <h3",$text);
	$text = str_replace("</h3>","</h3></div>",$text);
	
		$text = str_replace("<h4","<div onclick = 'Touch(this);'> <h4",$text);
	$text = str_replace("</h4>","</h4></div>",$text);
	
		$text = str_replace("<h5","<div onclick = 'Touch(this);'> <h5",$text);
	$text = str_replace("</h5>","</h5></div>",$text);
	
	

	$text = str_replace("<ol","<div onclick = 'Touch(this);'> <ol",$text);
	$text = str_replace("</ol>","</ol></div>",$text);
		

	$text = str_replace("<ul","<div onclick = 'Touch(this);'> <ul",$text);
	$text = str_replace("</ul>","</ul></div>",$text);	
	
	
	
	$text = str_replace("<audio","<div onclick = 'Touch(this);'> <audio",$text);
	$text = str_replace("</audio>","</audio></div>",$text);	
	
	$text = str_replace("<video","<div onclick = 'Touch(this);'> <video autoplay  ",$text);
	$text = str_replace("</video>","</video></div>",$text);	
	
	echo $text;
	
	//<table 
	?>
	<!--/textarea-->
</div>	
	<div   class = "btPlane">
	<div class = "btl" onclick = " Display('#vdBlock','');	Display('#auBlock',''); DisplayINV('#ImBlock','inline-block');" id  = "pic"></div>
	<div class = "btl" onclick = " Display('#ImBlock','');  Display('#auBlock','');   DisplayINV('#vdBlock','inline-block');" id  = "vid"></div>
	<div class = "btl" onclick = " Display('#ImBlock','');  Display('#vdBlock','');   DisplayINV('#auBlock','inline-block');" id  = "aud"></div>
	<!--div onclick = "PushText('onclick','error','bottomRight')" id  = "pic"></div-->
	</div>
<!--/form-->

	


</body>


<script>
  //Dropzone.discover();
</script>
 
 
</html>