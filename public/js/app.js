$(function() {
	console.log('Ready');
	$('#tbl').DataTable( {
	  responsive: true
	} );

});

function mensaje(d){
	var snackbarContainer = document.querySelector('#demo-toast-example');
	var showToastButton = document.querySelector('#demo-show-toast');
	var data = {message:d};
	snackbarContainer.MaterialSnackbar.showSnackbar(data);
}

function Moneda(entrada){
	var num = entrada.replace(/\./g,"");
	if(!isNaN(num)){
	num = num.toString().split("").reverse().join("").replace(/(?=\d*\.?)(\d{3})/g,"$1.");
	num = num.split("").reverse().join("").replace(/^[\.]/,"");
	entrada = num;
	}else{
	entrada = input.value.replace(/[^\d\.]*/g,"");
	}
	return entrada;
}


function QuitarMoneda(entrada){
 	while (entrada.toString().indexOf(".") != -1){
      entrada = entrada.toString().replace(".","");
 	}
	return entrada;
}
