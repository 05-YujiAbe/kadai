<?php 
require "function.php";
require_once "header.php";
?>
<form action="confirm.php" method="post">
		<dl>
<?php 
if (count($_POST) > 0) {?>
			<dt class="req">名前</dt>
			<dd><input type="text" name="name" value="<?php echo post('name'); ?>">
			<p class="error">必須項目です</p>
			</dd>
			<dt class="req">E-mail</dt>
			<dd><input type="text" name="mail" value="<?php echo post('mail'); ?>">
			<p class="error">必須項目です</p>
			</dd>
			<dt>年齢</dt>
			<dd><input type="text" name="age" value="<?php echo post('age'); ?>"></dd>
			<dt class="req">性別</dt>
			<dd><label class="cst"><input type="radio" value="男" name="sex" <?php if(post('sex')=='男') echo 'checked=\"checked\"'; ?> ><i class="radio"></i><span>男</span></label>
			<label class="cst"><input type="radio" value="女" name="sex" <?php if(post('sex')=='女') echo 'checked=\"checked\"'; ?> ><i class="radio"></i> <span>女</span></label>
			<p class="error">選択してください</p>
			</dd>
			<dt>住まい</dt>
			<dd>
			<div class="customSelect">
				<select name="address">
					<option value="<?php post('address')=='' ? '' : print post('address'); ?>" selected="selected"><?php post('address')=='' ? '選択してください' : print post('address'); ?></option>
					<option value="北海道">北海道</option>

					<option value="青森県">青森県</option>
					<option value="岩手県">岩手県</option>
					<option value="宮城県">宮城県</option>
					<option value="秋田県">秋田県</option>
					<option value="山形県">山形県</option>
					<option value="福島県">福島県</option>

					<option value="茨城県">茨城県</option>
					<option value="栃木県">栃木県</option>
					<option value="群馬県">群馬県</option>
					<option value="埼玉県">埼玉県</option>
					<option value="千葉県">千葉県</option>
					<option value="東京都">東京都</option>

					<option value="神奈川県">神奈川県</option>
					<option value="新潟県">新潟県</option>
					<option value="富山県">富山県</option>
					<option value="石川県">石川県</option>
					<option value="福井県">福井県</option>
					<option value="山梨県">山梨県</option>

					<option value="長野県">長野県</option>
					<option value="岐阜県">岐阜県</option>
					<option value="静岡県">静岡県</option>
					<option value="愛知県">愛知県</option>
					<option value="三重県">三重県</option>
					<option value="滋賀県">滋賀県</option>

					<option value="京都府">京都府</option>
					<option value="大阪府">大阪府</option>
					<option value="兵庫県">兵庫県</option>
					<option value="奈良県">奈良県</option>
					<option value="和歌山県">和歌山県</option>
					<option value="鳥取県">鳥取県</option>

					<option value="島根県">島根県</option>
					<option value="岡山県">岡山県</option>
					<option value="広島県">広島県</option>
					<option value="山口県">山口県</option>
					<option value="徳島県">徳島県</option>
					<option value="香川県">香川県</option>

					<option value="愛媛県">愛媛県</option>
					<option value="高知県">高知県</option>
					<option value="福岡県">福岡県</option>
					<option value="佐賀県">佐賀県</option>
					<option value="長崎県">長崎県</option>
					<option value="熊本県">熊本県</option>

					<option value="大分県">大分県</option>
					<option value="宮崎県">宮崎県</option>
					<option value="鹿児島県">鹿児島県</option>
					<option value="沖縄県">沖縄県</option>
				</select>
				<div class="selectBox"></div>
			</div>
				
			</dd>
			<dt class="req">趣味</dt>
			<dd>
				<label class="cst"><input type="checkbox" name="hob1" value="サッカー" <?php if(post('hob1')=='サッカー') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>サッカー</span></label>
				<label class="cst"><input type="checkbox" name="hob2" value="フットサル" <?php if(post('hob2')=='フットサル') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>フットサル</span></label>
				<label class="cst"><input type="checkbox" name="hob3" value="野球" <?php if(post('hob3')=='野球') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>野球</span></label>
				<label class="cst"><input type="checkbox" name="hob4" value="テニス" <?php if(post('hob4')=='テニス') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>テニス</span></label>
				<label class="cst"><input type="checkbox" name="hob5" value="バドミントン" <?php if(post('hob5')=='バドミントン') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>バドミントン</span></label>
				<label class="cst"><input type="checkbox" name="hob6" value="バスケットボール" <?php if(post('hob6')=='バスケットボール') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>バスケットボール</span></label>
				<label class="cst"><input type="checkbox" name="hob7" value="映画鑑賞" <?php if(post('hob7')=='映画鑑賞') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>映画鑑賞</span></label>
				<label class="cst"><input type="checkbox" name="hob8" value="読書" <?php if(post('hob8')=='読書') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>読書</span></label>
				<label class="cst"><input type="checkbox" name="hob9" value="プログラミング" <?php if(post('hob9')=='プログラミング') echo 'checked=\"checked\"'; ?> ><i class="check"></i> <span>プログラミング</span></label>
				<p class="error">選択してください</p>
			</dd>
			<dt>自由記入欄</dt>
			<dd>
				<textarea name="free" cols="30" rows="10"><?php echo post('free'); ?></textarea>
			</dd>
<?php }else{ ?>		
			<dt class="req">名前</dt>
			<dd><input type="text" name="name" value="">
			<p class="error">必須項目です</p>
			</dd>
			<dt class="req">E-mail</dt>
			<dd><input type="text" name="mail" value="">
			<p class="error">必須項目です</p>
			</dd>
			<dt>年齢</dt>
			<dd><input type="text" name="age" value=""></dd>
			<dt class="req">性別</dt>
			<dd><label class="cst"><input type="radio" value="男" name="sex"><i class="radio"></i><span>男</span></label>
			<label class="cst"><input type="radio" value="女" name="sex"><i class="radio"></i> <span>女</span></label>
			<p class="error">選択してください</p>
			</dd>
			<dt>住まい</dt>
			<dd>
			<div class="customSelect">
				<select name="address">
					<option value="" selected="selected">選択して下さい</option>
					<option value="北海道">北海道</option>

					<option value="青森県">青森県</option>
					<option value="岩手県">岩手県</option>
					<option value="宮城県">宮城県</option>
					<option value="秋田県">秋田県</option>
					<option value="山形県">山形県</option>
					<option value="福島県">福島県</option>

					<option value="茨城県">茨城県</option>
					<option value="栃木県">栃木県</option>
					<option value="群馬県">群馬県</option>
					<option value="埼玉県">埼玉県</option>
					<option value="千葉県">千葉県</option>
					<option value="東京都">東京都</option>

					<option value="神奈川県">神奈川県</option>
					<option value="新潟県">新潟県</option>
					<option value="富山県">富山県</option>
					<option value="石川県">石川県</option>
					<option value="福井県">福井県</option>
					<option value="山梨県">山梨県</option>

					<option value="長野県">長野県</option>
					<option value="岐阜県">岐阜県</option>
					<option value="静岡県">静岡県</option>
					<option value="愛知県">愛知県</option>
					<option value="三重県">三重県</option>
					<option value="滋賀県">滋賀県</option>

					<option value="京都府">京都府</option>
					<option value="大阪府">大阪府</option>
					<option value="兵庫県">兵庫県</option>
					<option value="奈良県">奈良県</option>
					<option value="和歌山県">和歌山県</option>
					<option value="鳥取県">鳥取県</option>

					<option value="島根県">島根県</option>
					<option value="岡山県">岡山県</option>
					<option value="広島県">広島県</option>
					<option value="山口県">山口県</option>
					<option value="徳島県">徳島県</option>
					<option value="香川県">香川県</option>

					<option value="愛媛県">愛媛県</option>
					<option value="高知県">高知県</option>
					<option value="福岡県">福岡県</option>
					<option value="佐賀県">佐賀県</option>
					<option value="長崎県">長崎県</option>
					<option value="熊本県">熊本県</option>

					<option value="大分県">大分県</option>
					<option value="宮崎県">宮崎県</option>
					<option value="鹿児島県">鹿児島県</option>
					<option value="沖縄県">沖縄県</option>
				</select>
				<div class="selectBox"></div>
			</div>
				
			</dd>
			<dt class="req">趣味</dt>
			<dd>
				<label class="cst"><input type="checkbox" name="hob1" value="サッカー"><i class="check"></i> <span>サッカー</span></label>
				<label class="cst"><input type="checkbox" name="hob2" value="フットサル"><i class="check"></i> <span>フットサル</span></label>
				<label class="cst"><input type="checkbox" name="hob3" value="野球"><i class="check"></i> <span>野球</span></label>
				<label class="cst"><input type="checkbox" name="hob4" value="テニス"><i class="check"></i> <span>テニス</span></label>
				<label class="cst"><input type="checkbox" name="hob5" value="バドミントン"><i class="check"></i> <span>バドミントン</span></label>
				<label class="cst"><input type="checkbox" name="hob6" value="バスケットボール"><i class="check"></i> <span>バスケットボール</span></label>
				<label class="cst"><input type="checkbox" name="hob7" value="映画鑑賞"><i class="check"></i> <span>映画鑑賞</span></label>
				<label class="cst"><input type="checkbox" name="hob8" value="読書"><i class="check"></i> <span>読書</span></label>
				<label class="cst"><input type="checkbox" name="hob9" value="プログラミング"><i class="check"></i> <span>プログラミング</span></label>
				<p class="error">選択してください</p>
			</dd>
			<dt>自由記入欄</dt>
			<dd>
				<textarea name="free" cols="30" rows="10"></textarea>
			</dd>

	
	
		
		<?php } ?>
		</dl>
		<p class="submit"><input type="submit" value="確認する"></p>
		</form>
<?php 
require_once "footer.php";
?>
