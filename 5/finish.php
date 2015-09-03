<?php 
require "function.php";
require_once "header.php";

?>
<?php 
// if (isset($_POST["name"])) 
if (count($_POST) > 0) {
$body = "";
if($_POST['name']==""){
    $errMsg .= "<li>お名前が空欄です。</li>";
  }else{
    $body .= "名前：".htmlspecialchars(post('name'))."\n\n";
  }
  
  if($_POST['mail']==""){

  }else{
    $body .= "E-mail：".htmlspecialchars(post('mail'))."\n\n";
  }
  if($_POST['age']==""){
  }else{
    $body .= "年齢：".htmlspecialchars(post('age'))."\n\n";
  }
  if($_POST['sex']==""){

  }else{
    $body .= "性別：".htmlspecialchars(post('sex'))."\n\n";
  }
  if($_POST['address']==""){
      $body .= "住所：無記入\n\n";
  }else{
    $body .= "住所：".htmlspecialchars(post('address'))."\n\n";
  }
  $body .= "趣味：\n";
  $checkArr = array();
	$num = 9;
	for ($i = 1; $i <= $num; $i++){
	  // 実行する処理
		if(post("hob".$i."") != ""){
			$checkArr[] = post("hob".$i."");
		}
		
	}
	$total = count($checkArr);
	foreach ($checkArr as $key => $value) {
		// var_dump($checkArr);
		if($key < $total - 1){
	  		$body .= htmlspecialchars($value.",");
		}else {
			$body .= htmlspecialchars($value);
		}
	  
	}

  if(strlen($_POST['free']) > 10000){
      $errMsg .= "<li>コメント欄は10000字以内で記入してください。</li>";
    }else{
      $body .= "自由記入欄：\n".htmlspecialchars(post('free'))."\n";
    }
    
   var_dump($body);

  $title_01 = "お問い合わせありがとうございます";
  $title_02 = "お問い合わせ完了";
  $mail_to = "abe@sterfield.co.jp";

  mb_language('Japanese');
  mb_internal_encoding("UTF-8");
  // mb_send_mail($_POST['mail'], mb_convert_encoding($title_02, "UTF-8", "auto"), mb_convert_encoding($body, "UTF-8", "auto"),'From:'.$mail_to);
  // mb_send_mail($mail_to, mb_convert_encoding($title_01, "UTF-8", "auto"), mb_convert_encoding($body, "UTF-8", "auto"),'From:'.$_POST['mail']);



	?>
	<p class="lead">お問い合わせありがとうございます！</p>
	
			
<?php } else { ?>
	アクセス不可です。
<?php } ?>		
<?php 
require_once "footer.php";
?>
