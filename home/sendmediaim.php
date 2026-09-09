<?php
//if(var_dump($_POST)) file_put_contents("POST.txt",var_dump($_POST));
//if(var_dump($_GET)) file_put_contents("GET.txt",var_dump($_GET));


$ds          = DIRECTORY_SEPARATOR;  //1
 
$project = str_replace(['..', '/', '\\'], ['', DIRECTORY_SEPARATOR, DIRECTORY_SEPARATOR], $_POST['project'] ?? '');
$storeFolder = "project/" . $project;   //2
 //echo $storeFolder;
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. basename($_FILES['file']['name']);  //5
 
    if(is_dir($targetPath))
        move_uploaded_file($tempFile,$targetFile); //6
     
}
?>   
