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
        <li class="menu01 <?php echo currentPage("index.php");?>"><a href="index.php"><i class="icon iList"></i>ニュース一覧</a></li>
        <li class="menu02 <?php echo currentPage("input.php");?>"><a href="input.php"><i class="icon iNew"></i>ニュース新規登録</a></li>
        <li class="menu03 <?php echo currentPage("category.php");?>"><a href="category.php"><i class="icon iCat"></i>カテゴリー情報</a></li>
        <li class="menu04 <?php echo currentPage("files.php");?>"><a href="files.php"><i class="icon iPic"></i>画像情報</a></li>
        <li class="menu05 <?php echo currentPage("account.php");?>"><a href="account.php"><i class="icon iUser"></i>アカウント情報</a></li>

    </ul>    
<!--//menu --></div>
<div id="menu-back"></div>