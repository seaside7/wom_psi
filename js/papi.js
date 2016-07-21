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
		var temp = $('formPAPI').serialize();
		new Ajax.Updater(form,'ajax/papi.php?po=nextPage&limit='+limit+'&form='+form+'&id='+id+'&'+temp);
	}else{
		var temp = $('formPAPI').serialize();
		jQuery("#btnNext").prop('disabled',true);
		jQuery.ajax({
            url: "/wom_psi/ajax/papi.php?po=saveHasilPAPI&limit="+limit+"&id="+jQuery('#hduserid').val()+"&"+temp,
	            type: "POST",
	            success: function(data)
	            {
					console.log(data);
					alert("Terima kasih data Anda sudah kami simpan");
					//window.location.href = 'index.php?act=disc';
					//window.reload();
				
	            }
        	});
		
	}
	
}
function previousPage(form, id, limit)
{	
	for(var i=limit+1; i<=limit+15; i++){ 
		if(!ischecked_rb('rdsoal'+i)) { alert('Soal no '+i+' belum dijawab.'); return false; }
	} 
	limitjs = limit;
	var temp = $('formPAPI').serialize();
	new Ajax.Updater(form,'ajax/papi.php?po=previousPage&limit='+limit+'&form='+form+'&id='+id+'&'+temp);
	
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
	jQuery("#btnPrevious").hide();
	
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
		jQuery("#btnPrevious").show();
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