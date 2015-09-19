<?php
include "session.php";


if(count($_POST) > 0){
    //送信した場合
    $pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
    
    $title = htmlspecialchars($_POST["title"], ENT_QUOTES, 'UTF-8');
    $detail = htmlspecialchars($_POST["detail"], ENT_QUOTES, 'UTF-8');
    // $imgurl; //画像のパス
    $cat = $_POST["category"]; //カテゴリー
    $showFlg = $_POST["show"]; //表示非表示
    // $create_date = $_POST["create_date"]; //登録日
    $sql = "INSERT INTO news (news_id, news_title, news_detail, show_flg, news_cat, create_date, update_date) VALUES (NULL, '" . $title . "', '" . $detail . "', " . $showFlg . ", " . $cat . ", sysdate(), sysdate()) ";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    $pdo = null;
    //一覧へ
    header("Location: index.php");
    // そのまま編集画面へ
    // header("Location: update.php?id=".$id."&result=".$result);
}


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
                    
                </div>
             </div>
             
             <div class="section">
                
                <h3>新規記事の追加</h3>
                 <div class="edit_area">
                    <form action="input.php" method="post">
                    <div class="contentSub">
                        <div class="postbox">
                            <h4>下書き</h4>
                            <div class="inside">
                                <dl class="dlTbl"><dt>公開状態:</dt><dd><label><input type="radio" name="show" value="1" checked="checked"> 表示</span></label><label><input type="radio" name="show" value="2" > 非表示</label></dd>
                                <dt>登録日時:</dt><dd><input type="text" class="datepick" name="create_date"></dd>
                                </dl>
                            </div>
                            <div class="submitbox">
                                <input type="submit" value="公開" name="update" class="clk-btn">
                            </div>
                        </div>
                        <div class="postbox">
                            <h4>カテゴリー</h4>
                            <div class="inside">
                                <select name="category" id="">
                                    <option value="1">1</option>
                                    <option value="1">2</option>
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
                            <dt><input type="text" name="title" placeholder="ここにタイトルを入力"></dt>
                            <dd><p>本文</p><textarea name="detail" id="textarea" ></textarea></dd>
                        </dl>
                        
                    </div>
                    </form>
                 <!-- edit_area --></div>
            <!-- section --></div>
        <!--//main --></div>
<?php
include "footer.php";
?>