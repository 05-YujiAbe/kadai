var userProfile;
var anotherProfile = [];
var myaccount;
var milkcocoa = new MilkCocoa("eggifc4yt53.mlkcca.com");
var lock = null;
lock = new Auth0Lock('nKqqShDegbFzJUXELloM324zu0ull0H0', 'mychat-gs.auth0.com');
$(function(){
	$(document).on('click', '.btn-logout', function(event) {
		event.preventDefault();
		milkcocoa.logout();
		$('.logged-in-box').hide();
	});
	$('.btn-login').click(function(e) {
      e.preventDefault();
      lock.show(function(err, profile, token) {
        if (err) {
          // Error callback
          alert('There was an error');
        } else {
          // Success callback
          // Save the JWT token.
          localStorage.setItem('userToken', token);

          // Save the profile
          userProfile = profile;
          
        }
      });
    });

  

	//milkcocoa
	//$('.login-box').hide();
    //$('.logged-in-box').show();
          //$('.nickname').text(profile.nickname);
    //$('.nickname').text(profile.name);
    //$('.avatar').attr('src', profile.picture);
	
	getUser(function(err, user_id) {
	    var ds = milkcocoa.dataStore("message");//.child(user_id)
	    //3."message"データストアからメッセージを取ってくる
	    console.log(user_id);
	    var stream = ds.stream().sort("desc").size(5);
	    milkcocoa.dataStore('user').send({user_id}, function(err, sent){});
	    milkcocoa.dataStore('user').on("send", function(e) {
	        userCheck(e.value.user_id);

	    });
	    function userCheck(id) {
	    	$('.another-user li').each(function(index, el) {
	    		if(id = $(this).find('input').val()){
	    			$(this).find('a').text("ログイン中");
	    		}
	    	});
	    }
	    milkcocoa.dataStore("user").stream().next(function(err, users) {
	    	var exit = false;
	    	users.forEach(function(data) {
	    		//ログインしてきた人の登録があるかどうか
	    		
    			// if(callback == data.value.userID && callback != user_id){
    			// 	userDisplay(callback,data,false);
    			// 	exit = true;
    			// }
	    		
	    		// if(callback == user_id && user_id == data.value.userID){
	    		// 	userDisplay(user_id,data,true);
	    		// 	exit = true;
	    		// }
	    		
	    		
	    		
	    		if(userProfile == undefined){
	    			userDisplay(user_id,data);
	    			
	    			exit = true;
	    		//ログインしてきた人がuserのデータストアに存在するかどうか
	    		}else if(userProfile.user_id == data.value.userID){
	    			userDisplay(user_id,data);
	    			exit = true;
	    		//他のユーザーを表示
	    		}else{
	    			userDisplay(user_id,data);
	    		}
	        });
	        //データストアにユーザー情報がない場合登録
	        if(exit == false){
	    		userResist(userProfile);
	    	}
	    	$('.another-user li').each(function(index, el) {
	    		anotherProfile.push([$(this).find('input').val(),$(this).find('.avatar').attr('src')]);
	    	});
	    });
		
	    function getData(callback) {
		    stream.next(function(err, datas) {
		    	if(datas.length == 0){
		    		return;
		    	}
		    	if(callback){
		    		datas = datas.reverse();
		    	}
		        datas.forEach(function(data) {
		            renderMessage(data,callback);
		        });
		        if(!callback){
		        	scrollBottom();
		        }else{
		        	$('.msg-box-detail-cont').animate({scrollTop: 150}, 300);
		        }
		        loadflg = true;
		    });
		    
		}
		getData();
	    //4."message"データストアのプッシュイベントを監視
	    ds.on("push", function(e) {
	        renderMessage(e);
	        scrollBottom();
	    });
	
	    
	    var last_message = "dummy";
	    var lastDay;
	    function renderMessage(message,load) {
	        var message_html = '<span class="msg-window"><span class="msg-window-cont">' + escapeHTML(message.value.content) + '</span></span>';
	        var date_html = '';
	        var name_html = message.value.name;
	        var timeS = new Date(message.value.date).getHours() + ":" + new Date(message.value.date).getMinutes();
	        var nowDay = (new Date(message.value.date).getMonth()+1) + "月" + new Date(message.value.date).getDate() + "日";
	        var date_time = "";
	        var partnerImg = ""
	        date_html = '<span class="time-stamp">'+ escapeHTML(timeS) +'</span>';
	        //月日が違う場合、月日を挿入する
	        if(lastDay != nowDay ){
	        	date_time = '<div class="separate"><span>'+ escapeHTML(nowDay)+'</span></div>';
	        }
	        //自分以外の時画像を入れる
	        if(user_id != message.value.useId){
	        	$.each(anotherProfile,function(index,val){
	        		//console.log(val[0]);
	        		if(val[0] == message.value.useId){
	        			partnerImg = '<p class="name"><img src="'+ val[1] +'" alt=""></p>';
	        		}
				});
	        }
	        
	        //追加読み込みの場合
	        if(load == "load"){
	        	if(user_id == message.value.useId){
		        	$(".msg-display-area").prepend('<div id="'+message.id+'" class="user">' + date_time +date_html + message_html +'</div>');	
		        }else{
		        	$(".msg-display-area").prepend('<div id="'+message.id+'" class="partner">' + date_time + partnerImg +message_html + date_html +'</div>');	
		        }
	        //最初表示の時
	        }else{
	        	if(user_id == message.value.useId){
		        	$(".msg-display-area").append('<div id="'+message.id+'" class="user">' + date_time +date_html + message_html +'</div>');	
		        }else{
		        	$(".msg-display-area").append('<div id="'+message.id+'" class="partner">' + date_time + partnerImg +message_html + date_html +'</div>');	
		        }
	        	
	        }
	        
	        // last_message = message.id;
	        lastDay = nowDay;
	    }

	    function post() {
	        //5."message"データストアにメッセージをプッシュする
	        var content = escapeHTML($("#content").val());
	        if (content && content !== "") {
	            ds.push({
	                name: myaccount,
	                content: content,
	                date: new Date().getTime(),
	                useId: user_id
	            }, function (e) {});
	        }
	        $("#content").val("");
	    }
	    function userResist(user){
	   			milkcocoa.dataStore("user").push({
		                userID: user.user_id,
		                name: user.nickname,
		                picture: user.picture
		            }, function (err,pushed) {
		            	 console.log(pushed);
		        });

		}
	    function userDisplay(id,users,self){
	    	var user_html = '<img class="avatar" src="'+ users.value.picture +'"/><span class="nickname">'+users.value.name+'</span><input type="hidden" value="'+ users.value.userID +'" />';
	    	if(id == users.value.userID){
	        	$(".logged-in-box ul").prepend('<li class="myaccount">'+ user_html +'</li>');
	        	myaccount = users.value.name;
	    	}else{
	        	$(".another-user ul").prepend('<li>'+ user_html +'<a href="">リクエスト</a></li>');
	    	}
	    	
	    }

	    $('#post').click(function () {
	        post();
	    })
	    $('#content').keydown(function (e) {
	        if (e.which == 13){
	            post();
	            return false;
	        }
	    });
	    var loadflg = true;
	    $('.msg-box-detail-cont').scroll(function () {
		  if($('.msg-box-detail-cont').scrollTop() <= 1){
		  	if(loadflg){
		  		getData("load");
		  		
		  		loadflg = false;
		  	}
		  	
		  };
		  
		});

	});


	
});
function escapeHTML(val) {
    return $('<div>').text(val).html();
};
function scrollBottom() {
	 $('.msg-box-detail-cont').scrollTop($(".msg-display-area").outerHeight());
	// console.log($(".msg-display-area").outerHeight());
};
function getUser(callback) {
      // 現在ユーザーがログインしていたら'user'にユーザー情報を渡す

      milkcocoa.user(function(err, user) {
      	
        // エラーが出たらストップ
        if (err) {
          callback(err);
          return;
        }

        // ログインしていたら
        if(user) {

          // ログイン後処理
          callback(null, user.sub);
          
        }
        // ログインしてなかったら
        else{

          // showはログイン画面を表示する関数。コールバックはユーザーがログインを行ったときに実行するもので、ユーザー情報を'profile（生データ）'と'token（トークン化されたもの）'に渡す。
          lock.show(function(err, profile, token) {

            if (err) {
              callback(err);
              return;
            }
            userProfile = profile;
            // デバッグ用
            //console.log(err, profile, token);
            
            // tokenを使ってMilkcocoaでログイン
            milkcocoa.authWithToken(token, function(err, user) {

              if(err) {
                callback(err);
                return;
              }
              // ログイン後処理
              
              
              callback(null, user.sub);
            });
          });
        }
      });
    }
    //getUser終了
