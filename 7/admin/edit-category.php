<?php
include "session.php";
require "config.php";
include "function.php";

$sqlFrom = "category";
    

if(count($_POST) > 0){
    //変更した場合
    $id = $_POST["id"];
    $catTitle = htmlspecialchars($_POST["catTitle"], ENT_QUOTES, 'UTF-8');
    $catSlug = htmlspecialchars($_POST["catSlug"], ENT_QUOTES, 'UTF-8');
    $catDesc = htmlspecialchars($_POST["catDesc"], ENT_QUOTES, 'UTF-8');
    // $imgurl; //画像のパス
    // $sql = "INSERT INTO ". $sqlFrom ." (cat_id, cat_name, cat_slug, cat_description) VALUES (NULL, '" . $catTitle . "', '" . $catSlug . "', '" . $catDesc . "') ";
    $sql = "UPDATE ". $sqlFrom ." set cat_name = '" . $catTitle . "', cat_slug = '" . $catSlug . "', cat_description = '" . $catDesc . "' WHERE cat_id = " . $id;
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute();
    
    header("Location: edit-category.php?id=".$id."&result=".$result);
}else{
    $id = $_GET["id"];
    $catId;
    $catTitle; //タイトル
    $catSlug; //スラッグ
    $catDesc; //説明
    // include "dbcategory.php";
    $sqlWHERE = "  WHERE cat_id = :id";
    $bindArray = array(array('bind' => ':id', 'value' => $id, 'param' => PDO::PARAM_STR));
    $results = sqlRequest("*",$sqlFrom,$sqlWHERE,null,$bindArray);
    foreach($results as $row) {
        $catTitle = $row["cat_name"]; 
        $catSlug = $row["cat_slug"]; 
        $catDesc = nl2br(htmlspecialchars_decode($row["cat_description"]));
    }    
}
if(isset($_GET["result"])) {
    if($_GET["result"] == 1) {
        $msg = '<p class="msg msg-success">カテゴリーを変更しました！<a href="" class="fadeOut">非表示</a></p>';
    } else {
        $msg = '<p class="msg msg-failed">カテゴリーを変更に失敗しました！<a href="" class="fadeOut">非表示</a></p>';
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
                <h3>カテゴリーの編集</h3>
                <form action="edit-category.php" method="post" class="edit-category">
                <div class="categoryArea">
                    <div class="addCategory">
                        <h4>新規カテゴリーを追加</h4>
                        <form action="" method="post">
                        <dl>
                            <dt>名前</dt>
                            <dd><input type="text" name="catTitle" value="<?php echo $catTitle; ?>"></dd>
                            <dt>スラッグ</dt>
                            <dd><input type="text" name="catSlug" value="<?php echo $catSlug; ?>"></dd>
                            <!-- <dt>親</dt>
                            <dd></dd> -->
                            <dt>説明</dt>
                            <dd><textarea name="catDesc" id="" rows="5"><?php echo $catDesc; ?></textarea></dd>
                        </dl>
                        <input type="hidden" name="id" value="<?php echo $id;?>">

                        <input type="submit" value="変更を保存" class="clk-btn">
                        </form>
                    <!-- addCategory --></div>
                    
                </div>
                </form>
            <!-- section --></div>
        <!--//main --></div>
<?php
include "footer.php";
?>