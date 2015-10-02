<?php
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=utf8", DB_USER, DB_PASSWORD);
// SQLのselect部分
$sqlSelect = "news.news_id,news_title,news_url,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,view.views,category.cat_name,category.cat_slug";
$sqlFrom = "news,view,category";
$sqlWHERE = " WHERE news.news_cat = category.cat_id AND news.news_id = view.news_id ORDER BY view.views DESC";

// SQLの実行
$results = sqlRequest($sqlSelect,$sqlFrom,$sqlWHERE,$sqlPerPage);
$pdo = null;
//var_dump($results);
$rankingview = "<ul>";
foreach($results as $key => $row) {
    //  var_dump($row);
    $rankingview .= "<li><a href='single.php?news_id=" .$row["news_id"]. "'><dl><dt>";
    $rankingview .=  "<figure><img src='admin/files/" .$row["news_url"]. "' alt=''></figure></dt>";
    $rankingview .= "<dd><div class='sub'><span class='catIcon " .$row["cat_slug"]. "'>" .$row["cat_name"]. "</span>";
    $rankingview .=  "<span class='date'>" .$row["create_date"]. "</span></div>";
   // $rankingview .= "<div class='itemContent'><p class='title'>" .$row["news_title"]. "</p>";
    $rankingview .= "<h3>" .$row["news_title"]. "</h3><p class='views'>" .$row["views"]. "view</p></dd></dl></a></li>";
}
$rankingview .= "</ul>";
?>

<div id="side">
        <div class="inside ranking">
            <h2>記事ランキング</h2>
            <?php echo $rankingview; ?>
        </div>
        <div class="bnrArea">
            <ul>
                <li><a href="">バナー</a></li>
                <li><a href="">バナー</a></li>
            </ul>
        </div>
    <!-- side --></div>