<?php
$csv  = array();
$file = '../data.csv';
$fp   = fopen($file, "r");
 
while (($data = fgetcsv($fp, 0, ",")) !== FALSE) {
  $csv[] = $data;
}
fclose($fp);

    if (count($_POST) > 0) {
        if(post("all") == "delete"){
            
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Style-Type" content="text/css">
    <meta http-equiv="Content-Script-Type" content="text/javascript">
    <title>お問い合わせ管理画面</title>
    <meta name="description" content="">
    <meta name="keywords" content=",">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--[if IE]> 
	<script type="text/javascript" src="js/html5.js"></script>
	<![endif]-->	
    <link rel="stylesheet" href="css/import.css" >
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/font-awesome.css">
	<script src="js/fix.js"></script>
    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/IE9.js"></script>
    <script type="text/javascript"　src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->
  
</head>

<body>
<div class="bg"></div>
<div id="wrapper">
<div id="header">
	<div class="head_cont clearfix">
    	<h1>お問い合わせ管理システム</h1>
        <ul>
        	<li><p>サイト管理者様</p></li>
            <!-- <li><a href="">ログアウト</a></li> -->
        </ul>
    </div>
<!--//header --></div>


    <div id="contents" class="clearfix">
    <form action="index.php" method="post">
        <div id="menu">
                <h2>メニュー</h2>
                <ul>
                	<li class="menu01 select"><a href="">お問い合わせ管理</a></li>
                    <!-- <li class="menu02"><a href="">企業登録</a></li>
                    <li class="menu03"><a href="">掲載管理情報</a></li>
                    <li class="menu04"><a href="">バナー管理</a></li> -->
                </ul>    
        <!--//main --></div>
        <div id="menu-back"></div>
        <div id="main">
        	<div class="body_cont">
             <div class="control">
             	<div class="allCtrl">
                    
                    <select name="all" class="CtrlList">
                        <option value="">一括操作の選択</option>
                        <!-- <option value="csv">CSVダウンロード</option> -->
                        <!-- <option value="mailSend">メール送信</option>
                        <option value="shareDl">掲載情報ダウンロード</option> -->
                        <option value="delete">削除</option>
                    </select>
                    
                    <input value="実行" name="action" class="action" type="submit">
                    
                </div>
                <p class="search_btn"><i class="fa fa-search"></i></p>
             </div>
             <div class="search_area">
             	<span>お名前 <input type="text" name="name"></span><span>E−mail <input type="text" name="mail"></span><span>年齢 <input type="text" name="age"></span>
                <input type="submit" name="search" value="検索">
             </div>
             <div class="list">
             	<div class="head"><span class="wd5"><input type="checkbox" name=""></span><span class="wd15">お名前</span><span class="wd20">E-mail</span><span class="wd10">年齢</span><span class="wd10">性別</span><span class="wd10">住まい</span><span class="wd15">趣味</span><span class="wd20">自由記入欄</span></div>
                <table>
                <?php 
foreach (array_reverse($csv) as $key => $value) {
     echo '<tr><td class="wd5"><input type="checkbox" name="list'. $key .'" class="check"></td><td class="wd15"><a href="">'. $value[0] .'</a></td><td class="wd20 mailOpen"><a href="">'. $value[1] .'</a></td><td class="wd10">'. $value[2] .'</td><td class="wd10">'. $value[3] .'</td><td class="wd10">'. $value[4] .'</td><td class="wd15">'. $value[5] .'</td><td class="wd20">'. $value[6] .'</td></tr>';
}
    ?>
                	<!-- <tr><td class="wd5"><input type="checkbox" name="" class="check"></td><td class="wd15"><a href="">テストタロウ</a></td><td class="wd20 mailOpen"><a href="">xxxxxx@.co.jp</a></td><td class="wd10">20</td><td class="wd10">男</td><td class="wd10">東京都</td><td class="wd15">サッカー・フットサル</td><td class="wd20">自由記入欄</td></tr> -->
                    
                </table>
             </div>
             
             </div>
        <!--//main --></div>
        </form>
    <!--//contents --></div>
    <div class="mailBox">
    <h3>メール作成</h3>
    <form>
	<dl>
    	<dt><strong>宛先：</strong><span class="mailAdd"></span></dt>
        <dt><strong>タイトル</strong><br><input type="text" name="title"></dt>
        <dd><strong>本文</strong><br><textarea name="desc" rows="15"></textarea></dd>
    </dl>
    <p><input type="submit" class="clk-btn mr20" value="送信"><input type="button" class="close" value="キャンセル"></p>
    </form>
</div>
<!--//wrapper --></div>

<div id="footer">
	<div class="foot">
        <p class="copyright">Copyright © All Rights Reserved.</p>
    </div>
<!--//footer --></div>


</body>
</html>