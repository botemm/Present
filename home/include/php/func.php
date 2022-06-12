<?

function GetHtmlButton($file,$type,$dir) //Отримати html Кнопки для вставки блоку
{
	$src = "/" .  $dir . "/media/".$type."/".$file;  //Формуємо адресу фала
	$fvalue = $file;
	
	if($type == "image")
	{
		$img = "<img src = \"".$src."\">";
		return  "<div onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '". htmlspecialchars($img)."');\">".$img."<p></p>".$fvalue."</div>";
	}
	else
	if($type == "video")
	{
		$sorce = "<video style= \"display: inline-block;\"  controls> <source src=\"".$src."\"></video>";
		$vid = "<div  onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '". htmlspecialchars($sorce)."');\"  class = \"vid\">".$sorce."<p>".$fvalue."</p>"."</div>";
		return $vid;
		//return  "<div onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '". htmlspecialchars($vid)."');\">".$img."<p></p>".$fvalue."</div>";
	}
	else
	if($type == "audio")
	{
		$sorce = "<audio style= \"display: inline-block;\"  controls> <source src=\"".$src."\"></audio>";
		$vid = "<div  onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '". htmlspecialchars($sorce)."');\"  class = \"vid\">".$sorce."<p>".$fvalue."</p>"."</div>";
		return $vid;
		//return  "<div onclick = \"tinymce.activeEditor.execCommand('mceInsertContent', false, '". htmlspecialchars($vid)."');\">".$img."<p></p>".$fvalue."</div>";
	}	
	//audio
	
	/*
	
		
		$htmlTagClick = "onclick = \"test\"";

		$htmlTag = str_replace("Vclick",$htmlTagClick,$htmlTag);
		$htmlTag = str_replace("Vhtml",$htmlTagHtml,$htmlTag);
	*/
	
}


function GetHtmlGegDrob($selector,$type,$project)
//function GetHtmlGegDrob($selector,"image",$_GET["project"])
{
	$dir = "project/".$project;
	$acceptedFiles = "";
	if($type == "image")
	{
		$acceptedFiles = "image/*";
	}
	
	if($type == "video")
	{
		$acceptedFiles = ".mp4,.mkv,.3gp";
	}
	if($type == "audio")
	{
		$acceptedFiles = "audio/*";
	}
	$script = "<script>";
	
	
	$script = $script . "{let myDropzone = new Dropzone('".$selector."', {";
	$script = $script . "url: 'sendmediaim.php',";
	$script = $script . "acceptedFiles: '".$acceptedFiles."',";
	$script = $script . "addedfile: file => { console.log(file.upload.progress);	},";
	
	$script = $script . "\nsuccess: file => {	 ";//Якщо успіх файл завантажено
		//paste ======================================================
		//GetHtmlButton(,$type,$dir);
		
		
	$script = $script . "\nlet src = '";
	$script = $script . addslashes((GetHtmlButton('uid99305484309',$type,$dir)));
	$script = $script . "';";
	$script = $script . "\nsrc = src.replaceAll('uid99305484309',file.upload.filename);";
	
	
	
	$script = $script . "var main= document.querySelector('".$selector."'); main.innerHTML += src;";
	$script = $script . "},";
	
	
    $script = $script . " init: function() {";
    $script = $script . " this.on('sending', function(file, xhr, formData){";
    $script = $script . "  formData.append('project', '".$project."' + '/media/".$type."')";
    $script = $script . "        }),";
    $script = $script . "   this.on('success', function(file, xhr){";
                //alert(file.xhr.response);
    $script = $script . "        })";
    $script = $script . "    },";
	
	$script = $script . "});";
	$script = $script . "}</script>";






return $script;
}


?>