<?php 
include "config.php";

// SQLのselect部分
$sqlSelect = "news_id,news_title,news_detail,news_url,show_flg,category.cat_name,category.cat_slug,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,DATE_FORMAT(update_date , '%Y.%m.%d') AS update_date";
// SQLのFrom部分
$sqlFrom = "news,category";

$page = 1;
if (isset($_GET['page'])) {
    $page = intval($_GET['page']);
}
$offset = PER_PAGE * ($page - 1);

$pankuzu = "";

if(isset($_GET["cat_id"])){
    $cat_id = $_GET["cat_id"];
    $sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1 AND news.news_cat = ".$cat_id;

    $sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT ".$offset.",". PER_PAGE;

    $total = $pdo->query("SELECT count(*) FROM ". $sqlFrom ." ".$sqlWHERE)->fetchColumn();
    $stmt = $pdo->prepare($sql);
    //パンくず取得
    $pankuzu = $pdo->query("SELECT cat_name FROM category WHERE category.cat_id = ".$cat_id)->fetchColumn();


}else if(isset($_GET["s"])){
    // -------- 検索した時
    $s_title = $_GET["s"];
    $sqlWHERE = "  WHERE category.cat_id = news.news_cat AND news_title LIKE :search AND news_detail LIKE :search";
    $sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT ".$offset.",". PER_PAGE;
    //記事総数を取得
    $sqlPage = "SELECT count(*) FROM ". $sqlFrom ." ".$sqlWHERE; 
    $stmt = $pdo->prepare($sql);
    $stmt2 = $pdo->prepare($sqlPage);
    $stmt->bindValue(':search', "%$s_title%", PDO::PARAM_STR);
    $stmt2->bindValue(':search', "%$s_title%", PDO::PARAM_STR);
    //記事総数を取得
    $stmt2->execute();
    $total = $stmt2->fetchColumn();
    //パンくず取得
    $pankuzu = "検索結果";

}else{
    //通常の一覧ページ
    $sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1";
    $sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT ".$offset.",". PER_PAGE;

    //記事総数を取得
    $total = $pdo->query("SELECT count(*) FROM news")->fetchColumn();
    $stmt = $pdo->prepare($sql);
    //パンくず取得
    $pankuzu = "一覧ページ";
}


$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

function letter($key,$num) {
    if(mb_strlen($key) > $num){
      $key = mb_substr($key,0,$num) . "...";
    }
    return $key;
}

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
$totalPages = ceil($total / PER_PAGE);
$pager = "";
$pageLink = ""; // ページャ以外のGET
//ページャーの生成
$pager .= '<div class="pager"><ul>';
// ページャ以外のGETをリンクに
if (isset($_GET)) {
    foreach ($_GET as $key => $value) {
        if($key == "page"){
            continue;
        }
        $pageLink .= "&".$key."=".$value;
    }
}
if($page != 1){
    $prev = $page-1;
    $pager .= "<li class='first'><a href='?page=".$prev.$pageLink."'>&laquo; 前へ</a></li>";
}
for ($i=1; $i <= $totalPages; $i++) {
    if($page == $i){
        $pager .= "<li><span>".$i."</span></li>";
    }else{
        $pager .= "<li><a href='?page=".$i.$pageLink."'>".$i."</a></li>";
    }
}
if($page != $totalPages){
    $next = $page+1;
    $pager .= "<li class='bext'><a href='?page=".$next.$pageLink."'>次へ &raquo;</a></li>";
}

$pager .= '</ul></div>';
// ******* ページの表示設定ここまで ******* 

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
                    <form action="archive.php?page=1<?php echo $pageLink;?>" method="post" name="pageNumChange">
                    <div class="displayVol">表示件数 <select class="searchNum" name="pageNum">
                        <option value="5" <?php if(PER_PAGE==5) echo 'selected';?> >5</option>
                        <option value="10" <?php if(PER_PAGE==10) echo 'selected';?>>10</option>
                        <option value="15" <?php if(PER_PAGE==15) echo 'selected';?>>15</option>
                        <option value="20" <?php if(PER_PAGE==20) echo 'selected';?>>20</option>
                         </select></div>
                    </form>
                </div>
               <?php echo $pager;?>
            <!-- archiveControl --></div>
            <ul class="itemList heightAlign">
                <?php echo $view; ?>
            </ul>
            <div class="archiveControl">
                <?php echo $pager;?>
            </div>
        </article>

            	
    <!--//main --></div>
<!--//contents --></div>
<?php 
include "footer.php";
?>