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
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/tinymce/tinymce.min.js"></script>
    
    <script src="js/common.js"></script>
     <script type="text/javascript">
        tinymce.init({
            selector: "#textarea",
            theme: "modern",
            language : "ja",
             plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ]
        });
    </script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/IE9.js"></script>
    <script type="text/javascript"　src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->
  
</head>

<body>
<div class="bg"></div>

<div id="header">
    <div class="head_cont clearfix">
        <h1><a href="index.php">管理画面</a></h1>
        <ul>
            <li><p>サイト管理者様</p></li>
            <li><a href="login.php">ログアウト</a></li>
        </ul>
    </div>
<!--//header --></div>

<div id="wrapper">
    <div id="contents" class="clearfix">