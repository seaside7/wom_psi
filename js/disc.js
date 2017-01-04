

$( document ).ready(function() {
	var DMno  = "";
	var DLno  = "";
	var IMno  = "";
	var ILno  = "";
	var SMno  = "";
	var SLno  = "";
	var CMno  = "";
	var CLno  = "";
	$("#tableDISC").hide();
	$("#btnSave").hide();
	
	$("#btnstart").click(function(){ 
		$("#tableDISC").show();
		$("#btnSave").show();
		$("#btnstart").hide();
		$("#rules").hide();
	});

	$("#btnSave").click(function(){ 
	var id = jQuery('#hduserid').val();
		var DM  = 0;
		var DL  = 0;
		var IM  = 0;
		var IL  = 0;
		var SM  = 0;
		var SL  = 0;
		var CM  = 0;
		var CL  = 0;
	// if($('#txtans_1_1').data("tipe")!="") alert($('#txtans_1_4').data("tipe"));
		for(var x=1;x<=24;x++){
			var Mperline = 0;
			var Lperline = 0;
			for(var y=1;y<=4;y++){
				var txt = "txtans_"+x+"_"+y;
				if($('#'+txt).val()!=""){
					if($('#'+txt).val().toUpperCase()=="M") Mperline++;
					else if($('#'+txt).val().toUpperCase()=="L") Lperline++;
					if(x==21 && y==1){
						if($('#'+txt).val().toUpperCase()=="M"){SM++; SMno+= x+" "+y+"\n";}
						else if($('#'+txt).val().toUpperCase()=="L"){IL++; ILno+= x+" "+y+"\n";}
					}else{
						if($('#'+txt).data("komponen")=="D" && $('#'+txt).val().toUpperCase()=="M" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="A")) {DM++; DMno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="D" && $('#'+txt).val().toUpperCase()=="L" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="B")) {DL++; DLno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="I" && $('#'+txt).val().toUpperCase()=="M" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="A")) {IM++; IMno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="I" && $('#'+txt).val().toUpperCase()=="L" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="B")) {IL++; ILno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="S" && $('#'+txt).val().toUpperCase()=="M" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="A")) {SM++; SMno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="S" && $('#'+txt).val().toUpperCase()=="L" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="B")) {SL++; SLno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="C" && $('#'+txt).val().toUpperCase()=="M" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="A")) {CM++; CMno+= x+" "+y+"\n";}
						if($('#'+txt).data("komponen")=="C" && $('#'+txt).val().toUpperCase()=="L" && ($('#'+txt).data("tipe")=="P" || $('#'+txt).data("tipe")=="B")) {CL++; CLno+= x+" "+y+"\n";}
					}
				}
			}
			if (Mperline > 1) { alert("Jawaban soal no."+x+" tidak sesuai ketentuan.\nIsi dengan satu \"M\"."); return false;}
			if (Lperline > 1) { alert("Jawaban soal no."+x+" tidak sesuai ketentuan.\nIsi dengan satu \"L\"."); return false;}
		}
		
		console.log("DM="+DM+"\n"+DMno+"\n"+"DL="+DL+"\n"+DLno+"\n"+"IM="+IM+"\n"+IMno+"\n"+"IL="+IL+"\n"+ILno+"\n"+
					"SM="+SM+"\n"+SMno+"\n"+"SL="+SL+"\n"+SLno+"\n"+"CM="+CM+"\n"+CMno+"\n"+"CL="+CL+"\n"+CLno+"\n");
		
		jQuery("#btnSave").prop('disabled',true);
		jQuery.ajax({
            url: "/wom_psi/ajax/disc.php?po=saveHasilDISC&id="+id+"&DM="+DM+"&DL="+DL+"&IM="+IM+"&IL="+IL+"&SM="+SM+"&SL="+SL+"&CM="+CM+"&CL="+CL,
	            type: "POST",
	            success: function(data)
	            {
					console.log(data);
					// alert("Terima kasih data Anda sudah kami simpan");
					alert("Terima kasih data Anda sudah kami simpan");
					window.location.href = 'index.php?act=kraeplin';
					window.reload();
				
	            }
        	});
		
	});

	
});	

function isMorL(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 76 || (charCode > 77 && charCode < 108) || charCode > 109)) {
		alert("Isi dengan \"M\" atau \"L\".");
        return false;
    }
    return true;
}