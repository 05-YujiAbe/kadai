<?php
include "session.php";
$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");

if(count($_POST) > 0){
    //更新した場合
    $id = $_POST["id"];
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $detail = htmlspecialchars($_POST["detail"], ENT_QUOTES, 'UTF-8');
    // $imgurl; //画像のパス
    $cat = $_POST["category"]; //カテゴリー
    $showFlg = $_POST["show"]; //表示非表示
    $create_date = $_POST["create_date"]; //登録日
    $sql = "UPDATE news set news_title = '" . $title . "', news_detail = '" . $detail . "', show_flg = " . $showFlg . ", news_cat = " . $cat . ", create_date = CAST('" .  $create_date . "' AS DATETIME ), update_date = sysdate() " . "WHERE news_id = " . $id;
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    header("Location: update.php?id=".$id."&result=".$result);
}else{
    //新規作成、一覧からリンクしてきた時

    $id = $_GET["id"];
    $title; //タイトル
    $detail; //本文
    $imgurl; //画像のパス
    $cat; //カテゴリー
    $showFlg; //表示非表示
    $create_date; //登録日
    $update_date; //更新日
    $sql = "SELECT news_id,news_title,news_detail,news_url,show_flg,news_cat,create_date,update_date FROM news WHERE news_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $row) {

        $title = $row["news_title"];
        $detail = nl2br(htmlspecialchars_decode($row["news_detail"]));
        $imgurl = $row["news_url"];
        $cat = $row["news_cat"];
        $showFlg = $row["show_flg"];
        $create_date = $row["create_date"];
        $update_date = $row["update_date"];
    }
}
if(isset($_GET["result"])) {
    if($_GET["result"] == 1) {
        $msg = '<p class="msg msg-success">記事の更新の成功しました！<a href="" class="fadeOut">非表示</a></p>';
    } else {
        $msg = '<p class="msg msg-failed">記事の更新の失敗しました！<a href="" class="fadeOut">非表示</a></p>';
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
                    <a href="index.php">&laquo; 一覧へ戻る</a>
                </div>
                <div class="editName">
                    <p><a href="http://localhost/kadai/6/news.php?news_id=<?php echo $id; ?>" target="_blank">このページを見る</a></p>
                </div>
             </div>
             
             <div class="section">
                <?php if(isset($msg)){
                    echo $msg;
                }
                ?>
                <h3>記事の編集</h3>
                 <div class="edit_area">
                    <form action="update.php" method="post">
                    <div class="contentSub">
                        <p class="lastUpdate">最終更新日:<?php echo $update_date; ?></p>
                        <div class="postbox">
                            <h4>公開</h4>
                            <div class="inside">
                                <dl class="dlTbl"><dt>公開状態:</dt><dd><label><input type="radio" name="show" value="1" <?php if($showFlg==1) echo 'checked=\"checked\"'; ?>> 表示</span></label><label><input type="radio" name="show" value="2" <?php if($showFlg==2) echo 'checked=\"checked\"'; ?> > 非表示</label></dd>
                                <dt>登録日時:</dt><dd><input type="text" class="datepick" name="create_date" value="<?php echo $create_date; ?>"></dd>
                                </dl>
                            </div>
                            <div class="submitbox">
                                <a href="delete.php?id=<?php echo $id; ?>" class="btnAttend">削除</a><input type="submit" value="更新" name="update" class="clk-btn">
                            </div>
                        </div>
                        <div class="postbox">
                            <h4>カテゴリー</h4>
                            <div class="inside">
                                <select name="category" id="">
                                    <option value="1"><?php echo $cat;?></option>
                                </select>
                            </div>
                        </div>
                        <div class="postbox">
                            <h4>アイキャッチ画像</h4>
                            <div class="inside">
                                <input type="file" accept='image/*' name="img">
                                <!-- <a href="">画像を設定</a> -->
                            </div>
                        </div>
                        
                    <!-- contentSub --></div>
                    <div class="contentMain">
                        <dl>
                            <dt><input type="text" name="title" value="<?php echo $title;?>"></dt>
                            <dd><p>本文</p><textarea name="detail" id="textarea" ><?php echo $detail;?></textarea></dd>
                        </dl>
                        
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    </form>
                 <!-- edit_area --></div>
            <!-- section --></div>
        <!--//main --></div>
<?php
include "footer.php";
?>