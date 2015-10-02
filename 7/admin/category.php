<?php
include "session.php";
require "config.php";
include "function.php";
    

if(count($_POST) > 0){
    //新規作した場合
    // $id = $_POST["id"];
    $catTitle = htmlspecialchars($_POST["catTitle"], ENT_QUOTES, 'UTF-8');
    $catSlug = htmlspecialchars($_POST["catSlug"], ENT_QUOTES, 'UTF-8');
    $catDesc = htmlspecialchars($_POST["catDesc"], ENT_QUOTES, 'UTF-8');
    // $imgurl; //画像のパス
    $sql = "INSERT INTO category (cat_id, cat_name, cat_slug, cat_description) VALUES (NULL, '" . $catTitle . "', '" . $catSlug . "', '" . $catDesc . "') ";

    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    header("Location: category.php?result=".$result);
    
}
    $catId;
    $catTitle; //タイトル
    $catSlug; //スラッグ
    $catDesc; //説明
    $catArray = sqlRequest("*","category");
    $view = "";
    $view .= "<table>";
    $sqlWHERE = " WHERE category.cat_id = news.news_cat";
    $sqlFrom = "news,category";
    foreach($catArray as $row) {
        $total = $pdo->query("SELECT count(*) FROM ". $sqlFrom . $sqlWHERE . " AND news.news_cat = " .$row['cat_id'])->fetchColumn();

        $catDesc = nl2br(htmlspecialchars_decode($row["cat_description"]));
        $view .= "<tr>";
        $view .= "<td class='wd5'><input type='checkbox' name='check' class='check'></td>";
        $view .= "<td class='wd15'><a href='edit-category.php?id=".$row["cat_id"]."'>".$row["cat_name"]."</a></td>";
        $view .= "<td class='wd20'>". $catDesc ."</td>";
        $view .= "<td class='wd15'>". $row["cat_slug"] ."</td>";
        $view .= "<td class='wd10'><a href='index.php?category_id=".$row["cat_id"]."'>".$total."</a></td>";
        $view .= "</tr>";
    }

// table閉じタグで終了
$view .= "</table>";
// 結果表示
if(isset($_GET["result"])) {
    if($_GET["result"] == 1) {
        $msg = '<p class="msg msg-success">カテゴリーを追加しました！<a href="" class="fadeOut">非表示</a></p>';
    } else {
        $msg = '<p class="msg msg-failed">カテゴリーを追加に失敗しました！<a href="" class="fadeOut">非表示</a></p>';
    }
}


$pdo = null;
include "header.php";
include "sidebar.php";
?>
        
         <div id="main">
            <div class="body_cont">
             <div class="control">
                <div class="editCtrl">
                </div>
                <div class="editName">
                    
                </div>
             </div>
             
             <div class="section">
                <?php if(isset($msg)){
                    echo $msg;
                }
                ?>
                <h3>カテゴリー</h3>
                <form action="category.php" method="post">
                <div class="categoryArea">
                    <div class="addCategory">
                        <h4>新規カテゴリーを追加</h4>
                        <form action="" method="post">
                        <dl>
                            <dt>名前</dt>
                            <dd><input type="text" name="catTitle"></dd>
                            <dt>スラッグ</dt>
                            <dd><input type="text" name="catSlug"></dd>
                            <dt>親</dt>
                            <dd></dd>
                            <dt>説明</dt>
                            <dd><textarea name="catDesc" id="" rows="5"></textarea></dd>
                        </dl>
                        <input type="submit" value="新規カテゴリーを追加" class="clk-btn">
                        </form>
                    <!-- addCategory --></div>
                    <div class="categoryList">
                        <div class="list">
                            <div class="head"><span class="wd5"><input type="checkbox" name=""></span><span class="wd15">名前</span><span class="wd20">説明</span><span class="wd15">スラッグ</span><span class="wd10">カウント</span></div>
                            <table>
                               <?php echo $view; ?>
                            </table>
                        </div>
                    <!-- categoryList --></div>
                </div>
                </form>
            <!-- section --></div>
        <!--//main --></div>
<?php
include "footer.php";
?>