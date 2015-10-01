<?php
	//文字数カットする
	//例: letter(test,100) → 100文字を表示する
	function letter($key,$num) {
	    if(mb_strlen($key) > $num){
	      $key = mb_substr($key,0,$num) . "...";
	    }
	    return $key;
	}
	//記事を取得
	// $pdoの記述はconfig.phpに
	// $bindArray,$sqlPerPageの初期値はconfig.phpに
	function sqlRequest($select,$from,$where = null,$perpage = null,$bindArray = null){
		global $pdo;
		$sql = "SELECT ". $select ." FROM ". $from ." ".$where.$perpage;
		$stmt = $pdo->prepare($sql);
		if (isset($bindArray)) {
			foreach($bindArray as $bind) {
				$stmt->bindValue($bind['bind'], $bind['value'], $bind['param']);
			}
		}
		$stmt->execute();
		//count(*)記事総数を取得する場合（ページングに必要）
		if($select == "count(*)"){
			$results = $stmt->fetchColumn();
		}else{
			$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
		
		return $results;
	}
	//ページャ生成
	//PER_PAGEと$pageはconfig.phpに記載
	//$controlがtrueの場合は、前へ、次へを表示
	function pagerMake($total,$control = false){
		global $page;
		$totalPages = ceil($total / PER_PAGE);
		$pageLink = "";
		$pager = '<div class="pager"><ul>';
		// ページャ以外のGETをリンクに
		if (isset($_GET)) {
			foreach ($_GET as $key => $value) {
				if($key == "page"){
					continue;
				}
				$pageLink .= "&".$key."=".$value;
			}
		}
		if($control){
			if($page != 1){
			    $prev = $page-1;
			    $pager .= "<li class='first'><a href='?page=".$prev.$pageLink."'>&laquo; 前へ</a></li>";
			}
		}
		for ($i=1; $i <= $totalPages; $i++) {
			if($page == $i){
				$pager .= "<li><span>".$i."</span></li>";
			}else{
				$pager .= "<li><a href='?page=".$i.$pageLink."'>".$i."</a></li>";
			}
			
		}
		if($control){
			if($page != $totalPages){
			    $next = $page+1;
			    $pager .= "<li class='bext'><a href='?page=".$next.$pageLink."'>次へ &raquo;</a></li>";
			}
		}
		$pager .= '</ul></div>';
		return $pager;
	}
	// function getCategoryAll(){
	// 	$catsql = "SELECT * FROM category";
	//     $catstmt = $pdo->prepare($catsql);
	//     $catstmt->execute();
	//     $catArray = $catstmt->fetchAll(PDO::FETCH_ASSOC);
	//     return $catArray;
	// }
	function hs($char){
		$content = htmlspecialchars($char, ENT_QUOTES, 'UTF-8');
		return $content;
	}
?>