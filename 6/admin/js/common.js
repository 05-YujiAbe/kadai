$(function(){
  $(window).resize(function(event) {
    setLayout();
  });
  $('form').each(function(){
  		$(this).attr('novalidate', 'novalidate');
  });
	
	$(".search_btn").click(function(){
		$(".search_area").slideToggle("fast");
	});

     //すべてのチェックボタンを選択
     $(".head input").click(function() {
		 if(this.checked){
    		$(".list .check").attr('checked','checked');
    		}else{
    		$(".list .check").removeAttr('checked');
		}
	 });
	 
	 //すべて選択する
	 $(".all_check input").click(function(){
		if(this.checked){
    		$(".area_check input").attr('checked','checked');
    		}else{
    		$(".area_check input").removeAttr('checked');
		}
	});
   $(document).on('click', '.fadeOut', function(event) {
     event.preventDefault();
     $(this).parent("p").fadeOut('slow', function() {
       $(this).remove();
     });
     /* Act on the event */
   });

	//保存しましたのフェードアウト
	 $(".success").delay(2000).fadeOut("slow");

  //デートピッカー
  $(document).on("focus", ".datepick", function () {
      $(".datepick").datepicker({
        dateFormat: "yy-mm-dd"
      });
  });

   //文字カウント
    var limit;
    var warning = 0;
    var count;
    var textnum = 0;
	$('input.countup').each(function(){
		textnum = $(this).attr('maxlength') - $(this).val().length;
		$(this).after('<span>'+ textnum +'</span>');
	});
  
    $('input.countup').focus(function(){
      limit = $(this).attr('maxlength');
    });
    $('input.countup').keyup(function() {
      var countText = $(this).next('span');
      count = (limit - $(this).val().length);
      $(this).next('span').text(count);
      if (count < warning) {
        countText.css('color', 'red');
      } else {
        countText.css('color', '#363636');
      }
    });
    $(".fileUp input").click(function() {
      $(this).on('change', function(event) {
        file = event.target.files[0];
        var imgA = new FileReader();
        imgA.onload = function(e){
          e.target.result;
        };
        imgA.readAsDataURL(file);

      });
    });
    setLayout();
    if($(".login").size() > 0){
      loginCheck();
    }

    
});
function loginCheck() {
  $("form").submit(function() {
    var error = false;
    $(".req").each(function(index, el) {
      var req = $(this).attr("type");
      if( req == "text" || req == "password") {
        if($(this).val() == "") {

            $(this).parent("p").prev(".error").fadeIn('normal');
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
          $(this).parent("p").next(".error").fadeIn('normal');
          error = true;
        }
      }
      

    });
    if(error){
      return false;
    }
    
  });
}
function setLayout(){
  var w = $(window).width();
  var h = $(window).height();
  var headHei = $("#header").outerHeight();
  var footHei = $("#footer").outerHeight();
  $("#contents").css("min-height",h-headHei-footHei)
}

function allControlClose(){
	$(".allCtrl_area").slideUp("fast");
}

//テーブルの偶数・奇数の行の色を変える
$(function(){
     $("tr:odd").addClass("odd");
});


//ページトップへスクロールする※よく使用
$(function(){
   $('a[href^=#]').click(function() {
      var speed = 400;// ミリ秒
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top; //targetの位置を取得
      $($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});

//フォームにテキストを入れておき、フォーカスで消す（文字色も変更）
$(function(){
     $(".focus").focus(function(){
          if(this.value == "キーワードを入力"){
               $(this).val("").css("color","#f39");
          }
     });
     $(".focus").blur(function(){
          if(this.value == ""){
               $(this).val("キーワードを入力").css("color","#969696");
          }
     });
});

//ツールチップ
$(function(){
     $(".tooltip a").hover(function() {
        $(this).next("span").animate({opacity: "show", top: "-75"}, "slow");}, function() {
               $(this).next("span").animate({opacity: "hide", top: "-85"}, "fast");
     });
});
