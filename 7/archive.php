<?php 
require "admin/config.php";
include "admin/function.php";

// SQLのselect部分
$sqlSelect = "news_id,news_title,news_detail,news_url,show_flg,category.cat_name,category.cat_slug,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,DATE_FORMAT(update_date , '%Y.%m.%d') AS update_date";
// SQLのFrom部分
$sqlFrom = "news,category";


$pankuzu = "";

if(isset($_GET["cat_id"])){
    $cat_id = $_GET["cat_id"];
    $sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1 AND news.news_cat = :id";
    $bindArray = array(array('bind' => ':id', 'value' => $cat_id, 'param' => PDO::PARAM_INT));
    $results = sqlRequest($sqlSelect,$sqlFrom,$sqlWHERE,$sqlPerPage,$bindArray);
    $total = sqlRequest("count(*)",$sqlFrom,$sqlWHERE,null,$bindArray);
    //$pdo->query("SELECT count(*) FROM ". $sqlFrom ." ".$sqlWHERE)->fetchColumn();
    // $stmt = $pdo->prepare($sql);
    //パンくず取得
    //$pankuzu = $pdo->query("SELECT cat_name FROM category WHERE category.cat_id = ".$cat_id)->fetchColumn();


}else if(isset($_GET["s"])){
    // -------- 検索した時
    $s_title = $_GET["s"];
    $sqlWHERE = "  WHERE category.cat_id = news.news_cat AND news_title LIKE :search AND news_detail LIKE :search";
    $sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT ".$offset.",". PER_PAGE;
    $bindArray = array(array('bind' => ':search', 'value' => "%$s_title%", 'param' => PDO::PARAM_STR));
    $results = sqlRequest($sqlSelect,$sqlFrom,$sqlWHERE,$sqlPerPage,$bindArray);
    $total = sqlRequest("count(*)",$sqlFrom,$sqlWHERE,null,$bindArray);
    //パンくず取得
    $pankuzu = "検索結果";

}else{
    //通常の一覧ページ
    $sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1";
    //$sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT ".$offset.",". PER_PAGE;
    $results = sqlRequest($sqlSelect,$sqlFrom,$sqlWHERE,$sqlPerPage);
    //記事総数を取得
    $total = sqlRequest("count(*)","news");
   
    //パンくず取得
    $pankuzu = "一覧ページ";
}


//$stmt->execute();
//$results = $stmt->fetchAll(PDO::FETCH_ASSOC);



$view = "";
foreach($results as $key => $row) {
    //  var_dump($row);
    $view .= "<li><a href='single.php?news_id=" .$row["news_id"]. "'>";
    $view .= "<span class='catIcon " .$row["cat_slug"]. "'>" .$row["cat_name"]. "</span>";
    $view .=  "<figure><img src='admin/files/" .$row["news_url"]. "' alt=''></figure>";
    $view .= "<div class='itemContent'><p class='title'>" .$row["news_title"]. "</p>";
    $view .= "<p class='date'>" .$row["create_date"]. "</p></div></a></li>";
    
}
// table閉じタグで終了

$pdo = null;

// ******* ページの表示設定ここから ********
$pager = pagerMake($total,true);
// ******* ページの表示設定ここまで ******* 
//
include "header.php";
?>
<div id="contents">
   <?php 
    include "sidebar.php";
?>
    <div id="main">
        <p class="pankuzu"><a href="index.php">ホーム</a> > <?php echo $pankuzu; ?></p>
        <article>
            <!-- <h2>カテゴリー名</h2> -->
            <div class="archiveControl">
                <div class="displayArea">
                    <p class="displayDesc">全<span><?php echo $total; ?></span>件中<?php echo $offset + 1;?>〜<?php echo count($results) + $offset;?>件目を表示</p>
                    <form action="archive.php?page=1<?php echo $pager[1];?>" method="post" name="pageNumChange" class="pageNumChange">
                    <div class="displayVol">表示件数 <select class="searchNum" name="pageNum">
                        <option value="5" <?php if(PER_PAGE==5) echo 'selected';?> >5</option>
                        <option value="10" <?php if(PER_PAGE==10) echo 'selected';?>>10</option>
                        <option value="15" <?php if(PER_PAGE==15) echo 'selected';?>>15</option>
                        <option value="20" <?php if(PER_PAGE==20) echo 'selected';?>>20</option>
                         </select></div>
                    </form>
                </div>
               <?php echo $pager[0];?>
            <!-- archiveControl --></div>
            <ul class="itemList heightAlign">
                <?php echo $view; ?>
            </ul>
            <div class="archiveControl">
                <?php echo $pager[0];?>
            </div>
        </article>

            	
    <!--//main --></div>
<!--//contents --></div>
<?php 
include "footer.php";
?>