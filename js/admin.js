
$( document ).ready(function() { 
	// alert("a");
	 $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
	});
	$('.tooltip').tooltipster();
	var oTable = $('#tableatendee').dataTable({
		   "language": {
					 "lengthMenu": "Tampilkan _MENU_ Data per halaman",
					 "zeroRecords": "Tidak ada data peserta",
					 "info": "Halaman _PAGE_ dari _PAGES_",
					 "infoEmpty": "Tidak ada data yang tersedia",
					 "infoFiltered": "(Penyaringan data dari _MAX_ total data)"
				 },
				 "order": [],
				 pagingType: "simple_numbers",
				 "aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 6 ] }//,
					// { "visible": false, "targets": 0 }
				 ],
				 // "aoColumns": [{ 
				 //   "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
				 //   $(".titletooltip", this.fnGetNodes()).tooltipster();
				 // }
				 // }],
			  aLengthMenu: [
				 [10, 25, 50, 100, -1],
				 [10, 25, 50, 100, "All"]
			  ],
			  iDisplayLength:10
			 });
});

function localJsLogin(form)
{	
	var Pass = $('#txtPass').val(); 	
	
	
	if(!Pass) {alert('Password belum diisi!'); return false;}
	$.ajax({
	 type: 'POST',
             dataType: "json",
             url: 'ajax/admin.php?po=localAjLogin&pass='+Pass,
             success: function(data) { 
				if(data.row>0){ console.log(data); 
					window.location.href = 'index.php?act=admin'; 
				 }else {alert('Password salah.'); return false;}
			}		
	});
	
}

function JSlogout(){
	$.ajax({
	 type: 'POST',
             dataType: "json",
             url: 'ajax/admin.php?po=AJlogout',
             success: function(data) { 
				if(data.success = 'success'){
					window.location.href = 'index.php?act=admin'; 
				}
					
			}		
	});
}