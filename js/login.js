$(document).on('keypress', function(e) {
    if(e.which == 13) {
        $( "#btnLogin" ).click();
    }
});

function localJsLogin(form)
{	
	var Pass = $('#txtPass').val(); 	
	var User = $('#txtUsername').val(); 	
	
	
	if(!User) {alert('Username belum diisi!'); return false;}
	if(!Pass) {alert('Password belum diisi!'); return false;}
	$.ajax({
	 type: 'POST',
             dataType: "json",
             url: 'ajax/login.php?po=localAjLogin&user='+User+'&pass='+Pass,
             success: function(data) { console.log(data);
				if(data.success!=''){ // console.log(data); 
					if(data.success=='admin') { window.location.href = 'index.php?act=home'; }
					else if(data.success=='testee') { window.location.href = 'index.php?act=wpt'; }
				 }else {alert('Username atau Password salah.'); return false;}
			}		
	});
	
}
function trim(str, chars) {	return ltrim(rtrim(str, chars), chars);} 
function ltrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");}
function rtrim(str, chars) {	chars = chars || "\\s";	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");}
