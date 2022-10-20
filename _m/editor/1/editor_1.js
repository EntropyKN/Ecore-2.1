
$(function() {
	var $steps=$("#core").attr("data-steps")
	
	var $grandMax=0;
	var $grandMin=0;
	$("#mask").show()

	var loadStep=function (d)	{
		
		$( "#stepTit span:nth-child(1)" ).text(d["step"]).show();
		
		//if (D["forkFrom"]>0 &&  d["step"]>=(D["forkFrom"]+1) && 	d["step"]<=D["steps"]	) $( "#stepTit span:nth-child(2)" ).text(d["scene"]).show();
		//else $( "#stepTit span:nth-child(2)" ).hide();
		if (D["forkFrom"]>0) $( "#stepTit span:nth-child(2)" ).text(d["scene"]).show();
		else $( "#stepTit span:nth-child(2)" ).hide();		
		
		//alert (d["step"]+"  "+d["scene"])
		
		$("#stepTitEnding").hide();
		$("#stepTit").show();
		/// finali
		if (d["type"]=="winning") {
			$("#stepTit").hide();
			$("#stepTitEnding").text(L_winning_end).show()
			$( "#stepTit span:nth-child(2)" ).text("A");
		}
		if (d["type"]=="loosing") {
			$("#stepTit").hide();
			$("#stepTitEnding").text(L_loosing_end).show()
			$( "#stepTit span:nth-child(2)" ).text("A");
		}
		if (d["type"]) $("#noFinalBlock").hide(); else $("#noFinalBlock").show();
		
		
		scenario_id=d["scenario_id"];if (!scenario_id) scenario_id=0;
		$("#scenario_id").val(scenario_id);$(".sceneimg").attr("src", "data/scenarios/"+scenario_id+"_640.jpg")

		avatar_id=d["avatar_id"];if (!avatar_id) avatar_id=0;
		$("#avatar_id").val(avatar_id);
		currentAvatarId=$("#avatarSprite").attr("data-currentAvatar");		
		$("#avatarSprite").attr("class", 		$("#avatarSprite").attr("class").replace("avatar_"+currentAvatarId, "avatar_"+avatar_id)			).attr("data-currentAvatar", avatar_id);					
		if (d["avatar_id"]==1000){
			$("#avatarSprite,#rightArrow,#leftArrow,#avatarDims").hide()
			$("#avatar_sentence_title span").text(L_sentence)
		}else{
			$("#avatarSprite,#leftArrow,#avatarDims").show()
			$("#avatar_sentence_title span").text(L_avatar_sentence)
		}
		
		
		///
		avatar_sizeC="as_S";avatar_size="S";
		if (d["avatar_size"]) avatar_sizeC="as_"+d["avatar_size"];
		avatar_dims_change(avatar_sizeC)
		
		// default: left: 264px;top: 3px;
		avatar_posC="264,3";if (d["avatar_pos"]) avatar_posC=d["avatar_pos"];
		posA=avatar_posC.split(",")
		$("#avatarSprite").attr("data-pos", posA[0] +","+ posA[1] ).attr("style", "left: "+posA[0]+"px;top: "+posA[1]+"px;" )  //css({ top: posA[0], left: posA[1] });

		// balloon
		$("#avatar_sentence").val(d["avatar_sentence"])
		if (d["avatar_sentence"]) $("#balloon span").html(adaptTex2Balloon(d["avatar_sentence"]))
		else $("#balloon span").html("")
		balloon_pos="157,31";if (d["balloon_pos"]) balloon_pos=d["balloon_pos"];
		posB=balloon_pos.split(",")
		$("#balloon").attr("data-pos", posB[0] +","+ posB[1] ).attr("style", "left: "+posB[0]+"px;top: "+posB[1]+"px;" ) 

		// balloon
		arrowY="11";if (d["arrowY"]) arrowY=d["arrowY"];
		$("#leftArrow").attr("data-top", arrowY ).attr("style", "right: -17px;top: "+arrowY+"px;" ) 
		$("#rightArrow").attr("data-top", arrowY ).attr("style", "left: -17px;top: "+arrowY+"px;" ) 
		if (d["avatar_id"]!=1000){
			if (d["arrowPos"]=="right") {$("#rightArrow").show();$("#leftArrow").hide();}
			else	{$("#rightArrow").hide();$("#leftArrow").show();}
		}
		
		// answers

		for (var i = 1; i <= 4; i++) {
			$("#answer_"+i).val(d["answer_"+i])
			if (d["ascore_"+i] == null)  d["ascore_"+i]="na"
			$("#ascore_"+i).val(d["ascore_"+i]);
			if (i>3) {
				if (d["ascore_"+i]!="na"		|| d["answer_"+i]!=null)  {
					$("#ascore_v_"+i).show();	$("#addAnswer_"+i).hide();	
				}else{
					$("#ascore_v_"+i).hide();	$("#addAnswer_"+i).show();	
				}
			}
			nextR=parseInt(d["step"])+1;

			$("#goto_"+i+"_A").text(		nextR	+"/"+D["steps"]+"A") //attr("value",	nextR+"_A").
			$("#goto_"+i+"_B").text(		nextR+"/"+D["steps"]+"B")
			$("#goto"+i).val(d["goto"+i])

	//	alert (d["goto"+i]);
		}
		
		if (D["structure"]!="linear" && D["forkFrom"]>0 &&  d["step"]==D["forkFrom"] 	) {	 //&& 	d["step"]<D["steps"]
			$(".textarea_answ").addClass("textarea_answTight")
			$(".goto,.subtitleR1").show();
		}else{
			$(".textarea_answ").removeClass("textarea_answTight")
			$(".goto,.subtitleR1").hide();
		}
		
		// audio
		$("#generateGroup,#audioControls").hide();$("#audioCmd").show()
		if (d["avatar_audio"]) {
			$("#auimgplay1").show()
			$("#auimgpause1").hide()
			$("#audioControls").show()
			$("#auimgplay1") .attr("data-file","data/audio/"+d["avatar_audio"])	
			$("#player").attr("src", "data/audio/"+d["avatar_audio"])
		}
		
		
		//attachment
		attachNumber=0
		$(".attachments_L").hide();
		for (var atr= 0; atr < 5;atr++) { // reset			
			atr1=atr+1;
			$("#href_att_"+atr1 ).attr("href",  "#");	
			$("#href_att_"+atr1+" .attImg" ).attr("src",  '');	
			$("#attTitle_"+atr1 ).val("").attr("data-ida","0")
			$("#attDelete_"+atr1 ).attr("data-ida",  "0")
		}		
					
		for (var at= 0; at < d["attachment"].length;at++) {
			
			attachNumber=at+1;

			$atc=d["attachment"][at]
			$("#href_att_"+attachNumber ).attr("href",  $atc["path"]);	
			$("#href_att_"+attachNumber+" .attImg" ).attr("src",  'img/ico/'+$atc["type"]+'60.png');	
			$("#attTitle_"+attachNumber ).val($atc["title"]).attr("data-ida",$atc["idAttachment"])
			$("#attDelete_"+attachNumber ).attr("data-ida",  $atc["idAttachment"])
			$("#attachments_L_"+attachNumber).show();
		}
		if (attachNumber) $("#compulsoryAttachmentsBox").show(); else $("#compulsoryAttachmentsBox").hide();
		if (attachNumber==5) $("#attachmentLine").hide();else $("#attachmentLine").show()

		
		if (d["compulsoryAttachments"]=="0") {			
			$("#compulsoryAttachmentsMsg").text(L_COMPULSORY_ATTACHMENTS_NO)
		}else {
			$("#compulsoryAttachmentsMsg").text(L_COMPULSORY_ATTACHMENTS_YES)
		}
		$("#compulsoryAttachmentsBox").attr("data-compulsoryAttachments",d["ompulsoryAttachments"])		

		//alert(d["game"]["L4_comment"]+" "+D["gameId"])
		var commentA = ["L1", "L2", "L3", "L4", "W1", "W2", "W3", "W4"];
		for (cc = 0; cc < commentA.length; ++cc) {
			curComm=d["game"][		commentA[cc] +"_comment"		] 	;
			//alert ("#cmtarea_fc_"+commentA[cc]+" "+		curComm					)
			$("#cmtarea_fc_"+commentA[cc]).val(		curComm		)
			if ( curComm) {
				$("#cmt_"+commentA[cc]).addClass("cmton")
				$("#faketxt_fc_"+commentA[cc]).hide()
			}else{
				$("#cmt_"+commentA[cc]).removeClass("cmton")
				$("#faketxt_fc_"+commentA[cc]).show()
			}
		
			$("#upContainerL").css({'height':$("#upContainerR").height()+'px'})	
			//scoreCalc();
		
		}
		
		

	}
	
	var save=function (what, val, table, whereId)	{
		
		if (!what) return;
		
		if (!table) table="";
		if (!whereId) whereId="";
		scene= ($( "#stepTit span:nth-child(2)" ).text());
		//alert (what)
		$("#saving").show()
		$.ajax({
			type: "POST", url: CD+"/_m/editor/1/ajax.save.php"
			,data: {gameId:D["gameId"], step:$( "#stepTit span:nth-child(1)" ).text(), scene:scene,what:what, val:val, table:table,whereId:whereId } 
			,cache: false,dataType: 'html',
			success: function(php_answer){
				//alert(php_answer)
				$("#debug").html(php_answer)
				$("#saving").hide()
				whatA=what.split("_");if (whatA[0]=="ascore"	|| whatA[0]=="answer") scoreCalc();
			}
		})	
	}

	var scoreCalc=function ()	{
		$.ajax({
			type: "POST", url: CD+"/_m/editor/1/ajax.scorecheck.php"
			,data: {gameId:D["gameId"] } 
			,cache: false,dataType: 'html',
			success: function(php_answer){
				$("#debug").html(php_answer)
				r=php_answer.split("|-|")
				if (r[0]=="false") {
					
					$("#fgraph, #missingmsg").hide();
					$("#fgraphNotAvailable span").text(r[1]);
					$("#fgraphNotAvailable").show();
				}else{
					$("#fgraph,#missingmsg").show();
					$("#fgraphNotAvailable").hide();
					// values!
//					alert (r[1])
					var SC=$.parseJSON(r[1])
					$("#gLegend100 .subGlegend span").text(SC.W4.spreadR )
					$("#gLegend50 .subGlegend span").text(SC.L4.spreadR )
					$("#gLegend0 .subGlegend span").text(SC.L1.spreadL)
/*					$.each(SC.W4, function(i2, v) {
						(i2+" "+v);
					});*/
//					alert (SC.W4.spreadR )

				}
			}
		})	
	}	
	
	//avatarSprite
	$( "#avatarSprite" ).draggable({
       // containment: "#upContainerR",
        scroll: false,
        drag: function() {

            var $this = $(this);
            var thisPos = $this.position();
            var parentPos = $this.parent().position();
			$("#debug").text(thisPos.left + ", " + thisPos.top);
			$("#avatarSprite").attr("data-pos", thisPos.left +","+ thisPos.top );		
			
			 var ballpos = $("#balloon").position();
			$("#debug").text (thisPos.left+" "+ballpos.left)
			if (thisPos.left>ballpos.left) {
				$("#rightArrow").hide();$("#leftArrow").show();
				save ("arrowPos ","left"	)
			}else{
				$("#rightArrow").show();$("#leftArrow").hide();
				save ("arrowPos ","right"	)
			}
		

        },
        revert: function() {
			save ("avatar_pos ", $("#avatarSprite").attr("data-pos")		)				

        }

})	

	//balloon
	$( "#balloon" ).draggable({
        containment: "#fakePlayer",
        scroll: false,
        drag: function() {
            var $this = $(this);
            var thisPos = $this.position();

	//		$("#debug").text(thisPos.left + ", " + thisPos.top);
			$("#balloon").attr("data-pos", thisPos.left +","+ thisPos.top );		
        },
        revert: function() {
			save ("balloon_pos ", $("#balloon").attr("data-pos")		)
			 var avatarSpritePos = $("#avatarSprite").position();
			  var thisPos = $(this).position();
			$("#debug").text (thisPos.left+" "+avatarSpritePos.left)
			//alert (d["scenario_id"])
			if ($("avatar_id").val()==1000){			
				if (avatarSpritePos.left>thisPos.left) {
					$("#rightArrow").hide();$("#leftArrow").show();
					save ("arrowPos ","left"	)
				}else{
					$("#rightArrow").show();$("#leftArrow").hide();
					save ("arrowPos ","right"	)
				}			
			}
			
        }

})	

	$( "#leftArrow,#rightArrow" ).draggable(
	{ axis: "y" },
	{
        containment: "#balloon",
		
        scroll: false,
        drag: function() {
            var $this = $(this);
            var thisPos = $this.position();
			$("#debug").text(thisPos.left + ", " + thisPos.top);
			$("#leftArrow,#rightArrow").attr("data-top", thisPos.top );
        },
        revert: function() {
			var $this = $(this);var thisPos = $this.position();
			if ($this.attr("id")=="rightArrow") 	{
				$("#leftArrow").attr("data-top", thisPos.top ).attr("style", "right: -17px;top: "+thisPos.top+"px;" ).hide() 
				$("#rightArrow").show()
			}
			if ($this.attr("id")=="leftArrow")		{
				$("#rightArrow").attr("data-top", thisPos.top ).attr("style", "left: -17px;top: "+thisPos.top+"px;" ).hide()	
				$("#leftArrow").show()
			}
			save ("arrowY ", thisPos.top		)
        }

})	



	
	$(".upContainerBox").on("click", function(e) {e.preventDefault()
		//responsiveVoice.speak("Ciao Bello", "Italian Female", {});	//		https://code.responsivevoice.org/getvoice.php?t=miao%20ciao&tl=it&sv=g1&vn=&pitch=0.5&rate=0.5&vol=1&gender=female			pitch: 2	https://responsivevoice.org/text-to-speech-languages/
		step=this.id.replace("stepM_", "")
		dataA=this.id.split("_");
		step=dataA[1];scene=dataA[2]
		//alert (step+" "+scene)
		var id=this.id;
		$("#mask").show()
		$("#editingAdvice").hide();
		$.ajax({
			type: "POST", url: CD+"/_m/editor/1/ajax.getStep.php"
			,data: {gameId:D["gameId"], step:step, scene:scene, action:"getStep"} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				r=php_answer.split("|-|")
				$("#debug").html(php_answer)
				$("#mask").hide()
				$("#"+id). prepend( 		$("#editingAdvice")		);
				$("#editingAdvice").show();
				//alert ($.parseJSON(r[1]));
				//var dataStep = $.parseJSON(r[1]);
				loadStep($.parseJSON(r[1]))
				

			}
		})			

	})		
	var adaptTex2Balloon=function (t)	{
		t=t.trim()
		t=t.replace(/\n/g,"<br />");//nl2br
		
		return t
	}



	$("#scenario_id").on("change", function() {
		scenario_id_send=$(this).val();
		$("#fakePlayer .sceneimg").attr("src","data/scenarios/"+scenario_id_send+"_640.jpg" ).removeClass("isScenario")		
		stepCurrent=$( "#stepTit span:nth-child(1)" ).text();
		sceneCurrent=$( "#stepTit span:nth-child(2)" ).text();

		$("#stepM_"+stepCurrent+"_"+sceneCurrent+" .upContainerBoxImg").attr("src", "data/scenarios/"+scenario_id_send+"_640.jpg")
		if (stepCurrent==$("#loosing").attr("data-step")) $("#boxScenarioLose").attr("src", "data/scenarios/"+scenario_id_send+"_640.jpg").addClass("isScenario")
		if (stepCurrent==$("#winning").attr("data-step")) $("#boxScenarioWin").attr("src", "data/scenarios/"+scenario_id_send+"_640.jpg").addClass("isScenario")
		save ("scenario_id", scenario_id_send)
		
	})	
	$("#avatar_id").on("change", function() {
		avatar_id_send=$(this).val();
		currentClass=$("#avatarSprite").attr("class");
		currentAvatarId=$("#avatarSprite").attr("data-currentAvatar");
		$("#avatarSprite").attr("class", 		currentClass.replace("avatar_"+currentAvatarId, "avatar_"+avatar_id_send)			)
		$("#avatarSprite").attr("data-currentAvatar", avatar_id_send);	
		if ($(this).val()==1000){
			$("#avatarSprite,#rightArrow,#leftArrow,#avatarDims").hide()
			$("#avatar_sentence_title span").text(L_sentence)
		}else{
			$("#avatarSprite,#leftArrow,#avatarDims").show()
			$("#avatar_sentence_title span").text(L_avatar_sentence)
		}
		save ("avatar_id", avatar_id_send)	
	})	

	var avatar_dims_change=function (av_size)	{ // as_S
		if (!av_size) return;
		
		$("#avatarDims a").removeClass("don")
		currentSize=$("#avatarSprite").attr("data-currentSize");
		currentClass=$("#avatarSprite").attr("class");
		$("#"+av_size).addClass("don")
		size=av_size.replace("as_","")
		$("#avatarSprite").attr("class", 		currentClass.replace("wait_"+currentSize, "wait_"+size)			)
		$("#avatarSprite").attr("data-currentSize", size);		
		

	}

	
	$("#avatarDims").on("click",'a', function(e) {e.preventDefault()
		avatar_dims_change(this.id)
		$(this).blur()
		size=this.id.replace("as_","")
		save ("avatar_size", size)	
	})		
	var writeDB=null;
	$("#avatar_sentence").on("keyup change", function(e) {
		if ($(this).val().length>=800) alert ("There's a limit of 800 digits for this area");
		$("#balloon span").html(adaptTex2Balloon($(this).val()))
			clearTimeout(writeDB);
			writeDB = setTimeout(function(){ 
				save ("avatar_sentence", $("#avatar_sentence").val())
			}, 1000);		
	})		
	
	$(".textarea_answ").on("keyup change", function(e) {
			if ($(this).val().length>=255) alert ("There's a limit of 255 digits for this area");
		
			id=this.id; v=$(this).val();
			clearTimeout(writeDB);
			writeDB = setTimeout(function(){ 
				save (id, v)
			
			}, 500);	
	})	


	$(".addAnswer").on("click", function(e) {e.preventDefault()
			
			$("#"+this.id.replace("addAnswer_","ascore_v_")).show();
			$(this).hide();
	})		

	
	$(".ascore").on("change", function(e) {
			save (this.id, $(this).val())
			scoreCalc();
	})	
	
		$(".goto").on("change", function(e) {
			save (this.id, $(this).val())
	})	
	
	
	//########### audio
	$("#generateAudio").on("click", function(e) {e.preventDefault()
		pausa("auimgplay1")
		$("#generateGroup").show()
		$("#audioControls").hide()
		$("#audioCmd").hide()
	})	
	$("#generateGo").on("click", function(e) {e.preventDefault()
		$("#avatar_sentence").val($("#avatar_sentence").val().trim())	
		text=$("#avatar_sentence").val().trim()
		if (!text) {
			$("#avatar_sentence").focus();		
			$("#digit").fadeIn().fadeOut("50000");
			return;
		}
		
		step=$( "#stepTit span:nth-child(1)" ).text()
		scene=$( "#stepTit span:nth-child(2)" ).text()
		$("#loadingAudio").show();
		$.ajax({
			type: "GET", url: CD+"/_m/editor/1/ajax.synth.php"
			,data: {text:text,gameId:D["gameId"], step:step, scene:scene,voice:$("#voice").val()} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				r=php_answer.split("|-|")
				$("#debug").html(php_answer)
				$("#loadingAudio").hide();
				$("#generateGroup").hide()
				$("#audioCmd,#audioControls").show()				
				$("#auimgplay1") .attr("data-file",r[1])			
				save ("avatar_audio", r[1].replace("data/audio/",""))
				if (r[0]=="true") {
					//alert (resp[1])
				//	window.location.href = "/?/_msg/savedPlayable/"+resp[1]+""
				}else{

				}

			}
		})	
	})	
	
	
	
	$(".audioLoad").on("change", function() {
			pausa("auimgplay1")
		$("#loadingAudio").show();
		$imgId=this.id.replace("au","auimg")
		
		var file_data = $(this).prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data)
		//gameId:D["gameId"], state:state
		form_data.append('gameId', D["gameId"])
		form_data.append('step', step=$( "#stepTit span:nth-child(1)" ).text())
		form_data.append('scene', step=$( "#stepTit span:nth-child(2)" ).text())
		form_data.append('id', $("#audioLine").attr("data-id"))                 
	    $.ajax({
                url: CD+"/_m/editor/1/ajax.audio.php",
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(resp){
					//asdassingleMask(false)
					
					r=resp.split("|-|")
                    //$("#debug").html(resp)
					$("#loadingAudio").hide();
					$("#audioCmd, #audioControls").show()	
					$("#auimgplay1") .attr("data-file",r[1])	
					//alert (r[1])
					save ("avatar_audio", r[1].replace("data/audio/",""))
					
					if (r[0]=="true"){
						/*
						$("#"+$imgId).attr("src", "/img/ico/audio16on.png?ss").attr("title", 		$("#"+$imgId).attr("data-titlebis")		)
						
						$("#"+$imgId.replace("auimg","auimgplay"))
							.attr("data-file",r[1])
							.show()
							$("#audioLine").attr("data-edit",1)
							
							*/
	//					var fileName = "data/audio/besame.mp3?"+Math.random()
	//					$("#player").attr("src", fileName).trigger("play");
					}else{
						//alert (r[1])
					}
					//singleMask(false)
					$("#mask").hide()
                }
				, error: function(resp){ alert("errore"+resp) }
				
				
    	});
	});
	
		
		$("#audioDelete").on("click", function(e) {e.preventDefault()
			pausa("auimgplay1")
		
			step=$( "#stepTit span:nth-child(1)" ).text()
			scene=$( "#stepTit span:nth-child(2)" ).text()
			$.ajax({
				type: "POST", url: CD+"/_m/editor/1/ajax.audio.php"
				,data: {gameId:D["gameId"], step:step, scene:scene,cmd:'delete'} //
				,cache: false,dataType: 'html',
				success: function(php_answer){
					r=php_answer.split("|-|")
					//$("#debug").html(php_answer)
					$("#audioControls").hide()
					save ("avatar_audio", null)
				}
			});
		});
		
	// audio play
	var suona=function (ID){
		if (!ID) ID="auimgplay1"

		$(".audioPause").hide()
		$nowplayingid=parseInt($("#audioLine").attr("data-playing"))
		if ($nowplayingid) $("#auimgplay"+$nowplayingid).show()
		var $playId=ID
		$pauseId=$playId.replace("auimgplay","auimgpause")
		$("#audioLine").attr("data-playing",$pauseId.replace("auimgpause","") )
		
		$("#"+$playId).hide();$('#'+$pauseId).attr("data-file", $('#'+$playId).attr("data-file") ).show()
		fileName = ""+$('#'+$playId).attr("data-file")+"?"+Math.random()
		$("#player").attr("src", fileName).trigger("play")
		.on('ended',function(){
	      $('#'+$playId).show();$('#'+$pauseId).hide()
    	})		
	}
	var pausa=function (ID){
		if (!ID) ID="auimgpause1"
		
		$("#audioLine").attr("data-playing",0)
		$playId=ID.replace("auimgpause","auimgplay")
		$("#"+ID).hide();$('#'+$playId).show()
		fileName = "data/audio/"+$("#"+ID).attr("data-file")+"?"+Math.random()
		$("#player").attr("src", fileName).trigger("pause")
	}
	var audioReset=function(){
		$nowplayingid=parseInt($("#audioLine").attr("data-playing"))
		if ($nowplayingid) pausa("auimgpause"+$nowplayingid)
	}
	$(".audioPlay").on("click", function() {
		suona(this.id)
	})
	$(".audioPause").on("click", function() {
		pausa(this.id)
	})


	// upload
	$(".audioLoadFake").on("click", function(e) {e.preventDefault()
		idd=$(this).attr("data-d")
		$("#"+idd).click()
	})	


	// attachments
	
	$(".attTitle").on("keyup change", function(e) {
		var $idAttachment=$(this).attr("data-ida");
		
		if (!$idAttachment) return;
			var text=$(this).val()
			clearTimeout(writeDB);
			writeDB = setTimeout(function(){ 
				save ("title", text, "attachments", $idAttachment)
				//  (what, val, table, whereId)	
			}, 1000);


	})		
	
	$("#file").on("click", function(e) {e.preventDefault()
		$("#attachmentInput").click()
	})	

	$("#attachmentInput").on("change", function() {
		$("#mask").show()
		var file_data = $(this).prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data)
		//gameId:D["gameId"], state:state
		form_data.append('gameId', D["gameId"])
		form_data.append('step', step=$( "#stepTit span:nth-child(1)" ).text())
		form_data.append('scene', step=$( "#stepTit span:nth-child(2)" ).text())
		
		
		               
	    $.ajax({
                url: CD+"/_m/editor/1/ajax.attach.php",
                dataType: 'text',  
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function(resp){
					//asdassingleMask(false)
					
					r=resp.split("|-|")
                    $("#debug").html(resp)
					$("#mask").hide()
					if (r[0]=="true") {
						attachNumber=0;
						for (var an = 1; an <= 5; an++) {
							if (	$("#attDelete_"+an ).attr("data-ida")=="0" ){
								attachNumber=an
								break
							}
						}
						if (attachNumber) {				
							$("#attachments_L_"+attachNumber ).show();
							$("#href_att_"+attachNumber ).attr("href", r[3]);
							$("#href_att_"+attachNumber+" .attImg" ).attr("src",  'img/ico/'+r[4]+'60.png');							
							$("#attTitle_"+attachNumber ).val(r[2]).attr("data-ida",  r[1]).focus()
							$("#attDelete_"+attachNumber ).attr("data-ida",  r[1])
						}
						
						if (attachNumber=="5") $("#attachmentLine").hide(); else $("#attachmentLine").show()
						if (attachNumber=="0") $("#compulsoryAttachmentsBox").hide(); else $("#compulsoryAttachmentsBox").show()
						$("#upContainerL").css({'height':$("#upContainerR").height()+'px'})
						//alert (attachNumber)
					}else{
						alert ("attach"+r[1])
					}
                }	
    	});
	});

		$(".attDelete").on("click", function(e) {e.preventDefault()
			var $idAttachment=$(this).attr("data-ida");
			if (!$idAttachment) return;
			var attachNumber=this.id.replace("attDelete_", "")
			var path=$("#href_att_"+attachNumber).attr("href")
			$.ajax({
				type: "POST", url: CD+"/_m/editor/1/ajax.attach.php"
				,data: {gameId:D["gameId"], step:step, cmd:'delete', idAttachment:$idAttachment, path:path} //
				,cache: false,dataType: 'html',
				success: function(resp){
					$("#attachments_L_"+attachNumber ).hide();
					$("#href_att_"+attachNumber ).attr("href", "");
										
					$("#attTitle_"+attachNumber ).val("").attr("data-ida",  "0")
					$("#attDelete_"+attachNumber ).attr("data-ida", "0")
					$("#attachmentLine").show()
					
						attachNumberC=0;
						for (var an = 1; an <= 5; an++) {
							if (	$("#attDelete_"+an ).attr("data-ida")!="0" ){
								attachNumberC=attachNumberC+1;
								break
							}
						}

						if (attachNumberC=="0") $("#compulsoryAttachmentsBox").hide(); else $("#compulsoryAttachmentsBox").show()
						$("#upContainerL").css({'height':$("#upContainerR").height()+'px'})
					
					 
				}
			});
		})	

		$("#link").on("click", function(e) {e.preventDefault()
			url=$("#url").val().trim()
			if (!url) {$("#url").focus(); return;}
			step=$( "#stepTit span:nth-child(1)" ).text()
			scene=$( "#stepTit span:nth-child(2)" ).text()
			
			$("#mask,#spinLoad").show()

			
			$.ajax({
				type: "POST", url: CD+"/_m/editor/1/ajax.attach.php"
				,data: {gameId:D["gameId"], step:step,scene:scene, url:url, cmd:'url'} //
				,cache: false,dataType: 'html',
				success: function(php_answer){
					r=php_answer.split("|-|")
					if (r[0]=="true") {
						attachNumber=0;
						for (var an = 1; an <= 5; an++) {
							if (	$("#attDelete_"+an ).attr("data-ida")=="0" ){
								attachNumber=an
								break
							}
						}
						//alert ("scusate sto aggiustando una cosa, ma potete continuare tranquillamente: "+attachNumber)
						if (attachNumber) {
							//true|-|38|-|√ Rockol - la musica online è qui - Novità Musicali|-|link|-|				
							$("#attachments_L_"+attachNumber ).show();
							$("#href_att_"+attachNumber ).attr("href", r[3]);
							$("#href_att_"+attachNumber+" .attImg" ).attr("src",  'img/ico/'+r[4]+'60.png');							
							$("#attTitle_"+attachNumber ).val(r[2]).attr("data-ida",  r[1]).focus()
							$("#attDelete_"+attachNumber ).attr("data-ida",  r[1])
							$("#url").val("");
						}
						if (attachNumber=="5") $("#attachmentLine").hide(); else $("#attachmentLine").show()
						$("#upContainerL").css({'height':$("#upContainerR").height()+'px'})
						if (attachNumber=="0") $("#compulsoryAttachmentsBox").hide(); else $("#compulsoryAttachmentsBox").show()
						
					}else{
						//alert(r[1])
						alert ("1 attach"+r[1])
					}
					$("#debug").html(php_answer)
					$("#mask,#spinLoad").hide()
				}
			})		
			/*$.ajax({
				type: "POST", url: CD+"/_m/editor/1/ajax.attach.php"
				,data: {gameId:D["gameId"], step:step, cmd:'delete', idAttachment:$idAttachment, path:path} //
				,cache: false,dataType: 'html',
				success: function(resp){
					$("#attachments_L_"+attachNumber ).hide();
					$("#href_att_"+attachNumber ).attr("href", "");
										
					$("#attTitle_"+attachNumber ).val("").attr("data-ida",  "0")
					$("#attDelete_"+attachNumber ).attr("data-ida", "0")
					$("#attachmentLine").show()
					 
				}
			})
			*/;
		})			
		
		
	//#######################  	compulsoryAttachments
		
	$("#compulsoryAttachmentsChange").on("click", function(e) {e.preventDefault()
		var compulsoryAttachmentsCurrent=$("#compulsoryAttachmentsBox").attr("data-compulsoryAttachments");

		
		if (compulsoryAttachmentsCurrent==0) {
			compulsoryAttachments=1
			
			$("#compulsoryAttachmentsMsg").text(L_COMPULSORY_ATTACHMENTS_YES)
		}else {
			compulsoryAttachments=0
			$("#compulsoryAttachmentsMsg").text(L_COMPULSORY_ATTACHMENTS_NO)
		}
		$("#compulsoryAttachmentsBox").attr("data-compulsoryAttachments",compulsoryAttachments)
		save ("compulsoryAttachments", compulsoryAttachments)	
		
	})	



	// missing
	var restoreMissing=function(){
		$("#missingList").html("").hide()
		$("#okmsg,#playerSimLilnk").hide() //#rangeGraph,#positiveForm,#negativeForm,#rangeGraph,#rangeGraph200,#rangeGraph200T,.simLink
		
		$("#missingmsg").show()
	}
	$("#core").on("keyup change", "input, textarea, select", function(e) {restoreMissing()})
		.on("click", "a,#audioDelete,.upContainerBox", function(e) {restoreMissing()})	
	
	$("#checkmissing").on("click", function(e) {e.preventDefault()
		$("#mask").show()
		$.ajax({
			type: "POST", url: CD+"/_m/editor/1/ajax.missing.php"
			,data: {gameId:D["gameId"]} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				resp=php_answer.split("|-|")
				$("#debug").html(php_answer)
				if (resp[0]=="false"){
					$("#missingList").html(resp[1]).show()
					$("#missingmsg").hide()
				}
				if (resp[0]=="true"){
					//alert ("Tutti i campi sono perfetti!")
					
					$("#missingmsg").hide()
					$("#okmsg,#playerSimLilnk").show()
				}
				
				$("#mask").hide()

			}
		})	
	})	


	var cmtopen=function (id){
		$("#core").attr("data-cmtedit",id);
		$("#cmtareac_"+id).show()
		$("#cmtarea_"+id).focus()		
	}
	$(".cmt").on("click", function(e) {e.preventDefault()
		$(".cmtareac").hide()
		id=this.id.replace("cmt_", "")
		$("#cmtareac_fc_"+id).show();
		$("#cmtarea_fc_"+id).focus();
		return;
/*	
		//restoreMissing()
		idedit=$("#core").attr("data-cmtedit")
		id=this.id.replace("cmt_", "")
		ida=id.split("_")
//		if (ida[0]!="fc") {
			if (id==idedit) return
			if (idedit!="null") {
				cmtsave(idedit, id)
			}else{
				cmtopen(id)
			}
	*/
	})	
	$(".cmtareac").on("keyup change", "textarea",function(e) {
		var id=this.id.replace("cmtarea_", "")
		var idsave=id.replace("fc_", "")
		var v=$(this).val().trim();
		clearTimeout(writeDB);
		writeDB = setTimeout(function(){ 
			save (idsave+"_comment", v,	"comments")
				if ( v) $("#cmt_"+idsave).addClass("cmton")
				if (!v) $("#cmt_"+idsave).removeClass("cmton")			
		}, 600);		

		
		v=$(this).val().trim()
		fake=$("#cmtareac_"+id+" .faketxt")
		if (v=="") {fake.show()}else{fake.hide()}
		
	}).on("blur",'textarea', function(e) { ///  
		target=this.id.replace("cmtarea_fc_", "cmtareac_fc_");		
		$("#"+target).hide();
	})
	
	$(".faketxt").on("click",function(e) {
		target=this.id.replace("faketxt_fc_", "cmtarea_fc_");
		$("#"+target).focus();
	})
	$(".boxQuarterL,.boxQuarterW").on("click",function(e) {
		$("#cmt_"+this.id).click();
	})	
	
	
	$("#boxScenarioLose").on("click",function(e) {e.preventDefault()
		$(".loosingStep").click();$("html, body").animate({ scrollTop: 0 }, "slow");
	})
	$("#boxScenarioWin").on("click",function(e) {e.preventDefault()
		$(".winningStep").click();$("html, body").animate({ scrollTop: 0 }, "slow");
	})

	$("#upContainerR").on("click",function(e) {
		$("#upContainerL").css({'height':$("#upContainerR").height()+'px'})
	})	
	

	$("#okmsg").on("click", function(e) {e.preventDefault()
		$("#mask").show()
		$.ajax({
			type: "POST", url: CD+"/_m/ajax.gameHandler.php"
			,data: {idg:$("#core").attr("data-gameId"),cmd: "setPlayable"} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				resp=php_answer.split("|-|")
				$("#debug").html(php_answer)
				if (resp[0]=="true") {
					//alert (resp[1])
					window.location.href = "/?/_msg/savedPlayable/"+resp[1]+""
				}else{
					//$("#mask").hide()
				}
				$("#mask").hide()

			}
		})	
	})		
	
	/*.on("blur", "textarea",function(e) {
		id=this.id.replace("cmtarea_", "")
		v=$(this).val().trim()
		$(this).val(v).hide()
			
	})
*/		

	$(".cmtsave").on("click", function(e) {e.preventDefault()
		$(".cmtareac").hide()
	})		
	
	//############### run
	

	$(window).load(function(){
		$("#stepM_1_A").click() 
		scoreCalc(); 
		//alert (		$( "#stepTit span:nth-child(1)" ).text()			) 
		//alert (		$( "#stepTit span:nth-child(2)" ).text()			) 
		
		//$( "ul li:nth-child(2)" )$("#stepTit span").text(),
		
		$("#mask").hide()
	})
	//


})