<?php
session_start();
session_destroy();
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
        
        <div class="login_area">
        	<div class="login_cont">
                <form action="login_execute.php" method="post">
                <p class="error">必須項目です</p>
            	<p class="mb20">ユーザー名：<br><input type="text" value="" name="user" class="req"></p>
                <p class="error">必須項目です</p>
                <p class="mb20">パスワード：<br><input type="password" value="" name="password" class="req"></p>
                
                <p class="mb10"><label><input type="checkbox" name="memory"> パスワードを保存する</label></p>
                <p class="center"><input type="submit" value="ログイン" class="btnLogin"></p>
                </form>
            </div>
        </div>
        
    <!--//contents --></div>
<!--//wrapper --></div>

<div id="footer">
	<div class="foot">
        <p class="copyright">Copyright .All Rights Reserved.</p>
    </div>
<!--//footer --></div>


</body>
</html>