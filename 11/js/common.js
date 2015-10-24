var mapGeo;
var map;
var historyInputData = [];
var currentInfoWin = null;
var favoriteList = [];
var janreInputData =[];
var catS;
var LatLng;

$(function(){
	setLayout();

	historyInputLoad();
	$(window).resize(function(event) {
		setLayout();
	});
	// geoOn();
	$(document).on('click', '.goSearch', function(event) {
		event.preventDefault();
		atMove(".searchArea");
	});
	// ÏÂ²¿¥Ê¥Ó¥Ü¥¿¥ó¤òÑº¤·¤¿•r
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
	// ×óÉÏ¥Ü¥¿¥ó¤òÑº¤·¤¿•r¤É¤Á¤é¤Ë‘ø¤ë¤Î¤«
	$(document).on('click', '.cancel', function(event) {
		if($(this).is(".toArchive")){
			atMove(".searchArea");
		}else{
			atMove(".start");
		}
	});
	$(document).on('click', '.infoWindowTxt i', function(event) {
		if($(this).is(".select")){
			$(this).removeClass('select');

			removeFavorite($(this).find('input').val());
			attendPop("DELETE");
		}else{
			$(this).addClass('select');
			var infoFa = $(this).parents(".infoWindowTxt");
			favoriteList.push([
				infoFa.find(".name").find("input").val(),
				infoFa.find(".name").find("span").text(),
				infoFa.find(".address").text(),
				infoFa.find(".tel").text(),
				infoFa.find(".url").find("a").attr("href")
			]);
			// console.log(favoriteList);
			attendPop("SAVE");
			setFavorite(favoriteList);
		}
	});
	$(document).on('change','.janre input', function(event) {
		if($(this).val() == ""){
			$(".janre input").val("");
		}else{
		}
	});
	$(document).on('change','.place input', function(event) {
		if($(this).val() == ""){
			$(this).val("現在地から探す");
		}else{
		}
	});
	//検索ボタンを押したら
	$(document).on('click', '.search', function(event) {
		var s = $(".place input").val();
		catS = $(".janre input[type=hidden]").val();
		$(".loading").fadeIn("slow");
		historyInputSave(s);
		locationSet(s);

		// $(".toSearchArea").submit();
		
		// atMove(".resultArea");
		// $(".control .cancel").addClass('toArchive').html("—ÊË÷»­Ãæ¤Ë‘ø¤ë");
		// $(".control .search").hide();
		//geoOn(s);
	});
	//住所やジャンルをインプットへ代入
	$(document).on('click', '.findList li', function(event) {
		if($(this).is(".janreItem")){
			$(".janre .ji").val($(this).text());
			$(".janre .jic").val($(this).find("input").val());
		}else{
			$(".place input").val($(this).html());
		}
		setLayout();
	});
	$(document).on('focus', '.findSelect input', function(event) {
		if($(this).is(".pi")){
			historyInputLoad();

		}else{
			janreInputLoad();
		}
		$(".findList").slideDown('fast');
		/* Act on the event */
	});
	$(document).on('blur', '.findSelect input', function(event) {
		// $(".findList").slideUp('fast');
		/* Act on the event */
	});
	// ¤ªšÝ¤ËÈë¤êµê ¤ÇÏ÷³ý
	$(document).on('click', '.delete i', function(event) {
		$(this).closest('li').fadeOut('fast', function() {
			$(this).remove();
		});
		removeFavorite($(this).find('input').val());
	});
	$(document).on('click', '.nivo', function(event) {
		event.preventDefault();
		$(this).trigger($('.nivo').nivoLightbox());
	});

	nivoSet();
	
});
function nivoSet(){
	$('.nivo').nivoLightbox();
}

// ÒÔÏÂévÊý
function locationSet(point){

	if(point == "現在地から探す"){
		if(navigator.geolocation){
	  		navigator.geolocation.getCurrentPosition(
	  			function(pos){
	  				gurunaviSearch(pos.coords.latitude,pos.coords.longitude);
	  			},function(error){
	  				var message = "";
	           		alert(error.code);
	  			}
	  		);

	  	}else{
	  		alert("geolocationが使えません");
	  	}
	}else{
		mapGeo = new google.maps.Geocoder();
		var req = {
		        address: point,
		};
		mapGeo.geocode(req, geoCallback);

	}
}
function geoCallback(result, status){
	
	if (status != google.maps.GeocoderStatus.OK) {
	        alert("該当箇所がありません");
	    	return;
	    }
	    var latlng = result[0].geometry.location;
	    
	    gurunaviSearch(latlng.lat(),latlng.lng());
}

