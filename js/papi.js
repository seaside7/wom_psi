jQuery.noConflict();

var ans = '';
function nextPage(form, id, limit)
{	
	
	for(var i=limit+1; i<=limit+15; i++){ 
		if(!ischecked_rb('rdsoal'+i)) { alert('Soal no '+i+' belum dijawab.'); return false; }
	}
	for(var j=limit+1; j<=limit+15; j++){ 
		ans = ans.concat(jQuery("[name='rdsoal"+j+"']:checked").val());
	}
	// alert(ans+"<br />"+ans.length);
	// alert(limit);
	if(limit+15<90){
		
		new Ajax.Updater(form,'ajax/papi.php?po=nextPage&limit='+limit+'&form='+form+'&id='+id);
	}else{
		jQuery("#btnNext").prop('disabled',true);
		jQuery.ajax({
            url: "/wom_psi/ajax/papi.php?po=saveHasilPAPI&ans="+ans+"&id="+jQuery('#hduserid').val(),
	            type: "POST",
	            success: function(data)
	            {
					console.log(data);
					alert("Terima kasih data Anda sudah kami simpan");
					window.location.href = 'index.php?act=disc';
					window.reload();
				
	            }
        	});
		/* var G = (ans.match(/G/g) || []).length;
		var L = (ans.match(/L/g) || []).length;
		var I = (ans.match(/I/g) || []).length;
		var T = (ans.match(/T/g) || []).length;
		var V = (ans.match(/V/g) || []).length;
		var S = (ans.match(/S/g) || []).length;
		var R = (ans.match(/R/g) || []).length;
		var D = (ans.match(/D/g) || []).length;
		var C = (ans.match(/C/g) || []).length;
		var E = (ans.match(/E/g) || []).length;
		var N = (ans.match(/N/g) || []).length;
		var A = (ans.match(/A/g) || []).length;
		var P = (ans.match(/P/g) || []).length;
		var X = (ans.match(/X/g) || []).length;
		var B = (ans.match(/B/g) || []).length;
		var O = (ans.match(/O/g) || []).length;
		var Z = (ans.match(/Z/g) || []).length;
		var K = (ans.match(/K/g) || []).length;
		var F = (ans.match(/F/g) || []).length;
		var W = (ans.match(/W/g) || []).length; */
		
	}
	
}
function gelsnm(el) { return document.getElementsByName(el); }
function ischecked_rb(el)
{	var check = gelsnm(el);
	var ada = false;
	for(i=0;i<check.length;i++)	if(check[i].checked==1) ada = true;
	return ada;
}

jQuery( document ).ready(function() {
	jQuery("#tablePAPI").hide();
	jQuery("#btnNext").hide();
	
	jQuery(document).on("click",".ansrowA", function(){
	   var no = jQuery(this).find('input:radio').attr('id').substring(7);
	   jQuery('#rdsoalB'+jQuery(this).find('input:radio').attr('id').substring(7)).prop('checked', false);
	   jQuery(this).find('input:radio').prop('checked', true);
	});
	jQuery(document).on("click",".ansrowB", function(){
		var no = jQuery(this).find('input:radio').attr('id').substring(7);
		jQuery('#rdsoalA'+jQuery(this).find('input:radio').attr('id').substring(7)).prop('checked', false);
		jQuery(this).find('input:radio').prop('checked', true);
	});
	
	
	jQuery("#btnstart").click(function(){ 
		jQuery("#tablePAPI").show();
		jQuery("#btnNext").show();
		jQuery("#btnstart").hide();
		jQuery("#rules").hide();
	});
});

jQuery(document).on("click",".ansrowA", function(){
   var no = jQuery(this).find('input:radio').attr('id').substring(7);
   jQuery('#rdsoalB'+jQuery(this).find('input:radio').attr('id').substring(7)).prop('checked', false);
   jQuery(this).find('input:radio').prop('checked', true);
});
jQuery(document).on("click",".ansrowB", function(){
	var no = jQuery(this).find('input:radio').attr('id').substring(7);
	jQuery('#rdsoalA'+jQuery(this).find('input:radio').attr('id').substring(7)).prop('checked', false);
	jQuery(this).find('input:radio').prop('checked', true);
});