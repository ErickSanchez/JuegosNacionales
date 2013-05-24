$(document).ready(function() {

	$('.dynamic').change(function(){
		var field = '#'+$(this).attr('name');
		var child = '#'+$(this).attr('alt');
		alert('modificando a '+child);
		var opc = $(field+' :selected').val();
		var txt = $(field+' :selected').text();
		//$(field).attr('value', txt);
		if(opc==0){	
			select = $(child);
			select.disabled = true;
		}
		else{
			$.get('../admin/loadFields.php?load='+$(this).attr('alt')+'&var='+opc, {	id:$(this).val()
			},function(data){		
				$(child).html(data);
				select = $(child);
				select.disabled = false;
			})
		}
	});

})
	