$(document).ready( function(){
	$("#divLoginBackground").click( function( event ){
		$("#divLoginBackground").fadeOut();
		$("#divLoginForm").fadeOut();
	});
	$("div#divLoginForm").click( function( event ){
		event.stopPropagation();
	});
});
function onShowLoginForm( ){
	$("div#divLoginBackground").fadeIn();
	$("div#divLoginForm").fadeIn();
}
function onLogOut( ){
	$.ajax({
        url: "async-logOut.php",
        dataType : "json",
        type : "POST",
        data : { },
        success : function(data){
            if(data.result == "success"){
            	window.location.reload( );
            }
        }
    });		
}