<?php 
include "config.php";

$id = $_GET["news_id"];
// SQLのselect部分
$sqlSelect = "news_id,news_title,news_detail,news_url,news_cat,category.cat_name,category.cat_slug,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date";
// SQLのFrom部分
$sqlFrom = "news,category";
$sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1 AND news.news_id = ".$id;
$sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE;
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

function letter($key,$num) {
    if(mb_strlen($key) > $num){
      $key = mb_substr($key,0,$num) . "...";
    }
    return $key;
}

$title; //タイトル
$detail; //本文
$imgurl;
$cat_id; //画像のパス
$cat_name; //カテゴリー
$cat_slug; //カテゴリー
$create_date; //登録日

foreach($results as $key => $row) {
    //  var_dump($row);
    $title = $row["news_title"];
    $detail = nl2br(htmlspecialchars_decode($row["news_detail"]));
    $imgurl = $row["news_url"];
    $cat_id = $row["news_cat"];
    $cat_name = $row["cat_name"];
    $cat_slug = $row["cat_slug"];
    $create_date = $row["create_date"];
}


// 他の記事

$sqlSelect = "news_id,news_title,news_detail,news_url,news_cat,category.cat_name,category.cat_slug,DATE_FORMAT(create_date , '%Y.%m.%d') AS create_date";
// SQLのFrom部分
$sqlFrom = "news,category";
$sqlWHERE = " WHERE category.cat_id = news.news_cat AND show_flg = 1 AND news.news_cat = ".$cat_id ." AND news.news_id != ".$id;
$sql = "SELECT ". $sqlSelect ." FROM ". $sqlFrom ." ".$sqlWHERE." LIMIT 6";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results2 = $stmt->fetchAll(PDO::FETCH_ASSOC);
$view = "";
foreach($results2 as $key => $row) {
    //  var_dump($row);
    $view .= "<li><a href='single.php?news_id=" .$row["news_id"]. "'>";
    $view .= "<span class='catIcon " .$row["cat_slug"]. "'>" .$row["cat_name"]. "</span>";
    $view .=  "<figure><img src='admin/files/" .$row["news_url"]. "' alt=''></figure>";
    $view .= "<div class='itemContent'><p class='title'>" .$row["news_title"]. "</p>";
    $view .= "<p class='date'>" .$row["create_date"]. "</p></div></a></li>";
}
$pankuzu = $pdo->query("SELECT cat_name FROM category WHERE category.cat_id = ".$cat_id)->fetchColumn();

$pdo = null;

include "header.php";

?>

<div id="contents">
    <?php 
    include "sidebar.php";
?>
    <div id="main">
        <p class="pankuzu"><a href="">ホーム</a> > <a href="archive.php?cat_id=<?php echo $cat_id;?>"><?php echo $pankuzu; ?></a> > <?php echo letter($title,30); ?></p>
        <article class="articleArea">
            <figure><img src="admin/files/<?php echo $imgurl;?>" alt=""></figure>
            <h2><?php echo $title;?></h2>
            <div class="artInfo">
                <div><span class="catIcon <?php echo $cat_slug;?>"><?php echo $cat_name;?></span></div>
                <div class="txtR"><span class="date"><?php echo $create_date;?></span></div>
            </div>
            <div class="artContents">
                <?php echo $detail;?>
            </div>
            <div class="social">
                <div class="l02"><iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo $nowUrl; ?>&amp;layout=button_count&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;height=21&amp;width=90" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:21px; width:105px;" allowtransparency="true"></iframe></div>
                <div class="l03"><a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
                <div class="l01"><a href="http://b.hatena.ne.jp/entry/<?php echo $nowUrl; ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php echo $title; ?>" data-hatena-bookmark-layout="standard-balloon" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only.gif" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a><script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script></div>
                <div class="pocket"><a data-pocket-label="pocket" data-pocket-count="horizontal" class="pocket-btn" data-lang="en"></a>
                <script type="text/javascript">!function(d,i){if(!d.getElementById(i)){var j=d.createElement("script");j.id=i;j.src="https://widgets.getpocket.com/v1/j/btn.js?v=1";var w=d.getElementById(i);d.body.appendChild(j);}}(document,"pocket-btn-js");</script>
                </div>

            </div>
        </article>
        <h2>他の記事</h2>
        <ul class="itemList heightAlign">
                <?php echo $view; ?>
            </ul>
            	
    <!--//main --></div>
<!--//contents --></div>
<?php 
include "footer.php";
?>