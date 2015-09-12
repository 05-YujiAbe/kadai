$(function(){
	smoothscroll();
  gMap();
	catchCopy();
  if($('.pageTop').size() > 0){
  	
    pageTop();
  }
  $('.infoContent .img').hover(function() {    
        if ($(this).ClassyWiggle('isWiggling')) {
          $(this).ClassyWiggle('stop');
          }
          else {
          $(this).ClassyWiggle('start', {                    
            delay: 30                                          
          });
        }
   });
  // scrollFadeIn();
  // $(document).on('change', '#catSelect', function() {
  //   var catId = $(this).val();
  //   $(".catChange").trigger('submit');

  // });
  // セレクト
  $(".customSelect select").change(function() {
      $(this).next().html($("option:selected", this).text());
    }).trigger("change");
});
function gMap(){
    google.maps.event.addDomListener(window, 'load', function() {
            var mapdiv = document.getElementById("gMap");
            var myOptions = {
                    zoom: 16,
                    center: new google.maps.LatLng(35.658821, 139.703602),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scaleControl: true,
            };
            var map = new google.maps.Map(mapdiv, myOptions);
            var infoWindow  = new google.maps.InfoWindow({context: ''});
    function addMarker(point)
    {
      var image = new google.maps.MarkerImage(
        "images/map-icon.png",
        new google.maps.Size(32, 32)
      );
      // var shadow = new google.maps.MarkerImage(
      //   "http://maps.google.co.jp/mapfiles/ms/icons/rangerstation.shadow.png",
      //   new google.maps.Size(48, 32)
      // );
    
      var marker = new google.maps.Marker({
        position: point,
        map: map,
        icon: image,
        // shadow: shadow,
        zIndex: 99
      });
    
      google.maps.event.addListener(marker, 'click', function(event)
      {
        // center map
        map.panTo(marker.getPosition());
    
        // open info window
        infoWindow.close();
        infoWindow.setContent("<p style='font-size: 12px; text-align: center;'><span style='color: #000; font-size: 12px; font-weight: bold;'>Cheese ACADEMY TOKYO</span></p>");
    
        infoWindow.open(map, marker);
      });
      return marker;
    }
    addMarker(new google.maps.LatLng(35.658778, 139.705265));
        });
}
function scrollFadeIn(){
  $(".courseContent dl,.galleryContent ul li,.featureContent li").css("opacity",0);
  $(window).bind('load', function(){
    var sct = $(document).scrollTop();
    var hei = $(window).height();
    
    function anime(){
      sct = $(document).scrollTop();
      hei = $(window).height();
      $(".courseContent dl").each( function(){
        if($(this).offset().top + 100 < sct + hei){
          $(this).animate({opacity:"1", left: 0}, 1200);       
        };
      });
     
      if($(".featureContent").offset().top + 100 < sct + hei){      
        // 繰り返し処理
        $('.featureContent li').each(function(i) {
          // 遅延させてフェードイン
          $(this).delay(400 * i).animate({
            "opacity":1},
            1000
          );
        });     
      };
      if($(".galleryContent").offset().top + 200 < sct + hei){      
        // 繰り返し処理
        $('.galleryContent ul li').each(function(i) {
          // 遅延させてフェードイン
          $(this).delay(400 * i).animate({
            "opacity":1},
            1000
          );
        });     
      };

    }
    
    $(window).scroll(function () {
      anime();    
    });
    var timer =false;
    $(window).resize(function() {
      if(timer !== false) {
        clearTimeout(timer);  
      }
        timer = setTimeout(function() {
          anime();
        },200);
    });
    anime();
  });
}
//ページトップへスクロールする
function smoothscroll(){
  $('a[href^=#]').not(".noscroll").click(function() {
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
function pageTop(){

  var elm = $('.pageTop');
  $(window).scroll(function(){
    setPos();
  });
  function setPos(){
    
    if($(window).scrollTop() >= 500){
    	elm.fadeIn("slow");
    }else{
    	elm.fadeOut("normal");
    }
  }
}
function catchCopy(){
	$(window).load(function() {
		setTimeout( catchCopyFade(), 3000 );
	});
	function catchCopyFade(){
		$(".catchCopy h2").fadeIn(2000, function() {
			$(".catchCopy p").fadeIn(2000);			
		});
	}
}