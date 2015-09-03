
$(function(){
	// setLayout();
	inputCheck();
	$(document).on('click', '.goSearch', function(event) {
		event.preventDefault();
		atMove(".searchArea");
	});
	// 下部ナビボタンを押した時
	$(document).on('click', '.navi li', function(event) {
		var toMove = $(this).attr("class");
		if(toMove == "home"){
			toMove = "start";
		}else if(toMove == "history"){
			toMove = "searchArea";
		}else{
			toMove = "shopListArea";
			shopList();
		}
		atMove("." + toMove);
		if(toMove == "searchArea"){
			$(".place input").focus();
		}
		
	});
	// ラジオボタンをチェック
	$(document).on('change', '.cst input[type=radio]', function(event) {
		var c = $(this).attr("name");
		$("input[name="+ c +"]").next("i").removeClass('on');
		$(this).next("i").addClass('on');
		
	});

	// チェックボックスをチェック
	$(document).on('change','.cst input[type=checkbox]', function(event) {
		
		if($(this).prop("checked")){
			$(this).next("i").addClass('on');
		}else{
			$(this).next("i").removeClass('on');
		}
	});

	// セレクト
	$(".customSelect select").change(function() {
	    $(this).next().html($("option:selected", this).text());
	  }).trigger("change");

	$(document).on('change','.place input', function(event) {
		if($(this).val() == ""){
			$(this).val("現在地から探す");
		}else{
		}
	});
	
	$(document).on('focus', 'dd input', function(event) {
		if($(this).closest('dd').find(".error").css("display") == "block"){
			$(this).closest('dd').find(".error").fadeOut('normal');
		}else{
		}
		/* Act on the event */
	});
	$(document).on('blur', 'dd input[type=text]', function(event) {
		if($(this).val() == ""){
			$(this).closest('dd').find(".error").fadeIn('normal');
		}
		// $(".findList").slideUp('fast');
		/* Act on the event */
	});
	$(document).on('click', '.back', function(event) {
		event.preventDefault();
		$("form").attr({
			action: 'index.php',
		});
		$("form").submit();
		/* Act on the event */
	});
	$("form").submit(function() {
		var error = false;
		$(".req").each(function(index, el) {
			var req = $(this).next().find("input").attr("type");
			if( req == "text") {
				if($(this).next().find("input").val() == "") {

		    		$(this).next().find(".error").fadeIn('normal');
			    	error = true;
				}
			}else if(req == "radio" || req == "checkbox"){
				var checkerr = true;
				$(this).next().find("input").each(function() {
					if($(this).prop("checked")) {

						checkerr = false;
					}
					
				});
				if(checkerr){
					$(this).next().find(".error").fadeIn('normal');
					error = true;
				}
			}
			

		});
		if(error){
			return false;
		}
		
	});
	
	
});


// 以下関数
function inputCheck(){
	$(".cst input:checked").next("i").addClass('on');
}

function setLayout(){
	var w = $(window).width();
	var h = $(window).height();
	var headHei = $("header").outerHeight();
	var footHei = $("footer").outerHeight();
	$("main").css("height",h-headHei-footHei)
}
// 日本緯度経度　→　海外緯度経度
function geo_japan2world(lat,lng){
	var la = lat;
	var ln = lng;
	lat = la - la * 0.00010695 + ln * 0.000017464 + 0.0046017;
	lng = ln - la * 0.000046038 - ln * 0.000083043 + 0.010040;
	return [lat,lng];
}
function attendPop(text){
    $(".attend").text(text);
    if(text == "DELETE" ){
      $(".attend").addClass('delete');
    }
    $(".attend").slideDown(500, function() {
      $(this).delay(1000).slideUp("normal", function() {
        $(this).removeClass('delete')
      });

    });
  }
//文字列の改行コードを<br>に
function nl2br(str) {
    return str.replace(/[\n\r]/g, "<br>");
}
//文字列の<br>を改行コードに
function br2nl(str) {
    return str.replace(/<br>/g, "\n");
}