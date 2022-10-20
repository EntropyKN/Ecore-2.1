$(function() {
	
$('#status').on('change', function (e) {
    if (confirm('Are you sure you want to change status to '+$(this).val()+"?" )) {
		//if ($D["cmd"]!="setPlayable" && $D["cmd"]!="copy" && $D["cmd"]!="setoff" && $D["cmd"]!="delete") 
		if ($(this).val()=="Playable") var cmd="setPlayable"
		if ($(this).val()=="Offline") var cmd="setoff"
		if ($(this).val()=="Deleted") var cmd="delete"
		idg=$("#core").attr("data-gameId");
		$("#mask").show()
		
		$.ajax({
			type: "POST", url: CD+"/_m/ajax.gameHandler.php"
			,data: {idg:idg,cmd: cmd} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				//alert (php_answer)
				resp=php_answer.split("|-|")
				if (resp[0]=="true") {
						location.reload()
				}else{
					alert ("little error :-(")
				}
				$("#mask").hide()
			},
				error: function(php_answer){
					alert ("little error code:AJ :-("+CD+"/_m/ajax.gameHandler.php"			);$("#mask").hide()
				}
			
		})
    }
});

$('#createcopy').on('click', function (e) {

	if ($(this).attr("id")=="createcopyDONE" ) return;
	e.preventDefault();
    if (confirm('Are you sure you want to create a copy in Drafts?')) {
		idg=$("#core").attr("data-gameId");
		
		$("#mask").show()
		
		$.ajax({
			type: "POST", url: CD+"/_m/ajax.gameHandler.php"
			,data: {idg:idg,cmd: "copy"} //
			,cache: false,dataType: 'html',
			success: function(php_answer){
				resp=php_answer.split("|-|")
				//alert(php_answer);
				if (resp[0]=="true") {
					$("#createcopy").html("New Copy Created").attr("id", "createcopyDONE").attr("href", "/?/game/"+resp[1])
				}else{
					alert ("little error :-(")
				}
				
				$("#mask").hide()
			}
		})
		
    }
});	

})