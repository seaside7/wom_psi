
$( document ).ready(function() { 
	// alert("a");
	// var buttonCommon = {
    //     exportOptions: {
    //         format: {
    //             body: function ( data, row, column, node ) {
    //                 // Strip $ from salary column to make it numeric
	// 				return column === 1 ?
					 
    //                     "'".concat( data ) :
    //                     data;
    //             }
    //         }
	// 	}
	// };
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
				 dom: 'Bfrtip',
				 buttons: [
					 {
						 extend: 'excel',
						 exportOptions: {
							columns: [0,1,2,3,4,5,6],
							orthogonal: 'sort'
						},
						customize: function( xlsx ) {
							var sheet = xlsx.xl.worksheets['sheet1.xml'];
			 
							$('row c[r^="B"]', sheet).attr( 's', '51' );
						},
						customizeData: function ( data ) {
							for (var i=0; i<data.body.length; i++){
								for (var j=0; j<data.body[i].length; j++ ){
									data.body[i][j] = '\u200C' + data.body[i][j];
								}
							}
						}    
					 }
				 ],
				 pagingType: "simple_numbers",
				 "aoColumnDefs": [
					{ 'bSortable': false, 'aTargets': [ 7 ] }//,
					// { "visible": false, "targets": 0 }
				 ],
			  aLengthMenu: [
				 [10, 25, 50, 100, -1],
				 [10, 25, 50, 100, "All"]
			  ],
			  iDisplayLength:8
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
					window.location.href = 'index.php'; 
				}
					
			}		
	});
}