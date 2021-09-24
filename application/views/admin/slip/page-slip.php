<div class="box">
	<div class="box-body">
		<form id="formFilter">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="periode_filter">Periode</label>
						<input type="month" class="form-control" name="periode_filter" id="periode_filter"
							value="<?= date('Y-m') ?>">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label for="outlet_filter">Outlet</label>
						<select class="form-control" name="outlet_filter" id="outlet_filter">
							<option value="" selected="selected" readonly="readonly">- Pilih Outlet -</option>
							<?php foreach ($outlet as $key => $row): ?>
							<option value="<?= $row['id_outlet'] ?>">
								<?= $row['id_outlet'] ?> - <?= $row['nama_outlet'] ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-md-2 mt-2">
					<button class="btn btn-info ml-1 mt-4" id="btnFilter"><i
							class="mdi mdi-arrow-down-drop-circle-outline"></i>
						Proses</button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="mdlLembur" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Input Lembur Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="formLembur">
					<div class="row">
						<div class="col-md-8">
							<div class="form-group">
								<label for="jenis_lembur">Jenis Lembur</label>
								<select class="form-control requiredLembur" name="jenis_lembur" id="jenis_lembur">
									<!-- <option value="" selected>-Pilih-</option>
									<option value="001">Lembur Harian</option>
									<option value="002">Hari Raya Waisak</option> -->
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label>Tanggal Lembur</label>
								<div class="input-group">
									<input type="date" class="form-control requiredLembur" id="tanggal_lembur"
										name="tanggal_lembur">
									<div class="input-group-append">
										<button class="btn btn-rounded btn-info btn-sm"
											id="btnSimpanLembur">Tambah</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<table id="tblLembur" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>Jenis Lembur</th>
							<th>Tanggal</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button class="float-right btn btn-success mt-2" id="btnSelesaiLembur"><i
						class="mdi mdi-plus-box-outline"></i> Selesai</button>
			</div>
		</div>
	</div>
</div>

<div class="box containerAbsensi">
	<div class="box-header with-border">
		<h3>Absensi Telah di Input </h3>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<table id="tblAbsensi" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>Info Karyawan</th>
						<th>Periode</th>
						<th>Hadir</th>
						<th>Absen</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>

<script>
	///kerjakan master lembur
	$(".containerAbsensi").hide();
	let act = '';
	let id_absensi = '';
	let periode_filter, outlet_filter = '';
	$(document).ready(function () {
		console.clear();
		$("#outlet_filter").select2();
		//button action
		$("#btnFilter").click(function (e) {
			e.preventDefault();
			periode_filter = $("#periode_filter").val();
			outlet_filter = $("#outlet_filter").val();
			if (periode_filter != '' && outlet_filter != '') {
				getAbsensi(periode_filter, outlet_filter)
			} else {
				a_error('Maaf!', 'Silahkan pilih Periode dan outlet dahulu!');
			}
		})

		$("#tblAbsensi").on('click', ".btnCetak", function () {
			let id_karyawan = $(this).data('id');
			let link = base_url + 'slip/print/' + outlet_filter + '/' + periode_filter + '/' + id_karyawan;
			window.open(link, link);
		})
	})

	function getAbsensi(periode_filter, outlet_filter) {
		$.ajax({
			url: base_url + 'Absensi/get_data',
			data: {
				periode: periode_filter,
				id_outlet: outlet_filter
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				$("#id_outlet").val(outlet_filter)
				$("#periode").val(periode_filter)
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>
								` + data[i].nik + ` <br />
								<b>` + data[i].nama + `</b> <br />
								` + data[i].jabatan + ` <br />
								` + data[i].handphone + `
							</td>
							<td>` + data[i].periode + `</td>
							<td>` + data[i].hadir + `</td>
							<td>` + data[i].absen + `</td>
							<td align="center" style="vertical-align:middle">
								<button type="button" data-id="` + data[i].id_karyawan + `" class="btn btn-primary btnCetak"><i class="mdi mdi-print"></i> Cetak</button>
							</td>
						</tr>
					`;
				}
				$('#tblAbsensi').DataTable().clear().destroy();
				$("#tblAbsensi tbody").html(html);
				$('#tblAbsensi').dataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "25%",
							"targets": 0
						},
						{
							"width": "5%",
							"targets": 1
						},
						{
							"width": "5%",
							"targets": 2
						},
						{
							"width": "5%",
							"targets": 3
						},
						{
							"width": "1%",
							"targets": 4
						}
					]
				});
				$(".containerAbsensi").show();
			}
		});
	}
</script>