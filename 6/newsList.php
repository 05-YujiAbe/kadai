<?php 

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");

if(isset($_GET["cat"]) && $_GET["cat"] != ""){
    $cat_id = $_GET['cat'];
    $sql = "SELECT * FROM news where news_cat = $cat_id ORDER BY news_id DESC LIMIT 10";
    $cat = "SELECT * FROM category where cat_id = $cat_id";

}else{

    $sql = "SELECT * FROM news ORDER BY news_id DESC LIMIT 10";
    $cat = "SELECT * FROM category";
}

$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$catstmt = $pdo->prepare($cat);
$catstmt->execute();
$catresults = $catstmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;
function linkMake($id) {
    return "news.php?news_id=" . $id;
}
function getCat($num) {
    global $catresults;
    return $catresults[$num-1]["cat_slug"];
}

include "header.php";
?>
    
    <section class="news contents-box">
    
        <h2 class="section-title text-center">
            <span class="section-title__yellow">News</span>
            <form action="newsList.php" method="get" class="catChange">
            <div class="customSelect">
            <select name="cat" id="catSelect">
                <option value="">ALL</option>
                <option value="1">コラム</option>
                <option value="2">ブログ</option>
            </select>
            <div class="selectBox"></div>

            </div>
            <input type="submit" value="変更">
            </form>
            <?php if(isset($_GET["cat"]) && $_GET["cat"] != ""){ ?>
            <span class="section-title-ja text-center"><?php echo $catresults[0]["cat_name"]; ?></span>
            <?php } ?>
        </h2>
        <ul class="news-list">
        <?php foreach($results as $key => $value){ ?>
        <li><a href='<?php echo linkMake($value["news_id"]);?>'>
            <dl class="clearfix">
                <dt><img src="admin/files/<?php echo $value["news_url"];?>" alt=""></dt>
                <dd class="sub"><span class="date"><?php echo date('Y.n.j.', strtotime($value["create_date"]));
                    ?></span>
                    <span class="cat">
                    <?php if(isset($_GET["cat"])){ 
                        echo $catresults[0]["cat_slug"];
                     }else{
                        echo getCat($value["news_cat"]); 
                     }
                     ?>
                

                    </span>
                </dd>
                <dd><?php echo $value["news_title"];?></dd>
            </dl>
            </a>
        </li>
         <?php 
                } 
            ?>
        </ul>
    </section>

    <!--#information-->
    <footer class="footer contents-box">
    <h2 class="section-title text-center"><span class="section-title__white">Information</span><span class="section-title-ja section-title__white text-center">基本情報</span></h2>

        <div class="inner">
            <ul class="list-footer clearfix">
                <li class="text-center"><img src="images/kunsei_cheese.png" alt="space_image" width="175" height="127"></li>
                <li class="maps"><iframe width="300" height="222" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1620.879730972407!2d139.70531929996108!3d35.65829752117608!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0000000000000000%3A0xff3d912f43a54715!2z5riL6LC344Kv44Ot44K544K_44Ov44O8!5e0!3m2!1sja!2sjp!4v1437965881707" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe></li>
                <li class="text-center"><img src="images/kunsei_cheese.png" alt="space_image" width="175" height="127"></li>
            </ul>
        <p class="footer-caution">※実際にはチーズアカデミーという学校は存在しません。<br />
くれぐれも間違ってデジタルハリウッドにお問い合わせすることのないようにご注意ください。</p>
        </div>
    </section>
    <!--end #information-->
<?php 
include "footer.php";
?>