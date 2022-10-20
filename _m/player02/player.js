$(function() {
	var $pconsol=$("#playerConsoleCont");
	var debug=$("#debug")

	var S=G["ss"];
	//Slert (G["s"][0]["scene"])
	var $desktopWidth=1000
	var $desktopWidthMin=340
	var $playerBackImgRatio=(9/16) 	
	// 9/21 
	var adaptTex2Balloon=function (t)	{
		if (!t) return;
		t=t.trim()
		t=t.replace(/\n/g,"<br />");//nl2br
		
		return t
	}
	
	var loadAttach=function(s, scene) {
		if (!scene) scene="A";
		G["ss"][scene]
		
		//Slert("s="+s)
		if (!S[scene][s]["A"].length) return false;
		window.setTimeout(function() {	
				$("#attachShowImg a,.attachTxt,.view").hide();

			//slert (S[s]["compulsoryAttachments"])
				if (S[scene][s]["compulsoryAttachments"]=="1")  			$("#compulsoyAtt").show()
				else 																				$("#compulsoyNotAt").show()
				
				for (i = 0; i < S[scene][s]["A"].length; i++) {
					I=i+1
					$("#att_"+I).show()
						.attr("href", 		S[scene][s]["A"][i]["path"]	)
					$("#att_"+I +" .attImg").attr("src", "/img/ico/"+S[scene][s]["A"][i]["type"]+"60.png")
						.attr("title", 		S[scene][s]["A"][i]["title"]	)
				}
				$('#fx2').trigger("play")
				$("#attachShow").fadeIn("300", function () {
					if (S[scene][s]["compulsoryAttachments"]!="1") $("#playerConsoleCont").fadeIn("600")
				});;
				
				
				
		}, 1000	)
		
		return true;
	}
	var loadStep=function(s, scene, isFinal) {

		$("#attachShow").fadeOut();
		$("#attachShow a").attr("data-read", 0)
		if (!scene) scene="A"; 
		if (!isFinal) isFinal=false; else isFinal=true;		
		if (isFinal) scene="A";	
		$("#currentscene").val(scene)
		//alert (scene+" "+s)
		
		

		var S=G["ss"][scene];
		
		$( "#mask" ).fadeIn('fast'); $("#balloon").hide();
		$pconsol.attr("data-step", 		s		).attr("data-steps", G["steps"]); //s  
		
		//Slert (G["steps"])
		$("#scenario").attr("src",S[s]["scenario"]).fadeIn();
		//$("#avatar_id").val(avatar_id);
		avatar_id=S[s]["avatar_id"]

		currentAvatarId=$("#avatarSprite").attr("data-currentAvatar");

		$("#avatarSprite").attr("class", 		$("#avatarSprite").attr("class").replace("avatar_"+currentAvatarId, "avatar_"+avatar_id).replace("avatar_"+currentAvatarId+"_talk", "avatar_"+avatar_id)			).attr("data-currentAvatar", avatar_id);
		$("#avatarSpriteTalk").attr("class", 		$("#avatarSpriteTalk").attr("class").replace("avatar_"+currentAvatarId+"_talk", 	"avatar_"+avatar_id+"_talk")			);
		if (avatar_id==1000) $("#avatarSprite").hide();
		
		size=S[s]["avatar_size"]
		currentSize=$("#avatarSprite").attr("data-currentSize");
		currentClass=$("#avatarSprite").attr("class");
		currentClassTalk=$("#avatarSpriteTalk").attr("class");		
		$("#avatarSprite").attr("class", 		currentClass.replace("wait_"+currentSize, "wait_"+size)			)
		$("#avatarSpriteTalk").attr("class", 		currentClassTalk.replace("wait_"+currentSize, "wait_"+size)			)
		
		$("#avatarSprite").attr("data-currentSize", size);	
		$("#avatarSprite,#avatarSpriteTalk").attr("style", "left: "+S[s]["avatar_posA"][0]+"px;top: "+S[s]["avatar_posA"][1]+"px;" ) 
		
		//

		$("#balloon").attr("style", "left: "+S[s]["balloon_posA"][0]+"px;top: "+S[s]["balloon_posA"][1]+"px;" )
		//if (avatar_id!=1000) $("#balloon").show();
		//.attr("data-pos", posB[0] +","+ posB[1] ).
		$("#balloon span").html(adaptTex2Balloon(S[s]["avatar_sentence"]));
		
		
		arrowY=S[s]["arrowY"];
		//Slert (arrowY);
		$("#leftArrow").attr("data-top", arrowY ).attr("style", "right: -17px;top: "+arrowY+"px;" ) 
		$("#rightArrow").attr("data-top", arrowY ).attr("style", "left: -17px;top: "+arrowY+"px;" ) 
		/*if (avatar_id==1000){
			if (S[s]["arrowPos"]=="right") {$("#rightArrow").show();$("#leftArrow").hide();}
			else	{$("#rightArrow").hide();$("#leftArrow").show();}
		}
		*/
		$("#aansw").attr("src", S[s]["avatar_audio"]+"?"+Math.random()			)	// audio
		if (!isFinal) {
			$("#playerConsoleCont").attr("data-answern",S[s]["answerN"])
			$(".choiceOpt").hide()
			for (i = 1; i <= S[s]["answerN"]; i++) {
	
				$("#say_"+i ).text(S[s]["answer_"+i  ]			).attr("data-scene", S[s]["goto"+i  ]) //i+" "+
				$("#opt_"+i ).show();			
				//Slert ("answer_"+i  +" "+S[s]["answer_"+i  ])
				//$("#sayimg_"+i).attr("src", "/data/imgavtr/faceEmotions/"+usr_avatar_id+"/"+D[$STATE][i]['USR']['emo']+".jpg")
			}
			RRR=Math.floor(Math.random() * S[s]["answerN"]);RRR=RRR+1
			$("#say").attr("data-sayord",RRR)
			$("#say").text(S[s]["answer_"+RRR  ])
			$("#say").attr("data-scene", S[s]["goto"+RRR  ])

		}
		$( "#mask" ).fadeOut('fast')
		$pconsol.hide();
		/*$("#scenario").fadeOut(300).promise().done(function(  ) {
				//if(document.createElement('svg').getAttributeNS)	document.getElementById('audioBell').play()
				//$("#t2").fadeIn(1200)
			});
		*/
//		



		if(s>0) { //firstOne triggered by close info button
			$('#fx1').trigger("play")
			$("#playmask").fadeOut(2500).promise().done(function(  ) {
				window.setTimeout(function() {playStep(s,scene, isFinal)	}, 1600	)	
		})				

		}else{
			$("#playmask").fadeOut(200);
		}
		$("#core #send_no").attr("id", "send")
		
	}

	// stepLoad=>play=>animazione=>
	//CURRENTSCENE="A";
	var transmit=function(data) {
		//Slert ("gameId:"+ data["gameId"]);
		
		$("#saving").show()
		$.ajax({
			type: "POST", url: "/_m/player02/ajax.player.php"
			,data: {data:data} 
			,cache: false,dataType: 'html',
			success: function(php_answer){
				R=php_answer.split("|-|")
				//Slert (php_answer)
				$("#debug").html(php_answer)
				$("#saving").hide()
				
				
				if (data["cmd"]=="stepon") {///////////////////////////////////////////
					//Slert ("stepon") 
					//stepNext=data["stepIndex"]+1;
					stepNext=parseInt($pconsol.attr("data-step"))+1
					
					//stepgo=stepNext+1;
					if (stepNext>$("#playerConsoleCont").attr("data-steps")-1	){
						$pconsol.hide()
						//alert ("CALCOLO FINALE"); 
						window.setTimeout(function() { 
								transmit({cmd:"finalCalc",gameId:G["gameId"],idm:G["idm"]})
							}, 1000) 						
						
						
					}else {
						showChoiceOpt(false)
						//slert (data["goto"]+" "+stepNext);											
						
						$("#playmask").fadeIn(100).promise().done(function(  ) {
							loadStep(stepNext, data["goto"]);
						})						
					}
				}				
				

				/////////////////////////////////////////////////////////
				if (data["cmd"]=="finalCalc") {
					var FINALSTEPDATA=$.parseJSON(R[1])
					//Slert (FINALSTEPDATA["step"]);
					loadStep((FINALSTEPDATA["step"]-1),"A",true)
				}
				//////////////////////////////////////////////////////////
				if (data["cmd"]=="getExchanges") {
					$("#logC").html(R[1])
					
				}
				
				
			},

		})
			
	}


	$('#fcalc').on('click',function(e){e.preventDefault()
		transmit({cmd:"finalCalc",gameId:G["gameId"],idm:G["idm"]})
	})	
	$('#send,.sendOpt').on('click',function(e){e.preventDefault()
		var $STEP=parseInt($pconsol.attr("data-step"));
		
		if (this.id=="send") {
			$sayN=$("#say").attr("data-sayord")
			sceneGo=$("#say").attr("data-scene")
			$(this).attr("id", "send_no")
		}else {
			$sayN=this.id.replace("send_","")
			sceneGo=$("#say_"+$sayN).attr("data-scene")
		}
		
		
		//slert (sceneGo+$STEP)
		sceneGet=$("#currentscene").val();
		//alert (sceneGet)
		transmit({cmd:"stepon",gameId:G["gameId"], stepIndex:$STEP,  scene:sceneGet	, answer: $sayN, idm:G["idm"], score: G["ss"][sceneGet][($STEP)]["ascore_"+$sayN], steps:G["steps"], goto:sceneGo})	
	})	

	var playStep=function(s,scene, isFinal) {
		if (!isFinal) isFinal=false; else isFinal=true;
		if (!scene) scene="A";
		$pconsol.attr("data-playing", "1")
		//Slert (scene)
		$("#balloon").fadeIn("fast");
		if (S[scene][s]["arrowPos"]=="right") {$("#rightArrow").show();$("#leftArrow").hide();}
		else	{$("#rightArrow").hide();$("#leftArrow").show();}
		$pconsol.fadeOut("fast")
		if (S[scene][s]["avatar_id"]==1000) $("#rightArrow,#leftArrow").hide();
		
		currentAvatarId=$("#avatarSprite").attr("data-currentavatar")
		//$("#avatarSprite").attr("class", 		$("#avatarSprite").attr("class").replace("avatar_"+currentAvatarId, "avatar_"+avatar_id+"_talk")	)
		$("#avatarSpriteTalk").show(0, function(){
    		$("#avatarSprite").hide();
		});

	
		$('#aansw').trigger("play").on('ended',function(){
			
			$('#aansw').hide().unbind('ended')
			
			currentAvatarId=$("#avatarSprite").attr("data-currentAvatar");		
//			$("#avatarSprite").attr("class", 		$("#avatarSprite").attr("class").replace("avatar_"+currentAvatarId+"_talk", "avatar_"+currentAvatarId)			)
			$("#avatarSpriteTalk").hide()
			$("#avatarSprite").show()

			if (!isFinal) $loadA=loadAttach(s);
			else $loadA=false;
			
			if (!isFinal		&&  S[scene][s]["compulsoryAttachments"]!="1" && !$loadA	) $pconsol.fadeIn("slow")
			if (!isFinal) {
				$("#balloon").fadeOut("slow");
				
			}
			$pconsol.attr("data-playing", "0")
			if (isFinal) {
				window.setTimeout(function() { 
					$("#mask, #explain").hide()
					$("#debriefsplash").fadeIn(500);
					}, 2000) 
				}

		})		
		
		
	}
	$(".atta") .on('click',function(e){
		var id=this.id
		window.setTimeout(function() {
			sceneGet=$("#currentscene").val();
			st=$pconsol.attr("data-step")
			$("#"+id).attr("data-read", "1").find(".view").fadeIn(100);
			
			
			if (S[sceneGet][st]["compulsoryAttachments"]=="1"	) {
				$showConsole=true;
				for (iX = 1; iX <= S[sceneGet][st]["A"].length; iX++) {
					//Slert ($("#att_"+iX).attr("data-read"))
					if ($("#att_"+iX).attr("data-read")=="0") $showConsole=false;
				}

				//Slert ($showConsole)
				if ($showConsole) $("#playerConsoleCont").fadeIn("slow")

			}
		}, 1000) 
	});

	// CHOICE
	$('.closeChoice').on('click',function(e){e.preventDefault();
		showChoiceOpt(false)
		//$( "#playerConsole" ).show();		
	});
	$('#up,#say').on('click',function(e){e.preventDefault();
		showChoiceOpt(true)
		//$( "#playerConsole" ).hide();
	})	
	$('#next,#prev').on('click',function(e){e.preventDefault()
		
		answern=$("#playerConsoleCont").attr("data-answern");
		//Slert (answern) 
		
		$actualSayO=parseInt($("#say").attr("data-sayord"))
		if (this.id=="next") $sayNowO=$actualSayO+1
		if (this.id=="prev") $sayNowO=$actualSayO-1
		if ($sayNowO>answern) 	$sayNowO=1;
		if ($sayNowO<=0) 			$sayNowO=answern;
		
		//Slert ($sayNowO+"#say_"+$sayNowO);
		$("#say").text(	$("#say_"+$sayNowO).text()			).attr("data-sayord",$sayNowO)
		
	})


	
	
	$('.showLastExc, #start').on('click',function(e){e.preventDefault()
		$("#attachShow").hide();
		var $STEP=parseInt($pconsol.attr("data-step"));
		playStep($STEP)
	})

	function css_adaptP(cmd) {
		//return;
		//Slert ("css")
		var H=$(window).height(); var W=$(window).width();
		$("#mask").css({'width':W+'px'});$("#mask").css({'height':H+100+'px'})
		
		if (W<$desktopWidth) {
			var H_16_9 =W*$playerBackImgRatio
			//$("#player,#QUITE,#QUITED,#vask,#vansw,#debriefsplash,#listenU,#listenB").css({'width':W+'px'}) //,.vid
			//					.css({'height':H_16_9+'px'})
		}else{
			if (W<$desktopWidthMin) W=$desktopWidthMin //limit			
			var H_16_9 =$desktopWidth*$playerBackImgRatio
			//$("#player,#QUITE,#QUITED,#vask,#vansw,#debriefsplash,#listenU,#listenB").css({'width':$desktopWidth+'px'}) //,.vid    ,#vask,#vansw,#QUITE  #playerBackImg,
			//					.css({'height':H_16_9+'px'})
		}
		// #playerConsole
		//## pop 1/2
		$popH=H-62;		
		$popLt=$(".pop").width() ;
		if ($popLt>800) { 
			$popLt=800
			$(".pop").css("width", $popLt+ "px")
		}
		$popL=(W- $popLt ) / 2;
		

		$(".pop").css("left", $popL-20 + "px")//.hide()
		$(".pop").css("max-height", $popH+50+ "px")
		$("#contentH").css("max-height",$popH-170 + "px")	
				
		if (H<H_16_9+70-10) { //
			debug.html("playerConsoleTight")
			$pconsol.addClass("playerConsoleTight").removeClass("playerConsoleTall")
			$popT=10;
			$popH=H-47;
		}else{
			debug.html("playerConsoleTall")
			$pconsol.addClass("playerConsoleTall").removeClass("playerConsoleTight")
			$popT=(H- $(".pop").height() ) / 2;
			$popH=H-62;
		}
		//## pop 2/2
		$(".pop").css("top", $popT + "px")
		$(".pop").css("max-height", $popH+ "px")
		$("#contentH").css("max-height",$popH-170 + "px")
		//$(".pop").show()
		//## choice		

		$choiceH=$pconsol.offset().top+70-20
		$("#choiceCont").css("max-height", $choiceH+ "px")
		$("#choiceC").css("max-height", ($choiceH-$("#choiceH").height())+ "px")
		
		//balloonFontAdapt()
	}/// CSS ENDS



	var showChoiceOpt=function(p){
		if (p) {
			$( "#mask" ).fadeIn('fast')
			$( "#playerConsole" ).fadeOut('fast')
			$( "#choiceCont" ).slideDown('fast')			
			.promise().done(function(  ) {
			css_adaptP() 
			})
			return
		}
		$( "#mask" ).fadeOut('fast')
		$( "#choiceCont" ).slideUp('fast')
		$( "#playerConsole" ).fadeIn('fast')
	}

	//// SHOINFO
	var showInfo=function(p){
		
		if (p) {
			if ($pconsol.attr("data-playing")	=="1") { return;}
			$pconsol.fadeOut();
			$( "#mask,#explain" ).css("z-index", "105").fadeIn('fast')
			.promise().done(function(  ) {
				if (	!$("#logC .tmptxt").length) $("#logshow").click()
				css_adaptP() 
			})
			return
		}
		if (!$("#explainClose").hasClass("ftime")) $pconsol.fadeIn();
		$( "#mask,#explain" ).css("z-index", "100").fadeOut('fast')
	}
	
	$('.showInfo').on('click',function(e){e.preventDefault(); showInfo(true)})
	$('#explainClose').on('click',function(e){e.preventDefault();

		showInfo(false);$("#playerConsole").show();	
		if ($(this).hasClass("ftime")) {
			window.setTimeout(function() { 
						playStep(0)
					}, 1200) 
			$(this).removeClass("ftime");
		}
		
	})	
	$('#infoChars').on('click',function(e){e.preventDefault();		
		$('#explainH a, #logshow').removeClass("onA").removeClass("onB")
		$(this).addClass("onB")
		$("#infoMainC,#logC,.infoImageT").hide();
		$("#infoCharsC").show().promise().done(function(  ) {
			$('#infoCharsC').scrollTop(0);
			css_adaptP() 
		});
	})
	$('#infoMain').on('click',function(e){e.preventDefault();
		
		$('#explainH a, #logshow').removeClass("onB").removeClass("onA")
		$(this).addClass("onA")
		$("#infoCharsC,#logC").hide()
		$("#infoMainC,.infoImageT").show().promise().done(function(  ) {
			$('#infoMainC').scrollTop(0);
			css_adaptP()
		});
		
	})
	$('#logshow').on('click',function(e){e.preventDefault();		
		$('#explainH a').removeClass("onA").removeClass("onB")
		$(this).addClass("onB")
		$("#infoMainC,#infoCharsC,.infoImageT").hide();
		$("#logC").show().promise().done(function(  ) {
			$('#log').scrollTop(0);
			css_adaptP() 
			
			if (!$("#explainClose").hasClass("ftime")){
				transmit({cmd:"getExchanges",idm:G["idm"],gameId:G["gameId"]})
			}
			
		});
	})	
	
	var animateInforImg=function (){
		$(".infoImageT img").animate({marginLeft: "-10%"}, 3000)
		window.setTimeout(function() { 
			$(".infoImageT img").animate({marginLeft: "0px"}, 3000)
			window.setTimeout(function() {animateInforImg() }, 5000)
		}, 6000) 
	}
	animateInforImg();	
	
	/////////////////	
	
	
	$(document).on('keyup',function(evt) {	//27 esc 38 up 37 lfet 39 right 13 return
		//debug.text(evt.keyCode)
		if ( !$("#loadingGym").length) {
			if (evt.keyCode == 27) {				
					showInfo(false);
					showChoiceOpt(false)				
			}
			if (evt.keyCode == 38) showChoiceOpt(true);
			if (evt.keyCode == 40) showChoiceOpt(false)
			if (evt.keyCode == 37) $( "#prev" ).click();
			if (evt.keyCode == 39) $( "#next" ).click();

		}

	});
	//////////////////////////////////////////////////////////////////////////////////////// RUN	
	
	css_adaptP()
	
//	$(window).load(function(){		})
	$(window).bind('orientationchange',function(event){css_adaptP()}) 
	$(window).bind('resize',function(event){css_adaptP()})
	$(window).load(function () {	

		css_adaptP();
		loadStep(0)
		showInfo(true)
		//$("body:after").hide();

	})/////////////////////////////////////////////////////////////////////////////////////// RUN

	
	
})	