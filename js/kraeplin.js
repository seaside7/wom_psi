jQuery.noConflict();
var tinggi = {};

jQuery( document ).ready(function() { 
	// $(function() {
        // $(this).bind("contextmenu", function(e) {
            // e.preventDefault();
        // });
    // }); 
    // $( "#txtans_1_1" ).focus();


jQuery("#btnstart").click(function(){
	jQuery("#tbSheet").show();
	jQuery("#countdown").show();
	jQuery(".txtansrow"+currentRow).prop('disabled',false);
	jQuery("#txtans_1_1").focus();
	jQuery("#btnstart").hide();
	jQuery("#rules").hide();
	timer.play();
});

jQuery('.txtans').keydown(function(e) {
	var x = jQuery(this).data("x");
	var y = jQuery(this).data("y");
	var prevVal = y-1;
	var nextVal = y+1;
	
   var code = e.keyCode || e.which;
	if (code == '9') {
	   return false;
	}
	else if (code == 39) { // right arrow
	  return false;
 
	} else if (code == 37) { // left arrow
	  return false;

	} else if (code == 40) { // down arrow
	  if(y > 1){
		// jQuery( "#txtans_"+x+"_" + prevVal).focus();
		cursorFocus(jQuery( "#txtans_"+x+"_" + prevVal));
		return false;
	  }

	} else if (code == 38) { // up arrow
	  // jQuery( "#txtans_"+x+"_" + nextVal).focus();
		cursorFocus(jQuery( "#txtans_"+x+"_" + nextVal));
		return false;
	}

});
var currentRow = 1;
var timer = jQuery.timer(function() {
	timer.toggle();
	if(currentRow != 45){
		jQuery.alert('Pindah.',function(){
			jQuery.scrollTo({top:'100%', left:'+=0'}, 800);
			jQuery(".txtansrow"+currentRow).prop('disabled',false);
			currentRow = currentRow + 1;
			jQuery(".txtansrow"+currentRow).prop('disabled',false);
			// $( "#txtans_"+currentRow+"_1" ).focus();
			timer.toggle();
		});
	}
	else
	{	
		jQuery(".txtansrow"+currentRow).prop('disabled',false);
		var serialized = jQuery('#formKraeplin').serialize();
		// console.log(serialized);
		jQuery.alert('Finish.',function(data){
			jQuery.ajax({
            url: "/wom_psi/ajax/kraeplin.php",
	            type: "POST",
	            data: serialized,
	            success: function(data)
	            {
					console.log(data);
					alert("Terima kasih data Anda sudah kami simpan");
					window.location.href = 'index.php?act=papi';
					window.reload();
				
	            }
        	});
		});
		
		/*$.ajax({
			type: "POST",
			url: "/kraeplin/insert.php",
			dataType: 'json',
            data: tinggi,
            contentType: "application/json; charset=utf-8", 
			success: function(data){
				console.log(data);
				alert("sucess");
			},
			error: function(){
				alert("error!!!");
			}
		});*/
	}
	
}, 5000); //30000

});

var cursorFocus = function(elem) {
  var x = window.scrollX, y = window.scrollY;
  elem.focus();
  window.scrollTo(x, y);
}
function scrollright(x){
	 if(x>=20) {jQuery.scrollTo({top:'+=0', left:'+=500px'}, 800);}
	return false;
}

		
function nextText(x, y, val, correct){
	var nextVal = parseInt(y)+1;
	var prevVal = parseInt(y)-1;
	if(jQuery.isNumeric(val))
	{	
			var modtemp = nextVal % 10;
			if(modtemp==0) {jQuery.scrollTo({top:'-=300px', left:'+=0'}, 800);}

		/* jQuery('input').keydown(function (e) {
			
 
		    if (e.which == 39) { // right arrow
		      return false;
		 
		    } else if (e.which == 37) { // left arrow
		      return false;
		 
		    } else if (e.which == 40) { // down arrow
		      if(y > 1){
	      		// jQuery( "#txtans_"+x+"_" + prevVal).focus();
				cursorFocus(jQuery( "#txtans_"+x+"_" + prevVal));
		      }
		 
		    } else if (e.which == 38) { // up arrow
		      // jQuery( "#txtans_"+x+"_" + nextVal).focus();
				cursorFocus(jQuery( "#txtans_"+x+"_" + nextVal));
		    }
	  	}); */

		jQuery("#hdinput_"+x+"_"+y).val(jQuery("#txtans_"+x+"_"+y).val());
		jQuery("#hdtinggi_"+x).val(y);
		if(jQuery("#txtans_"+x+"_"+y).val() != jQuery("#hdans_"+x+"_"+y).val()){
			jQuery("#hdstatus_"+x+"_"+y).val("1");
		}
		else
			jQuery("#hdstatus_"+x+"_"+y).val("0");
		currentRow = x;
			
	}
}

function check(x, y, val){
	if(val.oldvalue != ""){ 
		jQuery("#hdcounter_"+x+"_"+y).val("1");
		nextText(x, y, val, 1);
	}
}
function maxLengthCheck(object) {
   if (object.value.length > object.maxLength)
     object.value = object.value.slice(0, object.maxLength)
}

