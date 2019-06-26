

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

		var start = new Date();
		// frontTimer(start);
		var timerInterval = setInterval(function() {
			var time = 900000 - (new Date() - start); // 900000
			if(time < 1) {
				jQuery("#minute").text('00');
				jQuery("#second").text('00');
				clearInterval(timerInterval);
				jQuery.alert('Waktu habis.',function(){
					var id = jQuery('#hduserid').val();
					var DM  = 0;
					var DL  = 0;
					var IM  = 0;
					var IL  = 0;
					var SM  = 0;
					var SL  = 0;
					var CM  = 0;
					var CL  = 0;
					for(var x=1;x<=24;x++){
						for(var y=1;y<=4;y++){
							var txt = "txtans_"+x+"_"+y;
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
					jQuery("#btnSave").prop('disabled',true);
					jQuery.ajax({
			            url: "/wom_psi/ajax/disc.php?po=saveHasilDISC&id="+id+"&DM="+DM+"&DL="+DL+"&IM="+IM+"&IL="+IL+"&SM="+SM+"&SL="+SL+"&CM="+CM+"&CL="+CL,
				            type: "POST",
				            success: function(data)
				            {
								alert("Terima kasih data Anda sudah kami simpan");
								window.location.href = 'index.php?act=kraeplin';
								window.reload();
							
				            }
			        	});
				});
			} else {
				var minute = '0' + Math.floor((time/1000/60)%60);
				var second = '0' + Math.floor((time/1000)%60);
				jQuery("#minute").text(minute.slice(-2));
				jQuery("#second").text(second.slice(-2));
			}
		}, 100);
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
		var no_salah = "";
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
			// if (Mperline > 1 || Lperline > 1) { alert("Jawaban soal no."+x+" tidak sesuai ketentuan.\nIsi dengan satu \"M\"."); return false;}
			if (Mperline > 1 || Lperline > 1 || Mperline == 0 || Lperline == 0) { no_salah = no_salah + x + "\n";}
		} 
		// alert(no_salah); return false;
		if(no_salah != ""){alert("Jawaban soal no.:\n"+no_salah+" tidak sesuai ketentuan.\nIsi dengan satu \"M\" atau \"L\" ."); return false;}
		
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