	<!-- Vendor JS -->
	<script src="<?= base_url() ?>assets/admin/js/vendors.min.js"></script>
	<script src="<?= base_url() ?>assets/admin/js/pages/chat-popup.js"></script>
	<script src="<?= base_url() ?>assets/admin/icons/feather-icons/feather.min.js"></script>

	<script src="<?= base_url() ?>assets/admin/vendor_components/apexcharts-bundle/dist/apexcharts.js"></script>
	<script src="<?= base_url() ?>assets/admin/vendor_components/datatable/datatables.min.js"></script>
	<!-- <script src="<?= base_url() ?>assets/admin/js/fontawesome.all.min.js"></script> -->
	<script src="<?= base_url() ?>assets/admin/js/sweetalert2.js"></script>
	<script src="<?= base_url() ?>assets/admin/js/function.js"></script>

	<!-- WebkitX Admin App -->
	<script src="<?= base_url() ?>assets/admin/js/bootstrap-select.js"></script>
	<script src="<?= base_url() ?>assets/admin/vendor_components/select2/dist/js/select2.full.js"></script>
	<script src="<?= base_url() ?>assets/admin/js/template.js"></script>
	<script src="<?= base_url() ?>assets/admin/js/pages/data-table.js"></script>
	<script src="<?= base_url() ?>assets/js/iziToast.min.js"></script>	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script>
		function ct(data){
			return console.table(data)
		}
		function cl(data){
			return console.log(data)
		}
		function a_ok(title, text){
			iziToast.success({
				title: title,
				message: text,
			});
		}
		function a_error(title, text){
			iziToast.error({
				title: title,
				message: text,
			});
		}
		function a_warning(title, text){
			iziToast.warning({
				title: title,
				message: text,
			});
		}

		function preview_img(input, id) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$("#"+id+"").attr('src', e.target.result);
				}
				reader.readAsDataURL(input.files[0]);
			}
		}

		function format_tanggal(dateObject) {
			var d = new Date(dateObject);
			var day = d.getDate();
			var month = d.getMonth() + 1;
			var year = d.getFullYear();
			if (day < 10) {
				day = "0" + day;
			}
			if (month < 10) {
				month = "0" + month;
			}

			const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember" ];

			var date = day + " " + monthNames[d.getMonth()] + " " + year;

			return date;
		};
	</script>
	