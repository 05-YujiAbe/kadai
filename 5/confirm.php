<?php 
require "function.php";
require_once "header.php";

?>
<?php 
// if (isset($_POST["name"])) 
if (count($_POST) > 0) 
	
	{?>

	<form action="finish.php" method="post">
		<dl>
		
			<dt>名前</dt>
			<dd><?php echo post('name'); ?><input type="hidden" name="name" value="<?php echo post('name'); ?>">
			</dd>
			<dt>E-mail</dt>
			<dd><?php echo post('mail'); ?><input type="hidden" name="mail" value="<?php echo post('mail'); ?>">
			</dd>
			<dt>年齢</dt>
			<dd><?php echo post('age'); ?><input type="hidden" name="age" value="<?php echo post('age'); ?>"></dd>
			<dt>性別</dt>
			<dd>
			<?php echo post('sex'); ?>
			<input type="hidden" name="sex" value="<?php echo post('sex'); ?>">
			</dd>
			<dt>住まい</dt>
			<dd>
				<?php echo post('address'); ?>
				<input type="hidden" name="address" value="<?php echo post('address'); ?>">
			</dd>
			<dt>趣味</dt>
			<dd>
				<input type="hidden" name="hob1" value="<?php echo post('hob1'); ?>">
				<input type="hidden" name="hob2" value="<?php echo post('hob2'); ?>">
				<input type="hidden" name="hob3" value="<?php echo post('hob3'); ?>">
				<input type="hidden" name="hob4" value="<?php echo post('hob4'); ?>">
				<input type="hidden" name="hob5" value="<?php echo post('hob5'); ?>">
				<input type="hidden" name="hob6" value="<?php echo post('hob6'); ?>">
				<input type="hidden" name="hob7" value="<?php echo post('hob7'); ?>">
				<input type="hidden" name="hob8" value="<?php echo post('hob8'); ?>">
				<input type="hidden" name="hob9" value="<?php echo post('hob9'); ?>">
				<?php
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
					  		echo $value.",";
						}else {
							echo $value;
						}
					  
					}


				?>
				
			</dd>
			<dt>自由記入欄</dt>
			<dd>
				<?php echo post('free'); ?><input type="hidden" name="free" value="<?php echo post('free'); ?>">
			</dd>

	
	
		</dl>
		<p class="submit"><input type="submit" value="送信する"><input type="submit" value="修正する" class="back"></p>
		</form>
<?php } else { ?>
	アクセス不可です。
<?php } ?>		
<?php 
require_once "footer.php";
?>
