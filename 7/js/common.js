$(function(){
	smoothscroll();
	ancSubmit();
	mainVisual();
	imgReplace();
	if($('.starbox').size() != 0){
		rateRank();
	}
	heightAlign();
	checkBrowser();
	$(document).on("change", ".searchNum", function () {
	    document.pageNumChange.submit();
	 });
});
//クリックでスライドダウン
function menuDown(){
	$('.spNavi').click(function() {
	   if($(this).next().css("display") == "none"){
	   	//$(this).find("span").removeClass('close').addClass('open');
	    $(this).next().slideDown('normal');
	  } else {
	  	//$(this).find("span").removeClass('open').addClass('close');
	    $(this).next().slideUp('fast');
	  }
  });
}
function mainVisual(){
	$('#mainVisual ul').bxSlider({
		auto: true,
		pause:	5000,
		speed: 1000,
		mode: 'horizontal',
		pager:true,
		adaptiveHeight: true
	});
}
function rateRank(){
	jQuery('.starbox').each(function() {
		var starbox = jQuery(this);
		starbox.starbox({
			average: starbox.attr('data-start-value'),
			changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
			ghosting: starbox.hasClass('ghosting'),
			autoUpdateAverage: starbox.hasClass('autoupdate'),
			buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
			stars: starbox.attr('data-star-count') || 5
		}).bind('starbox-value-changed', function(event, value) {
			if(starbox.hasClass('random')) {
				var val = Math.random();
				starbox.next().text('Random: '+val);
				return val;
			} else {
				starbox.next().text('Clicked: '+value);
			}
		}).bind('starbox-value-moved', function(event, value) {
			starbox.next().text('Moved to: '+value);
		});
	});
}

function tabPanel(){
	$(".tab li").click(function(){
		$(".tab li").removeClass("selected");
		$(".panel div").css("display","none");
	})
	$(".tab li.tab01").click(function(){
		$(".tab li.tab01").addClass("selected");
		$(".panel div.panel01").fadeIn("normal");
	});
	$(".tab li.tab02").click(function(){
		$(".tab li.tab02").addClass("selected");
		$(".panel div.panel02").show("normal");
	});
	$(".tab li.tab03").click(function(){
		$(".tab li.tab03").addClass("selected");
		$(".panel div.panel03").slideDown("normal");
	});
	$(".tab li.tab04").click(function(){
		$(".tab li.tab04").addClass("selected");
		$(".panel div.panel04").css("display","block");
	});
	$(".tab li.tab05").click(function(){
		$(".tab li.tab05").addClass("selected");
		$(".panel div.panel05").css("display","block");
		
	});
}


//-----[画像リンクフェード]
function hoverFade(){
	$("a img").hover(function(){
		$(this).fadeTo(100, 0.6);
	},function(){
		$(this).fadeTo(200, 1.0);
	});
}
			
//リンク切れ画像を差し替える
function noImgPath(){
     $('img').error(function(){
          $(this).attr({src:'images/missing.jpg',alt:'画像が見つかりません'});
     });
}

//テーブルの偶数・奇数の行の色を変える
function tableOdd(){
     $("tr:odd").addClass("odd");
}
//ページトップへスクロールする
function smoothscroll(){
  $('a[href^=#]').click(function() {
    var speed = 400; // ミリ秒
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? 'html' : href);
    var position = target.offset().top; //targetの位置を取得
    //$($.browser.safari ? 'body' : 'html').animate({scrollTop:position}, speed, 'swing');
    var body = 'body';
    var userAgent = window.navigator.userAgent.toLowerCase();
    if (userAgent.indexOf('msie') > -1 || userAgent.indexOf('trident') > -1 || userAgent.indexOf("firefox") > -1 ) { /*IE6.7.8.9.10.11*/
      body = 'html';
    }
    $(body).animate({
      scrollTop: position
    }, speed, 'swing');
    return false;
  });
}

//自動的に外部リンクを別タブで開く設定
function linkAutoBrank(){
    $("a[href^='http://']").attr("target","_blank");
}
function ancSubmit(){
	
	$("a.submit").click(function(event) {
		event.preventDefault();
		$(this).parents("form").submit();
	});
}

//マウスオーバーで画像を変更
function mHoverImg(){
     $('a img').hover(function(){
        $(this).attr('src', $(this).attr('src').replace('_off', '_on'));
          }, function(){
             if (!$(this).hasClass('currentPage')) {
             $(this).attr('src', $(this).attr('src').replace('_on', '_off'));
        }
   });
}

//フォームにテキストを入れておき、フォーカスで消す（文字色も変更）
function formfocus(){
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
}

//ツールチップ
function tooltip(){
     $(".tooltip a").hover(function() {
        $(this).next("span").animate({opacity: "show", top: "-75"}, "slow");}, function() {
               $(this).next("span").animate({opacity: "hide", top: "-85"}, "fast");
     });
}

//クリックで画像を置換する
function imgReplace(){
	$(".photoArea li img").click(function() {
		var imgPath = $(this).attr("src");
		$(".photoArea figure img").attr("src",imgPath);
	});
}
//要素の高さを揃える
function heightAlign(){
	var $selfWrap = $(".heightAlign"),//高さを揃えたい親要素
		$self = "a",//高さを揃えたい要素、セレクタで指定".box"
		maxHeight = 0;

	if($selfWrap.size() > 0){
		$(window).on("load resize", function(){
				goAlign();
		});
	}
	function goAlign(sta){
		// リサイズ用の初期値リセット
		$selfWrap.find($self).css("height","");
		// eachでそれぞれの高さをチェックし、一番高い値を保持
		$selfWrap.each(function(){
			maxHeight = 0;
			$($self,this).each(function(){
				if($(this).outerHeight()>maxHeight){
					maxHeight = $(this).outerHeight();
				}
			});
			$($self,this).css("height",maxHeight);
		});
		
	}
}

/*----------------------------
	 ブラウザ判定
----------------------------*/
function checkBrowser() {

	var _ua = navigator.userAgent;
	var ret = "";
	var isTab = (_ua.indexOf('iPhone') > 0 || _ua.indexOf('iPad') > 0 || _ua.indexOf('iPod') > 0 || _ua.indexOf('Android') > 0);
	if(_ua.match(/Chrome/)) {
		$('body').addClass("chrome");
		ret = "chrome";
	} else if(_ua.match(/MSIE/)) {
		$('body').addClass("ie");
		var appVersion = window.navigator.appVersion;
		if (appVersion.indexOf("MSIE 6.") != -1) {
			$('body').addClass("ie6");
			ret = "ie6";
		} else if (appVersion.indexOf("MSIE 7.") != -1) {
			$('body').addClass("ie7");
			ret = "ie7";
		} else if (appVersion.indexOf("MSIE 8.") != -1) {
			$('body').addClass("ie8");
			ret = "ie8";
		} else if (appVersion.indexOf("MSIE 9.") != -1) {
			$('body').addClass("ie9");
			ret = "ie9";
		} else if (appVersion.indexOf("MSIE 10.") != -1) {
			$('body').addClass("ie10");
			ret = "ie10";
		}
	} else if (_ua.match(/Trident/)) {
		$('body').addClass("ie11");
		ret = "ie11";
	} else if(_ua.match(/Firefox/)) {
		$('body').addClass("firefox");
		ret = "firefox";
	} else if(_ua.match(/Safari/)) {
		$('body').addClass("safari");
		ret = "safari";
	} else if(_ua.match(/Opera/)) {
		$('body').addClass("opera");
		ret = "opera";
	}
	return ret;
}