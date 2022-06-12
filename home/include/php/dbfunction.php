<?
function Login($login,$password) //Функція знаходить користувача в базі даних якщо ні то повертає 'NULL' Якщо пароль виявився не вірний то "false" вірний "true"
{
	 R::setup("sqlite:AppData/setling.db");
	 $s = R::findOne('user', 'login = ?', [$login]);
	 R::close();
	 
	 if($s == NULL) return "NULL";
	 if(password_verify($password,$s->password))
	 {
		 return "true";
	 }
	 else
	 return "false";
}


function SaveProjects($dirProject,$Text)
{
	if(isset($_SESSION["login"]))
	{
		//return "sqlite:AppData/".$dirProject."/text.db";
		R::setup("sqlite:".$dirProject."/text.db");
		if(!R::testConnection()) return "falseOpen";
		$text = R::dispense('text');
		//$text->uid = "id" . uniqid();
		$text->login = $_SESSION["login"];
		$text->text = $Text;
		$text->data = date('d.m.Y');
		$text->time = date('H:i:s');
		R::store($text);
		R::close();
		return "true";
		//urldecode
	}
	else
		return "false";
	
}









function Open($dirProject) 
{
	 R::setup("sqlite:".$dirProject."/text.db");
	 if(!R::testConnection()) return "falseOpen";
	
	$idEnd = R::findOne('sqlite_sequence');
	$text = R::findOne('text',"id = ?",[$idEnd->seq]);
	 R::close();	


	
	 

	 
	 
	 
	 return $text;
}



?>