function geoOn(lat,lng,data){
	$("#gmap").empty();
	var $lat = +lat;
	var $lng = +lng;
	gmap($lat,$lng,data);
  	function gmap(x,y,data){
  		google.maps.event.addDomListener(window, 'load', function() {
	  		map = new google.maps.Map(document.getElementById("gmap"),{
			zoom : 16,
			center : new google.maps.LatLng(x,y),
			mapTypeId : google.maps.MapTypeId.ROADMAP
			});
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(x,y),
				map: map
			});
			gurunaviDisplay(data);
		});

  	}
  	

}
function gurunaviSearch(lat,lng){
		$("input[name=lat]").val(lat);
		$("input[name=lng]").val(lng);
		$(".toSearchArea").submit();
}
function gurunaviDisplay(data){
	
		var markerImg = new google.maps.MarkerImage(
	        "http://maps.google.com/mapfiles/kml/pal2/icon32.png"
	    );
	    // console.log(result);
		$.each( data, function( i, val ) {
	    	var shopId = val.id;
	    	var shopName = val.name;
	    	var shopAdd = val.address;
	    	var shopLat = val.latitude;
	    	var shopLong = val.longitude;
	    	var shopPr = val.pr.pr_short;
	    	var shopTel = val.tel;
	    	var shopUrl = val.url;
	    	var latLng = geo_japan2world(shopLat,shopLong);
	    	// ¾•¶È½U¶ÈÇéˆó¤òÈ¡µÃ
	        // ¥Þ©`¥«©`¤òÔO¶¨
	        var markerObj = new google.maps.Marker({
	            position:  new google.maps.LatLng(latLng[0], latLng[1]),
	            map: map,
	            icon: markerImg
	        });
	        if(localStorage.getItem("favoriteData")){
	        favoriteList = JSON.parse(localStorage.getItem("favoriteData"));
	    	}
	        var faCheck;
			if(favoriteList.length > 0){
				$.each(favoriteList, function(i, value) {
					if($.inArray(shopId, favoriteList[i]) == 0){
						faCheck = "select";
						return false;
					}
				});
			}
			
	        // Çéˆó¥¦¥£¥ó¥É¥¦¤ÎHTML×÷³É
	        var html = "<div class='infoWindow'>"
	                    + "<div class='infoWindowTxt'>"
	                    + "<p class='name'><span>" + shopName + "</span><i class='fa fa-heart-o " + faCheck + "'><input type='hidden' value='"+ shopId +"'></i></p>"
	                    + "<p class='address'>" + shopAdd + "</p>"
	                    + "<p class='tel'>TEL:" + shopTel + "</p>"
	                    + "<p class='url'><a href='"+ shopUrl+ "' class='nivo' data-lightbox-type='iframe'>お店のHPをみる</a></p>"
	                    +"</div></div>";
	        
	        
	        var infoWin = new google.maps.InfoWindow({maxWidth:300});
	        infoWin.setContent(html);

	        // ¥Þ©`¥«©`¤ò¥¯¥ê¥Ã¥¯¤·¤¿¤éÇéˆó¥¦¥£¥ó¥É¥¦¤ò±íÊ¾
	        google.maps.event.addListener(markerObj, 'click', function(){
	            if(currentInfoWin){
	                currentInfoWin.close();
	            }
	            infoWin.open(map, markerObj);
	            currentInfoWin = infoWin;
	            nivoSet();
	            // console.log(currentInfoWin.content);
	        });
	  	});
		
		
   
}
function gurunaviCat(result){
	
  $.each( result, function( i, val ) {
  	// janreInputData[i] = [
  	// 	val.category_l_code,
  	// 	val.category_l_name];
  	janreInputData[i] = {
  		code:val.category_l_code,
  		name:val.category_l_name};
  });
	  
}

function atMove(e){
	if(e == ".searchArea"){
		$(".goSearch").hide();
		$(".control").fadeIn('fast');
	}else if(e == ".start" || e == ".shopListArea"){
		$(".control").hide();
		$(".goSearch").fadeIn('fast');
	}
	if($(".control .cancel").is(".toArchive")){
		$(".control .cancel").removeClass('toArchive').html("¥­¥ã¥ó¥»¥ë");
		$(".control .search").show();
	}

	$("main > div").hide();
	setLayout();
	$(e).slideDown('normal');
}
function historyInputLoad(){
	if(localStorage.getItem("historyInput")){
		historyInputData = JSON.parse(localStorage.getItem("historyInput"));
		$(".findList").empty("");
		$.each(historyInputData, function(i, value) {
			$(".findList").append("<li>" + value + "</li>");
		});
	}
}
function janreInputLoad(){
	$(".findList").empty("");
	$.each(janreInputData, function(i, value) {
		$(".findList").append("<li class='janreItem'>" + value.name + "<input type='hidden' value='"+ value.code +"'></li>");
	});
}
function historyInputSave(e){
	historyInputData.unshift(e);
	if(historyInputData.length > 5){
		historyInputData.pop();
	}
	localStorage.setItem("historyInput",JSON.stringify(historyInputData));
}
function setFavorite(array){
	localStorage.setItem("favoriteData",JSON.stringify(array));
}
function removeFavorite(id){
	favoriteList = JSON.parse(localStorage.getItem("favoriteData"));
	$.each(favoriteList, function(i, value) {
			if($.inArray(id, favoriteList[i]) == 0){
				favoriteList.splice(i,1);
				return false;
			}
	});
	localStorage.setItem("favoriteData",JSON.stringify(favoriteList));
}
function shopList(){
	$(".shopListArea ul").empty();
	if(localStorage.getItem("favoriteData")){
	    favoriteList = JSON.parse(localStorage.getItem("favoriteData"));
	}
	$.each(favoriteList, function(i, value) {
		$(".shopListArea ul").append('<li><a href="'+favoriteList[i][4]+'" target="_blank"><strong>'+favoriteList[i][1]+'</strong><span>'+favoriteList[i][3]+'</span><br><span>'+favoriteList[i][2]+'</span></a><span class="delete"><i class="fa fa-times"><input type="hidden" value="'+favoriteList[i][0]+'"></i></span></li>')
	});
	
}
function setLayout(){
	var w = $(window).width();
	var h = $(window).height();
	var headHei = $("header").outerHeight();
	var footHei = $("footer").outerHeight();
	$("main").css("height",h-headHei-footHei);
}
// ÈÕ±¾¾•¶È½U¶È¡¡¡ú¡¡º£Íâ¾•¶È½U¶È
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
//ÎÄ×ÖÁÐ¤Î¸ÄÐÐ¥³©`¥É¤ò<br>¤Ë
function nl2br(str) {
    return str.replace(/[\n\r]/g, "<br>");
}
//ÎÄ×ÖÁÐ¤Î<br>¤ò¸ÄÐÐ¥³©`¥É¤Ë
function br2nl(str) {
    return str.replace(/<br>/g, "\n");
}