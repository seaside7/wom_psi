var tinggi = {};

$( document ).ready(function() {
	
    //$( "#txtans_1_1" ).focus();
});

function isNumberNoAlert(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		//alert("Hanya dapat diisi angka.");
        return false;
    }
    return true;
}
function localJsSaveDetail(form)
{	
	var strConfirm = "Anda yakin akan simpan data ini?";
	var strReconfirm = "";
	var row;
	var tahapan_tes;
	var NoKTP = $('#txtNoKTP').val(); 		
	var Nama = $('#txtNama').val(); 		
	var Posisi = $('#txtPosisi').val(); 	 
	var Usia = $('#txtUsia').val(); 		
	var Alamat = $('#txtAlamat').val(); 		
	var NoHP = $('#txtNoHP').val(); 	
	var thpn = 0;
	
	
	if(!NoKTP){ alert('Nomor KTP belum diisi!'); return false; }
	// if(NoKTP.length < 16){ alert('Nomor KTP belum lengkap!'); return false; }
		// alert("a"); return false;
		//console.log('a');
	var xhr = $.ajax({
	 type: 'POST',
             dataType: "json",
             async:false,
             url: 'ajax/testee.php?po=localAjGetRowDetail&id='+$('#txtNoKTP').val(),
             success: function(data) { //console.log(data);
			if(data.row>0){
				thpn = 1;
				var d = new Date(data.tanggal_tes);
				var v = new Date(d.getFullYear()+2,d.getMonth(),d.getDate());
				var n = new Date();
				console.log(v.toDateString());
				console.log(n);
				if(n > v){ 
					thpn = 6; 
					strReconfirm = 'Peserta dengan nomor KTP '+NoKTP+' sudah menyelesaikan tahapan psikotes.\nHasil test valid hingga '+d.getDate()+'-'+getMonthText(d.getMonth())+'-'+(d.getFullYear()+2) + '\n\n';
				}
				else{
					switch(data.tahapan_tes)
					{	
						case '1': window.location.href = 'index.php?act=wpt';break; 
						case '2': window.location.href = 'index.php?act=papi';break;
						case '3': window.location.href = 'index.php?act=disc';break;
						case '4': window.location.href = 'index.php?act=kraeplin';break;
						case '5': alert('Peserta dengan nomor KTP '+NoKTP+' sudah menyelesaikan tahapan psikotes.\nHasil test valid hingga '+d.getDate()+'-'+getMonthText(d.getMonth())+'-'+(d.getFullYear()+2)); break;
					}
				}
			}
				
		}			
	});
	
	if(thpn == 0){
		if(!Nama){ alert('Nama belum diisi!'); return false; }
		if(!Usia){ alert('Usia belum diisi!'); return false; }
		if(!Posisi){ alert('Posisi yang dilamar belum diisi!'); return false; }
		if(!Alamat){ alert('Alamat belum diisi!'); return false; }
		if(!NoHP){ alert('Nomor HP belum diisi!'); return false; }	
		
		if(!confirm(strConfirm)){ 
			return false; 
		}else{   
			$('#btnSaveDetail').disable;
			$('#btnSaveDetail').val("Sedang Dalam Proses Simpan");
			// $(form).submit();
			console.log($('#'+form).serialize());
			$.ajax({
			 type: 'POST',
			 url: 'ajax/testee.php?&po=localAjSaveDetail',
			 data: $('#'+form).serialize(),
			
	        success:function(request){
				switch(request)
				{	case '0': alert('Gagal menyimpan data.'); break;	
					case '1': alert('Sukses menyimpan data'); 
							  window.location.href = 'index.php?act=wpt';
							  window.reload();  break;
				}
				$('#btnSaveDetail').enable;
				$('#btnSaveDetail').val("Simpan");
			}
			 }); return false;
			
		}
	}else if(thpn == 6){
		
		if(!Nama){ alert('Nama belum diisi!'); return false; }
		if(!Usia){ alert('Usia belum diisi!'); return false; }
		if(!Posisi){ alert('Posisi yang dilamar belum diisi!'); return false; }
		if(!Alamat){ alert('Alamat belum diisi!'); return false; }
		if(!NoHP){ alert('Nomor HP belum diisi!'); return false; }	
		strReconfirm = strReconfirm + "Hasil test sebelumnya akan dihapus, lakukan backup data terlebih dahulu.\nAnda yakin akan melakukan test ulang?";
		if(!confirm(strReconfirm)){ 
			return false; 
		}else{   
			$('#btnSaveDetail').disable;
			$('#btnSaveDetail').val("Sedang Dalam Proses Simpan");
			// $(form).submit();
			console.log($('#'+form).serialize());
			$.ajax({
			 type: 'POST',
			 url: 'ajax/testee.php?&po=localAjEditDetail',
			 data: $('#'+form).serialize(),
			
	        success:function(request){
	            // var hasils = request.responseText;
				console.log(request);
				switch(request)
				{	case '0': alert('Gagal menyimpan data.'); break;	
					case '1': alert('Sukses menyimpan data'); 
							  window.location.href = 'index.php?act=wpt';
							  window.reload();  break;
				}
				$('#btnSaveDetail').enable;
				$('#btnSaveDetail').val("Simpan");
			}
			 }); return false;
			
		}
		console.log("yaktul");
	}
}
function JSlogout(){
	$.ajax({
	 type: 'POST',
             dataType: "json",
             url: 'ajax/testee.php?po=AJlogout',
             success: function(data) { 
				if(data.success = 'success'){
					window.location.href = 'index.php'; 
				}
					
			}		
	});
}
function getMonthText(m){
	switch(m){
		case 0: return 'Januari'; break;
		case 1: return 'Februari'; break;
		case 2: return 'Maret'; break;
		case 3: return 'April'; break;
		case 4: return 'Mei'; break;
		case 5: return 'Juni'; break;
		case 6: return 'Juli'; break;
		case 7: return 'Agustus'; break;
		case 8: return 'September'; break;
		case 9: return 'Oktober'; break;
		case 10: return 'November'; break;
		case 11: return 'Desember'; break;
	}
}
function trim(str, chars) {	return ltrim(rtrim(str, chars), chars);} 
function ltrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");}
function rtrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");}
