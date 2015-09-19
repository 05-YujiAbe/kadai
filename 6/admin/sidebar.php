<?php
$url = $_SERVER['REQUEST_URI'];
function currentPage($e){
	global $url;
	if(strstr($url,$e)){
		return "select";
	}
}
?> 
<div id="menu">
    <h2>メニュー</h2>
    <ul>
        <li class="menu01 <?php echo currentPage("index");?>"><a href="index.php">ニュース一覧</a></li>
        <li class="menu02 <?php echo currentPage("input");?>"><a href="input.php">ニュース新規登録</a></li>
        <li class="menu03 <?php echo currentPage("category");?>"><a href="category.php">カテゴリー情報</a></li>
    </ul>    
<!--//menu --></div>
<div id="menu-back"></div>