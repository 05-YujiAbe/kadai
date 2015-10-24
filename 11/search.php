<?php 
include "config.php";
$janre = $_POST["janre"];
$place = $_POST["place"];

$uri = "http://api.gnavi.co.jp/RestSearchAPI/20150630/";

$lat = $_POST["lat"];
$lon = $_POST["lng"];
$range = $_POST["range"];
$perpage = 100;
$cat = $_POST["janre"];
$mobilephone = (isset($_POST["mobilephone"])) ? $_POST["mobilephone"] : 0;
$outret = (isset($_POST["outret"])) ? $_POST["outret"] : 0;
$wifi = (isset($_POST["wifi"])) ? $_POST["wifi"] : 0;
$microphone = (isset($_POST["microphone"])) ? $_POST["microphone"] : 0;
$projecter_screen = (isset($_POST["projecter_screen"])) ? $_POST["projecter_screen"] : 0;
$array = array('janre' => $janre ,'place' => $place,'lat' => $lat ,'lng' => $lon );
$url  = sprintf("%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s", $uri, "?format=", $format, "&keyid=", $key_id, "&latitude=", $lat,"&longitude=", $lon ,"&range=" , $range, "&hit_per_page=", $perpage, "&category_l=", $cat, "&mobilephone=", $mobilephone, "&outret=", $outret, "&wifi=", $wifi, "&microphone=", $microphone, "&projecter_screen=", $projecter_screen);
// URL読み込み
$json_data = file_get_contents($url, true);

// jsonをphpで扱いやすいように変更
$data = json_decode($json_data);
include "header.php";
?>
<script>
	var array = <?php echo json_encode($array, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	var data = <?php echo json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	//var url = <?php echo json_encode($url, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	
	geoOn(array["lat"],array["lng"],data.rest);
	//gurunaviDisplay();
	
</script>
<body>


<div class="attend"></div>
	<header>
		<h1>G's Gourmet</h1>
		<div class="control dpb">
			<a href="index.php"><span>検索画面に戻る</span></a>
			<!-- <span>検索数</span> -->
		</div>
		<!-- <p class="goSearch"><a href=""><i class="fa fa-search"></i>探す</a></p> -->
	</header>
	<main>
		
		<div class="resultArea">
			<div id="gmap"></div>
		</div>
		<!-- <div class="shopInfo">
			
		</div>
		
		<div class="shopListArea">
			<ul>
				<li><a href="">
					<strong>お店の名前</strong>
					<span>東京都</span>
				</a>
				<span class="delete">
				<i class="fa fa-times"></i></span>
				</li>
			</ul>
		</div> -->
	</main>
	
	
	<!-- <footer>
		<ul class="navi">
			<li class="home"><i class="fa fa-search"></i>検索する</li>
			<li class="history"><i class="fa fa-list-ul"></i>検索履歴</li>
			<li class="doneCheck"><i class="fa fa-check"></i>チェックした店</li>
			<li class="favorite"><i class="fa fa-heart-o"></i>お気に入り店</li>
		</ul>
	</footer> -->

</body>

</html>
