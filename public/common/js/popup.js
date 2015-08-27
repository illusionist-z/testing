/***************************/
//@Author: Adrian "yEnS" Mato Gondelle
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/


var popupStatus = 0;

function loadPopup(){
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.5"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#myPopup").fadeIn("slow");
		popupStatus = 1;
	}
}
// loadPopup for notification
function loadPopup_box(){
	if(popupStatus==0){
		$("#backgroundPopup").css({
			"opacity": "0.7"
		});
		$("#backgroundPopup").fadeIn("slow");
		$("#myPopup_box").fadeIn("slow");
		popupStatus = 1;
	}
}


function disablePopup(){
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#myPopup").fadeOut("slow");
		$("#myPopup_box").fadeOut("slow");
		popupStatus = 0;
	}
}

//disable popup box for notification
function disablePopup_box(){
	if(popupStatus==1){
		$("#backgroundPopup").fadeOut("slow");
		$("#myPopup_box").fadeOut("slow");
		popupStatus = 0;
	}
}

//centering popup
function centerPopup(){
	
	//request data for centering
	var windowWidth = $(window).width();
	var windowHeight = $(window).height();		
        
	$("#myPopup").css({
		"position": "absolute",
		"top"     : windowHeight/4,
                "left"    : windowWidth/2.5
	});
	$("body").css("overflow","hidden");
	$("#backgroundPopup").css({
		"height": windowHeight
	});
}

//centerpopup for notification
function centerPopup_box(){
	//request data for centering
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = $("#myPopup_box").height();
	var popupWidth = $("#myPopup_box").width();
	

	$("#myPopup_box").css({
		"position": "absolute",
		"top": windowHeight/2-popupHeight/2,
		"left": windowWidth/2-popupWidth/2
	});
	
	$("#backgroundPopup").css({
		"height": windowHeight
	});
}


$(document).ready(function(){
	
	$("#displaypopup").click(function(){            
		//centering with css
		centerPopup();
		//load popup
		loadPopup();
               
	});
	
	$(".notification").click(function(){
	
		//centering with css
		centerPopup_box();
		//load popup
		loadPopup_box();
	});
	
	//CLOSING POPUP
	//Click the x event!
	$("#popupClose").click(function(){
		disablePopup();
	});
	
	//close popup box for notification
	$("#myPopup_box_close").click(function(){
		disablePopup_box();
	});
	
	//Click out event!
	$("#backgroundPopup").click(function(){
		disablePopup();
	});
	//Press Escape event!
	$(document).keydown(function(e){
		if(e.keyCode==27 && popupStatus==1){
			disablePopup();
		}
	});

});