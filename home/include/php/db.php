<?
session_start();

require "rb.php";

// R::setup("sqlite:AppData/setling.db"); Немає загальної бази даних тому підключаємо тільки де треба 

/*
if(!R::testConnection()) die('No DB connection!');
$book = R::dispense('user');
$book->login = 'admin';
$book->password = password_hash("admin", PASSWORD_DEFAULT);
R::store($book);*/


//R::setup("././AppData/setling.db");  
//AppData
require "dbfunction.php";

?>