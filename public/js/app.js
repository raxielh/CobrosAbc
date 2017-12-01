$(function() {
	console.log('Ready');
});

function mensaje(d){
	var snackbarContainer = document.querySelector('#demo-toast-example');
	var showToastButton = document.querySelector('#demo-show-toast');
	var data = {message:d};
	snackbarContainer.MaterialSnackbar.showSnackbar(data);
}
