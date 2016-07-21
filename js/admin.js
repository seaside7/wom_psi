
$( document ).ready(function() { 
	// alert("a");
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

