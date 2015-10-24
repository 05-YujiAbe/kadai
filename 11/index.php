<?php 
include "config.php";
include "header.php";
$catUri = "http://api.gnavi.co.jp/master/CategoryLargeSearchAPI/20150630/";
$catUrl  = sprintf("%s%s%s%s%s", $catUri, "?format=", $format, "&keyid=", $key_id);
// URL読み込み
$json_data = file_get_contents($catUrl, true);
// jsonをphpで扱いやすいように変更
$data = json_decode($json_data);
?>
<script>
	var data = <?php echo json_encode($data, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
	gurunaviCat(data.category_l);
	//gurunaviDisplay();
	//console.log(array["lat"],array["lng"]);
	
</script>
<body>
<div class="loading"><img src="css/loader.gif" alt=""></div>
<div class="attend"></div>
	<header>
		<h1>G's Gourmet</h1>
		<div class="control">
			<span class="cancel">キャンセル</span>
			<span class="search">検索する</span>
		</div>
		<p class="goSearch"><a href=""><i class="fa fa-search"></i>探す</a></p>
	</header>
	<main>
		<div class="start">
			<p><i class="fa fa-cutlery"></i></p>
			現在地もしくは住所を入力すると周囲のお店が検索できるよ！<br>
			<a href="http://www.gnavi.co.jp/">
			<img src="http://apicache.gnavi.co.jp/image/rest/b/api_180_60.gif" width="180" height="60" border="0" alt="グルメ情報検索サイト　ぐるなび">
			</a>
		</div>
		<div class="searchArea">
			<form action="search.php" method="post" class="toSearchArea">
			
			<ul class="findSelect">

				<li class="janre"><input type="text" value="" placeholder="カテゴリーを選択" class="ji" readonly="readonly"><input type="hidden" class="jic" name="janre"></li>
				<li class="place"><input type="text" value="現在地から探す" placeholder="現在地から探す" class="pi" name="place"></li>
			</ul>
			<input type="hidden" value="" name="lat">
			<input type="hidden" value="" name="lng">
			
			<ul class="findList">
			</ul>
			<p class="rangeSelect">距離：<label><input type="radio" name="range" value="1" checked="checked"> 300m以内</label><label><input type="radio" name="range" value="2"> 500m以内</label><label><input type="radio" name="range" value="3"> 1000m以内</label></p>
			<p class="rangeSelect">条件を指定して絞り込む：
				<label><input type="checkbox" name="mobilephone" value="1"> 携帯の電波が入る</label>
				<label><input type="checkbox" name="outret" value="1"> 電源あり</label>
				<label><input type="checkbox" name="wifi" value="1"> wifiあり</label>
				<label><input type="checkbox" name="microphone" value="1"> マイクあり</label>
				<label><input type="checkbox" name="projecter_screen" value="1"> プロジェクター・スクリーンあり</label>
			</p>
			</form>
		</div>
		<div class="shopInfo">
			
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
		</div>
	</main>
	
	
	<footer>
		<ul class="navi">
			<li class="home"><i class="fa fa-search"></i>検索する</li>
			<li class="history"><i class="fa fa-list-ul"></i>検索履歴</li>
			<li class="doneCheck"><i class="fa fa-check"></i>チェックした店</li>
			<li class="favorite"><i class="fa fa-heart-o"></i>お気に入り店</li>
		</ul>
	</footer>

</body>

</html>
