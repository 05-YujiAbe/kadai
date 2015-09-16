<?php
include "session.php";

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT news_id,news_title,show_flg,news_cat,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,DATE_FORMAT(update_date , '%Y.%m.%d') AS update_date FROM news";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$view = "";
$view .= "<table>";
foreach($results as $row) {
if($row["show_flg"] == 1){
	$showFlg = "<span class='now'>掲載中</span>";
}else{
	$showFlg = "<span>非掲載</span>";
}
//	var_dump($row);
	$view .= "<tr>";
	$view .= "<td class='wd5'><input type='checkbox' name='check".$row["news_id"]."' class='check'></td>";
	$view .= "<td class='wd5'><a href='update.php?id=" .$row["news_id"]. "'>" .$row["news_id"]. "</a></td>";
	$view .= "<td class='wd25'><a href='update.php?id=" .$row["news_id"]. "'>".$row["news_title"]."</a></td>";
	$view .= "<td class='wd10'>" .$row["news_cat"]. "</td><td class='wd15'>" .$row["create_date"]. "</td>";
	$view .= "<td class='wd15'>" .$row["update_date"]. "</td><td class='wd15'>" . $showFlg . "</td>";
	$view .= "</tr>";

}
// table閉じタグで終了
$view .= "</table>";

include "header.php";
?>
<div id="menu">
                <h2>メニュー</h2>
                <ul>
                	<li class="menu01 select"><a href="index.php">ニュース一覧</a></li>
                    <li class="menu02"><a href="input.php">ニュース新規登録</a></li>
                    <li class="menu03"><a href="category.php">カテゴリー情報</a></li>
                </ul>    
        <!--//main --></div>
        <div id="menu-back"></div>
        <div id="main">
        	<div class="body_cont">
             <div class="control">
             	<div class="allCtrl">
                    <select name="all" class="CtrlList">
                        <option value="">一括操作の選択</option>
                        <option value="change">変更</option>
                        <option value="delete">削除</option>
                    </select>
                    <input value="実行" name="action" class="action" type="submit" onClick="allControl();">
                </div>
                <p class="search_btn"><i class="fa fa-search"></i></p>
             </div>
             <div class="search_area">
                <form action="index.php" name="get">
             	  <span>タイトル <input type="text" name="title"></span><span>本文 <input type="text" name="honbun"></span>
                    <input type="submit" name="search" value="検索">
                </form>
             </div>
             <div class="list">
             	<div class="head"><span class="wd5"><input type="checkbox" name=""></span><span class="wd5">id</span><span class="wd25">タイトル</span><span class="wd10">カテゴリ</span><span class="wd15">登録日</span><span class="wd15">更新日</span><span class="wd15">表示状態</span></div>
                <table>
                	<?php echo $view ?>
                </table>
             </div>
             
             </div>
        <!--//main --></div>
<?php
include "footer.php";
?>