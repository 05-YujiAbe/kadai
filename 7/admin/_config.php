<?php
	define('DB_HOST','mysql518.db.sakura.ne.jp');
	define('DB_NAME','fun-gs_news');
	define('DB_USER','fun-gs');
	define('DB_PASSWORD','47k5eg3xbx');
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