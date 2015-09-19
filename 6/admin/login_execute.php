<?php
$user = $_POST["user"];
$password = $_POST["password"];

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT user_name,password FROM cs_user WHERE id = 1";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($results as $row) {
    $db_user = $row["user_name"];
    $db_password = $row["password"];
}


session_start();
if($user == $db_user && $password == $db_password){
    $_SESSION["login"] = "login";
    header("Location: index.php");  
}else{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <title>管理画面</title>
    <meta name="description" content="">
    <meta name="keywords" content=",">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]> 
	<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->	
    <link rel="stylesheet" href="css/style.css" >
    <script type="text/javascript" src="js/jquery.min.js"></script>
	<script src="js/common.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/IE9.js"></script>
    <script type="text/javascript"　src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->
  
</head>

<body class="login">


<div id="header">
	<div class="head_cont clearfix">
    	<h1><a nohref="">管理画面</a></h1>
        
    </div>
<!--//header --></div>

<div id="wrapper">
    <div id="contents" class="clearfix">
        
       <div id="contents" class="clearfix loaderArea">
        
        <div class="loader">
            <p><img src="css/loader.gif" alt=""></p>
        </div>
        
    <!--//contents --></div>
        
    <!--//contents --></div>
<!--//wrapper --></div>

<div id="footer">
	<div class="foot">
        <p class="copyright">Copyright .All Rights Reserved.</p>
    </div>
<!--//footer --></div>


</body>
</html>