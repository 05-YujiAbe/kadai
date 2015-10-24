<?php
	define('DB_HOST','localhost');
	define('DB_NAME','ibarucky');
	define('DB_USER','root');
	define('DB_PASSWORD','');

	//ページング基本条件
	if(isset($_POST["pageNum"])){
		$_SESSION["pageNum"] = $_POST["pageNum"];
	}
	if (isset($_SESSION["pageNum"])) { 
		define('PER_PAGE',$_SESSION["pageNum"]);
	}else{
		define('PER_PAGE',5);
	}
	$page = 1;
	if (isset($_GET['page'])) {
		$page = intval($_GET['page']);
	}
	$offset = PER_PAGE * ($page - 1);
	//ページのSQL
	$sqlPerPage = " LIMIT ".$offset.",". PER_PAGE;
	//bindValueの初期値
	$bindArray = null;
	//現在のURLを取得
	$nowUrl = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	$pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);

	$key_id = "bb21d84dbeb85145de1fe3a2eca0eb6a";
	$format = "json";

?>