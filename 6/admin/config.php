<?php
	define('DB_HOST','localhost');
	define('DB_NAME','cs_academy');
	define('DB_USER','root');
	define('DB_PASSWORD','');

	if(isset($_POST["pageNum"])){
		$_SESSION["pageNum"] = $_POST["pageNum"];
	}
	if (isset($_SESSION["pageNum"])) { 
		define('PER_PAGE',$_SESSION["pageNum"]);
	}else{
		define('PER_PAGE',5);
	}
	

	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
?>