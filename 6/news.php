<?php 
$id = $_GET['news_id'];
$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT * FROM news where news_id = $id";
$sqlAll = "SELECT * FROM news";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$stmtAll = $pdo->prepare($sqlAll);
$stmtAll->execute();
$resultsAll = $stmtAll->fetchAll(PDO::FETCH_ASSOC);
foreach($resultsAll as $key => $value){
     $arr_news[] = $value['news_id'];
}
function linkCheck($id) {
    global $arr_news;
    return in_array($id,$arr_news);
}
$pdo = null;
function linkMake($id) {
    return "news.php?news_id=" . $id;
}

include "header.php";
?>
    
    <section class="news contents-box">
    <?php foreach($results as $key => $value){ ?>
        <h2 class="section-title text-center">
            <span class="section-title__yellow">News</span>

            <span class="section-title-ja text-center"><?php echo date('Y年n月j日', strtotime($value["create_date"]));
                    ?></span>
        </h2>
        <article class="news-detail">
            <dl class="clearfix">
                <dd class="news-title"><?php echo $value["news_title"];?></dd>
                <dd><?php echo $value["news_detail"];?></dd>
            </dl>
            
        </article>
         <?php 
                } 
            ?>
        <div class="pager">
            <?php if(linkCheck($id-1)){ ?>
                <a href="<?php echo linkMake($id-1);?>" class="prev">&laquo; 前の記事へ</a>
             <?php   } ?>
            <?php if(linkCheck($id+1)){ ?>
            <a href="<?php echo linkMake($id+1);?>" class="next">次の記事へ &raquo;</a>
              <?php   } ?>
        </div>
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