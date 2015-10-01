<?php
include "session.php";
include "config.php";
include "function.php";

// SQLのselect部分
$sqlSelect = "news_id,news_title,news_detail,show_flg,category.cat_name,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,DATE_FORMAT(update_date , '%Y.%m.%d') AS update_date";
// SQLのFrom部分
$sqlFrom = "news,category";
// SQLのページング部分

// -------- カテゴリー一覧からのリンク
if(isset($_GET["category_id"])){
		$cat_id = $_GET["category_id"];
		// SQLのWHEREの箇所の設定--
		$sqlWHERE = " WHERE category.cat_id = news.news_cat AND news.news_cat = ".$cat_id;
		// $sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE.$sqlPerPageE;

		//記事総数を取得
		$total = sqlRequest("count(*)",$sqlFrom,$sqlWHERE);

}else if(isset($_GET["title"])){
	// -------- 検索した時
	$s_title = $_GET["title"];
	$s_detail = $_GET["detail"];
	$sqlWHERE = "  WHERE category.cat_id = news.news_cat AND news_title LIKE :title AND news_detail LIKE :detail";
	//記事総数を取得

	//$sqlPage = "SELECT count(*) FROM ". $sqlFrom ." ".$sqlWHERE;
	$bindArray = array(array('bind' => ':title', 'value' => "%$s_title%", 'param' => PDO::PARAM_STR),array('bind' => ':detail', 'value' => "%$s_detail%", 'param' => PDO::PARAM_STR));
	//記事総数を取得
	$total = sqlRequest("count(*)",$sqlFrom,$sqlWHERE,null,$bindArray);

} else {
	//通常の一覧ページ
	$sqlWHERE = " WHERE category.cat_id = news.news_cat";
	//記事総数を取得
	$total = sqlRequest("count(*)","news");
	
}
// SQLの実行
$results = sqlRequest($sqlSelect,$sqlFrom,$sqlWHERE,$sqlPerPage,$bindArray);
$catArray = sqlRequest("*","category");

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
	$view .= "<td class='wd10'>" .$row["cat_name"]. "</td><td class='wd15'>" .$row["create_date"]. "</td>";
	$view .= "<td class='wd15'>" .$row["update_date"]. "</td><td class='wd15'>" . $showFlg . "</td>";
	$view .= "</tr>";

}
// table閉じタグで終了
$view .= "</table>";

// ******* ページの表示設定ここから ********
$pager = pagerMake($total);
// ******* ページの表示設定ここまで ******* 

$pdo = null;
include "header.php";
include "sidebar.php";
?>

       
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
                <form action="<?php echo $_SERVER["REQUEST_URI"];?>" name="pageNumChange" method="post" class="pageNumChange">
                	表示数
                	<select name="pageNum" id="" class="pageNum">
                		<option value="2" <?php if(PER_PAGE==2) echo 'selected';?> >2</option>
                		<option value="5" <?php if(PER_PAGE==5) echo 'selected';?>>5</option>
                		<option value="10" <?php if(PER_PAGE==10) echo 'selected';?>>10</option>
                		<option value="20" <?php if(PER_PAGE==20) echo 'selected';?>>20</option>
                	</select>
                	件
                </form>
             </div>
             <div class="search_area">
                <form action="index.php" name="get">
             	  <span>タイトル <input type="text" name="title"></span><span>本文 <input type="text" name="detail"></span>
                    <input type="submit" value="検索" >
                </form>
             </div>
             <div class="list">
             	<div class="head"><span class="wd5"><input type="checkbox" name=""></span><span class="wd5">id</span><span class="wd25">タイトル</span><span class="wd10">カテゴリ</span><span class="wd15">登録日</span><span class="wd15">更新日</span><span class="wd15">表示状態</span></div>
                <table>
                	<?php echo $view; ?>
                </table>
             </div>
             <?php echo $pager; ?>
             
             </div>
        <!--//main --></div>
<?php
include "footer.php";
?>