<?php 
include "config.php";

// SQLのselect部分
$sqlSelect = "news_id,news_title,news_detail,news_url,show_flg,category.cat_name,category.cat_slug,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date,DATE_FORMAT(update_date , '%Y.%m.%d') AS update_date";
// SQLのFrom部分
$sqlFrom = "news,category";
$sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1 ORDER BY create_date DESC";
$sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT 9";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

function letter($key,$num) {
    if(mb_strlen($key) > $num){
      $key = mb_substr($key,0,$num) . "...";
    }
    return $key;
}

$viewMain = "";
$view = "";
foreach($results as $key => $row) {
    //  var_dump($row);
    if($key < 3){
        $viewMain .= "<li><a href='single.php?news_id=" .$row["news_id"]. "'><dl><dt>";
        $viewMain .= "<img src='admin/files/" .$row["news_url"]. "' alt=''></dt><dd><div class='sub'>";
        $viewMain .= "<span class='catIcon " .$row["cat_slug"]. "'>" .$row["cat_name"]. "</span>";
        $viewMain .= "<span class='date'>" .$row["create_date"]. "</span></div>";
        $viewMain .= "<h2>" .$row["news_title"]. "</h2>";
        $viewMain .= "<p class='detail'>" .letter(htmlspecialchars_decode($row["news_detail"]),100). "</p>";
        $viewMain .= "</dd></dl></a></li>";
    }else{
        $view .= "<li><a href='single.php?news_id=" .$row["news_id"]. "'>";
        $view .= "<span class='catIcon " .$row["cat_slug"]. "'>" .$row["cat_name"]. "</span>";
        $view .=  "<figure><img src='admin/files/" .$row["news_url"]. "' alt=''></figure>";
        $view .= "<div class='itemContent'><p class='title'>" .$row["news_title"]. "</p>";
        $view .= "<p class='date'>" .$row["create_date"]. "</p></div></a></li>";
    }
    
}
// table閉じタグで終了

$pdo = null;

include "header.php";
?>
<div id="contents">
<?php 
    include "sidebar.php";
?>
    <div id="main">
        <div id="mainVisual">
            <ul>
                <?php echo $viewMain; ?>
            </ul>
        <!-- mainVisual --></div>
        <section><!-- 
            <h2>PICK UP</h2> -->
            <ul class="itemList heightAlign">
                <?php echo $view; ?>
            </ul>
            <p class="moreLink"><a href="archive.php">&raquo; MORE</a></p>
        </section>

            	
    <!--//main --></div>
<!--//contents --></div>
<?php 
include "footer.php";
?>