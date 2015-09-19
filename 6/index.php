<?php 

$pdo = new PDO("mysql:host=localhost;dbname=cs_academy;charset=utf8", "root", "");
$sql = "SELECT * FROM news WHERE show_flg = 1 ORDER BY news_id DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
$cat = "SELECT * FROM category";
$catstmt = $pdo->prepare($cat);
$catstmt->execute();
$catresults = $catstmt->fetchAll(PDO::FETCH_ASSOC);

$pdo = null;
// 文字を指定した数にカット
function letter($key,$num) {
    if(mb_strlen($key) > $num){
      $key = mb_substr($key,0,$num) . "...";
    }
    return $key;
}
function getCat($num) {
    global $catresults;
    return $catresults[$num-1]["cat_slug"];
}

include "header.php";
?>
<div id="mainVisual">
    <div class="catchCopy">
        <h2>セカイを震わすチーズを創ろう。</h2>
        <p>新しい形のチーズ職人養成学校、はじまります。</p>
    </div>
</div>
<div id="contents">
    <section class="newsArea">
        <h3>NEWS<br><span>お知らせ・更新情報</span></h3>
        <div class="newsContent">
            <dl>
            <?php 
                foreach($results as $key => $value){
                    ?>
                    <dt>
                    <?php echo date('Y年n月j日', strtotime($value["create_date"]));
                    ?>
                    <span class="tagCat">
                    <?php echo getCat($value["news_cat"]); ?></span>
                    </dt>
                    <dd>
                        <a href="news.php?news_id=<?php echo $value["news_id"]?>"><?php echo letter($value["news_title"],10);?></a>
                    </dd>
            <?php 
                } 
            ?>
            </dl>
            <p class="more"><a href="newsList.php">ニュース一覧を見る</a></p>
        </div>
    </section>
    <section class="featureArea">
        <h3>FEATURE<br><span>特徴</span></h3>
        <div class="featureContent">
            <ul>
                <li><figure><img src="images/point1.png" alt="一流職人によるチーズ作り指導"></figure></li>
                <li><figure><img src="images/point2.png" alt="960万円までの創業支援出資"></figure></li>
                <li><figure><img src="images/point3.png" alt="初心者歓迎授業料後払い"></figure></li>
            </ul>
        </div>
    </section>
    <section class="imageArea">
    </section>
    <section class="courseArea">
        <h3>COURCE<br><span>コース紹介</span></h3>
        <div class="courseContent">
            <dl class="lab">
                <dt><img src="images/cource-lab.png" alt="LABコース"></dt>
                <dd><h4>LABコース</h4>週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。</dd>
            </dl>
            <dl class="academy">
                <dt><img src="images/cource-academy.png" alt="ACADEMYコース"></dt>
                <dd><h4>ACADEMYコース</h4>
                週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。週末集中型の初心者対象のチーズ職人養成講座です。</dd>
            </dl>
        </div>
    </section>
    <section class="galleryArea">
        <h3>GALLERY<span>ギャラリー</span></h3>
        <div class="galleryContent">
            <ul>
                <li class="gly01"><a href="images/gallery01_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery01_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly02"><a href="images/gallery02_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery02_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly03"><a href="images/gallery03_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery03_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly04"><a href="images/gallery04_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery04_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly05"><a href="images/gallery05_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery05_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly06"><a href="images/gallery06_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery06_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly07"><a href="images/gallery07_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery07_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly08"><a href="images/gallery08_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery08_big.jpg" alt="ギャラリー"></a></li>
                <li class="gly09"><a href="images/gallery01_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery09.jpg" alt="ギャラリー"></a></li>
                <li class="gly10"><a href="images/gallery02_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery10.jpg" alt="ギャラリー"></a></li>
                <li class="gly11"><a href="images/gallery03_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery11.jpg" alt="ギャラリー"></a></li>
                <li class="gly12"><a href="images/gallery04_big.jpg" class="strip" data-strip-group="cheese"><img src="images/gallery12.jpg" alt="ギャラリー"></a></li>
            </ul>
        </div>
    </section>
    <section class="imageArea pattern02">
    </section>
    <section class="contactArea">
        <h3>ENTRY<span>説明会に申し込む</span></h3>
        <div class="contactContent">
            <form action="">
            <dl>
                <dt>氏名</dt>
                <dd><input type="text" name="name"></dd>
                <dt>フリガナ</dt>
                <dd><input type="text" name="kana"></dd>
                <dt>メールアドレス</dt>
                <dd><input type="text" name="mail"></dd>
                <dt>説明会時の希望日時</dt>
                <dd><select name="day" id="">
                        <option value="">選択して下さい</option>
                        <option value="">7/19 19:00〜</option>
                        <option value="">7/26 19:00〜</option>
                    </select>
                </dd>
                <dt>志望動機</dt>
                <dd>
                    <ul>
                        <li><label><input type="radio" name="reason" id="">起業をしたい</label></li>
                        <li><label><input type="radio" name="reason" id="">チーズ系企業に就職したい。</label></li>
                        <li><label><input type="radio" name="reason" id="">チーズと関わる仕事なので、知識をつけたい。</label></li>
                        <li><label><input type="radio" name="reason" id="">教養として身につけたい</label></li>
                    </ul>
                </dd>
            </dl>
            <p class="btnEntry"><input type="image" src="images/btn-entry.png" value="説明会に申し込む"></p>
            </form>
        </div>
    </section>
    <section class="infoArea">
        <h3>INFORMATION<span>基本情報</span></h3>
        <div class="infoContent">
            <ul>
                <li class="img"><img src="images/kunsei_cheese.png" alt="チーズ"></li>
                <li><div id="gMap"></div></li>
                <li class="img"><img src="images/kunsei_cheese.png" alt="チーズ"></li>
            </ul>
            <p>※実際にはチーズアカデミーという学校は存在しません。<br>くれぐれも間違ってデジタルハリウッドにお問い合わせすることのないようにご注意ください。</p>   
        </div>
    </section>
<!--//contents --></div>
<?php 
include "footer.php";
?>