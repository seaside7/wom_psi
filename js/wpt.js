jQuery.noConflict();

var ans = '';
function nextPage(form, id, limit)
{	
	limitjs = limit;
	if(limit+10<50){
		var temp = $('formWPT').serialize();
		//console.log(temp);
		new Ajax.Updater(form,'ajax/wpt.php?po=nextPage&limit='+limit+'&form='+form+'&id='+id+'&'+temp);
	}else{
		jQuery("#btnNext").prop('disabled',true);
		// console.log(form.serialize());
		var temp = $('formWPT').serialize();
		jQuery.ajax({
            url: "/wom_psi/ajax/wpt.php?po=saveHasilWPT&limit="+limit+"&id="+id+"&"+temp,
	            type: "POST",
	            success: function(data)
	            {
					console.log(data);
					alert("Terima kasih data Anda sudah kami simpan");
					window.location.href = 'index.php?act=disc';
					window.reload();
				
	            }
        	});
		
	}
	
}
function previousPage(form, id, limit)
{	
	limitjs = limit;
	var temp = $('formWPT').serialize();
	new Ajax.Updater(form,'ajax/wpt.php?po=previousPage&limit='+limit+'&form='+form+'&id='+id+'&'+temp);
	
}
function gelsnm(el) { return document.getElementsByName(el); }
function ischecked_rb(el)
{	var check = gelsnm(el);
	var ada = false;
	for(i=0;i<check.length;i++)	if(check[i].checked==1) ada = true;
	return ada;
}

jQuery( document ).ready(function() {
	jQuery("#tableWPT").hide();
	jQuery("#btnNext").hide();
	jQuery("#btnPrevious").hide();
	
	jQuery("#btnstart").click(function(){ 
		jQuery("#tableWPT").show();
		jQuery("#btnNext").show();
		jQuery("#btnPrevious").show();
		jQuery("#btnstart").hide();
		jQuery("#rules").hide();
		timer.play();
	});

var idjs = jQuery('#hduserid').val();
var limitjs = 0;
var timer = jQuery.timer(function() {
	timer.toggle();
	
	jQuery.alert('Waktu habis.',function(){
		var temp = $('formWPT').serialize();
		jQuery.ajax({
            url: "/wom_psi/ajax/wpt.php?po=saveHasilWPT&limit="+limitjs+"&id="+idjs+"&"+temp,
	            type: "POST",
	            success: function(data)
	            {
					console.log(data);
					alert("Terima kasih data Anda sudah kami simpan");
					window.location.href = 'index.php?act=disc';
					window.reload();
				
	            }
        	});
	});
	
	
}, 900000);
});	