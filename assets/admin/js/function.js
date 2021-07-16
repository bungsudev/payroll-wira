function swalSuccess(judul, pesan) {
	Swal.fire({
		type: "success",
		title: judul,
		text: pesan
	}).then(result => {});
}
function swalError(judul, pesan) {
	setTimeout(function() {
		Swal.fire({
			type: "error",
			title: judul,
			text: pesan
		}).then(result => {});
	});
}
$('input.number').keyup(function(event) {
	// skip for arrow keys
	if(event.which >= 37 && event.which <= 40) return;

	// format number
	$(this).val(function(index, value) {
	return value
	.replace(/\D/g, "")
	.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	;
	});
});

function formatNumber(number){
	return number.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ".")
	;
}
function formatBackNumber(number){
	return number.toString().replace(/[ ,.]/g,"");
}
