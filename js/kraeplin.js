jQuery.noConflict();
var tinggi = {};
 //eval(function(p,a,c,k,e,d){while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+c.toString(a)+'\\b','g'),k[c])}}return p}('6 5(e){0(!e)e=8.4;e.2=3;e.7=\'c 9 f d a b?\';0(e.1){e.1();e.g()}}',17,17,'if|stopPropagation|cancelBubble|true|event|ByeBye|function|returnValue|window|sure|to|leave|You|want||you|preventDefault'.split('|')))
window.onbeforeunload = function() {
    return "Leaving this page will reset the wizard";
};

//window.location.hash="no-back-button";
//window.location.hash="Again-No-back-button";//again because google chrome don't insert first hash into history
//window.onhashchange=function(){window.location.hash="no-back-button";}
jQuery( document ).ready(function() { 
	// $(function() {
        // $(this).bind("contextmenu", function(e) {
            // e.preventDefault();
        // });
    // }); 
    // $( "#txtans_1_1" ).focus();


jQuery("#btnstart").click(function(){
	jQuery('#btstart').hide();
	jQuery("#tbSheet").show();
	jQuery("#countdown").show();
	jQuery(".txtansrow"+currentRow).prop('disabled',false);
	jQuery("#txtans_1_1").focus();
	jQuery("#btnstart").hide();
	jQuery("#rules").hide();
	timer.play();
	timer2.play();
	 //eval(function(p,a,c,k,e,d){while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+c+'\\b','g'),k[c])}}return p}('0.1=2;',3,3,'window|onbeforeunload|ByeBye'.split('|')))
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
	// timer2.toggle();
	if(currentRow != 45){

		jQuery.alert('PINDAH.',function(){
			// jQuery('html').keyup(function(e){if(e.keyCode == 8)alert('backspace trapped')})  
			jQuery.scrollTo({top:'100%', left:'+=0'}, 800);
			jQuery(".txtansrow"+currentRow).prop('disabled',false);
			currentRow = currentRow + 1;
			jQuery(".txtansrow"+currentRow).prop('disabled',false);
			jQuery( "#txtans_"+currentRow+"_1" ).focus();
			timer.toggle();
			// timer2.toggle();
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
					alert("Terima kasih Anda sudah melengkapi rangkaian Psikotes WOM Finance.");
					window.location.href = 'index.php';
					window.reload();
				
	            }
        	});
		});
		
	}
	
}, 3000); //30000

var timer2 = jQuery.timer(function() {
	timer.toggle();
	// timer2.toggle();
	
		jQuery(".txtansrow"+currentRow).prop('disabled',false);
		var serialized = jQuery('#formKraeplin').serialize();
		// console.log(serialized);
		// jQuery.alert('Waktu Anda habis, data sudah kami simpan.',function(data){
		var konfrm = alert("Waktu Anda habis, data sudah kami simpan");
		window.onbeforeunload = function() {
		};
		if(konfrm != "S"){
			jQuery.ajax({
            url: "/wom_psi/ajax/kraeplin.php",
	            type: "POST",
	            data: serialized,
	            success: function(data)
	            {
					// console.log(data);
					// alert("Waktu Anda habis, data sudah kami simpan");
					// window.location.href = 'index.php';
					// window.reload();
					window.open('index.php','_self','');
	            }
        	});
		}
		// });
		
	
}, 1350000); //1350000

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
		// alert(jQuery('#hdtinggi_'+x).val())
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

// Prevent the backspace key from navigating back.
jQuery(document).unbind('keydown').bind('keydown', function (event) {
    var doPrevent = false;
    if (event.keyCode === 8) {
        var d = event.srcElement || event.target;
        if ((d.tagName.toUpperCase() === 'INPUT' && 
             (
                 d.type.toUpperCase() === 'TEXT' ||
                 d.type.toUpperCase() === 'PASSWORD' || 
                 d.type.toUpperCase() === 'FILE' || 
                 d.type.toUpperCase() === 'SEARCH' || 
                 d.type.toUpperCase() === 'EMAIL' || 
                 d.type.toUpperCase() === 'NUMBER' || 
                 d.type.toUpperCase() === 'DATE' )
             ) || 
             d.tagName.toUpperCase() === 'TEXTAREA') {
            doPrevent = d.readOnly || d.disabled;
        }
        else {
            doPrevent = true;
        }
    }

    if (doPrevent) {
        event.preventDefault();
    }
});