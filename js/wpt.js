jQuery.noConflict();

var ans = '';
function nextPage(form, id, limit)
{	
	if(limit+10<50){
		new Ajax.Updater(form,'ajax/wpt.php?po=nextPage&limit='+limit+'&form='+form+'&id='+id);
	}else{
		jQuery("#btnNext").prop('disabled',true);
		jQuery.ajax({
            url: "/wom_psi/ajax/wpt.php?po=saveHasilWPT&ans="+ans+"&id="+jQuery('#hduserid').val(),
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
	
	new Ajax.Updater(form,'ajax/wpt.php?po=previousPage&limit='+limit+'&form='+form+'&id='+id);
	
}
function gelsnm(el) { return document.getElementsByName(el); }
function ischecked_rb(el)
{	var check = gelsnm(el);
	var ada = false;
	for(i=0;i<check.length;i++)	if(check[i].checked==1) ada = true;
	return ada;
}