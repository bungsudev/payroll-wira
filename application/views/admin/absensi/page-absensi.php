<div class="box">
	<div class="box-body">
		<form id="formFilter">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="periode_filter">Periode</label>
						<input type="month" class="form-control" name="periode_filter" id="periode_filter"
							placeholder="">
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

<div class="box containerAbsensi">
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				<div class="table-responsive">
					<table id="tbl-karyawan" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th>No</th>
								<th>Daftar Karyawan</th>
								<th></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Input Data Absensi Karyawan</h3>
				<hr />
				<form ecntype="multipart/form-data" id="form-absensi">
					<div class="row">
						<input type="hidden" name="id_karyawan" id="id_karyawan">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nik">NIK</label>
								<input type="text" class="form-control required" name="nik" id="nik" readonly
									placeholder="NIK Karyawan">
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control required" name="nama" id="nama" readonly
									placeholder="Nama Karyawan">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="hadir">Hadir</label>
								<input type="number" class="form-control required" name="hadir" max='31' min='28' id="hadir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="absen">Absen</label>
								<input type="number" class="form-control required" name="absen" id="absen">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label for="lembur">Lembur</label>
							  <select class="form-control" name="lembur" id="lembur">
								<option value="" readonly selected="selected">- Pilih	 -</option>
								<option value="001">Hari Raya</option>
								<option value="002">Lembur Kerja</option>
							  </select>
							</div>
						</div>
						<div class="col-md-12">
							<button class="float-right btn btn-success mt-2" id="btn-tambah"><i class="mdi mdi-content-save"></i> Input Absensi</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>

<div class="box containerAbsensi">
	<div class="box-header with-border">
		<h6 class="box-subtitle">
			<!-- <button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import Data</button> -->
		</h6>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="tbl-absensi" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>Info Karyawan</th>
						<th>Bulan</th>
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
	<!-- /.box-body -->
</div>
<!-- 
<div class="modal fade" id="mdl-absensi" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Absensi</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data" id="form-absensi">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nik">Nama Karyawan</label>
								<input type="text" class="form-control required" name="nik" id="nik" readonly
									placeholder="Nama Karyawan">
							</div>
						</div>
						<div class="col-md-8">
							<input type="hidden" name="id_outlet" id="id_outlet" value="">
							<input type="hidden" name="id_karyawan" id="id_karyawan" value="">
							<div class="form-group">
								<label>Nama Karyawan</label>
								<div class="input-group">
									<input type="text" class="form-control required" placeholder="Cari Karyawan"
										id="nama" name="nama" readonly>
									<div class="input-group-append">
										<button class="btn btn-rounded btn-info btn-sm"
											id="btn-cari-karyawan">Cari</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary float-right" id="btn-simpan">Simpan</button>
			</div>
		</div>
	</div>
</div> -->

<script>
	let act = '';
	let id_absensi = '';
	$(document).ready(function () {
		console.clear();
		$(".containerAbsensi").hide();
		$("#outlet_filter").select2();

		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btnFilter").click(function (e) {
			e.preventDefault();
			let periode_filter = $("#periode_filter").val();
			let outlet_filter = $("#outlet_filter").val();
			if (periode_filter != '' && outlet_filter != '') {
				getKaryawanOutlet(outlet_filter)
				get_data_absensi(periode_filter, outlet_filter)
				$("#form-absensi")[0].reset();
			} else {
				a_error('Maaf!', 'Silahkan pilih Periode dan outlet dahulu!');
			}
		})
		$("#btn-tambah").click(function () {
			act = 'Tambah';
			$(".id_absensi").hide();
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-absensi").modal('show');
		})
		$("#btn-simpan").click(function (e) {
			e.preventDefault();
			let check = true;
			$('.required').each(function () {
				if (this.value.trim() !== '') {
					$(this).removeClass('is-invalid');
				} else {
					$(this).addClass('is-invalid');
					check = false;
				}
			})
			if (check) {
				if (act == 'Tambah') {
					simpan(act, '');
				} else if (act == 'Edit') {
					simpan(act, id_absensi);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})

		//tbody button action
		$("#tbl-karyawan tbody").on("click", ".btnPilihKaryawan", function () {
			id_outletdetail = $(this).data("id");
			id_karyawan = $(this).data("id_karyawan");
			nik = $(this).data("nik");
			nama = $(this).data("nama");
			$("#id_karyawan").val(id_karyawan);
			$("#nama").val(nama);
			$("#nik").val(nik);
			$("#hadir").val('');
			$("#absen").val('');
			$("#lembur").val('');
		})
		$("#tbl-absensi tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$(".id_absensi").show();
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-absensi").modal('show');
			id_absensi = $(this).data("id");
			get_absensi_detail(id_absensi)
		})
		$("#tbl-absensi tbody").on("click", "#btn-hapus", function () {
			id_absensi = $(this).data("id");
			hapus_absensi(id_absensi);
		})
	})

	function get_data_absensi(periode_filter, outlet_filter) {
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
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td width='10'>Info Karyawan</td>
							<td>Bulan</td>
							<td>Hadir</td>
							<td>Absen</td>
							<td align="center">
								<a href="<?= base_url() ?>absensi/absensi-detail/` + data[i].id_absensi + `" class="btn btn-info"><i class="mdi mdi-account-network"></i> Detail</a>
								<button type="button" id="btn-edit" data-id="` + data[i].id_absensi + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_absensi + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-absensi').DataTable().clear().destroy();
				$("#tbl-absensi tbody").html(html);
				$('#tbl-absensi').dataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "25%",
							"targets": 0
						},
						{
							"width": "25%",
							"targets": 1
						},
						{
							"width": "15%",
							"targets": 2
						},
						{
							"width": "15%",
							"targets": 3
						},
						{
							"width": "15%",
							"targets": 4
						},
						{
							"width": "5%",
							"targets": 5
						},
					]
				});
				$(".containerAbsensi").show();
			}
		});
	}

	function getKaryawanOutlet(id_outlet) {
		$.ajax({
			url: base_url + 'Outlet_detail/get_data',
			data: {
				id: id_outlet
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				let html = '';
				let r = 0;
				for (let i = 0; i < data.length; i++) {
					r = i + 1;
					html += `
						<tr>
							<td class="text-center">`+ r +`</td>
							<td>
								` + data[i].nik + ` <br />
								<b>` + data[i].nama + `</b> <br />
								` + data[i].tempat_lahir + `, ` + format_tanggal(data[i].tanggal_lahir) + ` <br />
								<b>` + (data[i].jabatan || "").toUpperCase() + `</b>
							</td>
							<td class="text-center" style="vertical-align:middle;">
								<button type="button" 
									data-id="` + data[i].id_outlet + `"
									data-id_karyawan="` + data[i].id_karyawan + `"
									data-nik="` + data[i].nik + `"
									data-nama="` + data[i].nama + `"
								class="btn btn-warning btnPilihKaryawan"><i class="mdi mdi-arrow-right"></i></button>
							</td>
						</tr>
					`;
				}
				$('#tbl-karyawan').DataTable().clear().destroy();
				$("#tbl-karyawan tbody").html(html);
				$('#tbl-karyawan').dataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "1%",
							"targets": 0
						},
						{
							"width": "5%",
							"targets": 2
						}
					]
				});
			}
		});
	}

	function hapus_absensi(id_absensi) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Absensi/hapus_absensi',
				data: {
					id: id_absensi
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_absensi();
						a_ok('Berhasil!', 'Data dihapus');
					} else {
						a_error('Gagal!', 'Menghapus data');
					}
				}
			});
		}
	}

	function simpan(act) {
		$.ajax({
			url: base_url + 'Absensi/simpan_absensi/' + act + '/' + id_absensi,
			type: "POST",
			data: new FormData($("#form-absensi").get(0)),
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (res) {
				cl(res.res);
				if (res.res) {
					a_ok('Berhasil!', res.msg);
					get_absensi();
					$("#mdl-absensi").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_absensi_detail(id_absensi) {
		$.ajax({
			url: base_url + 'Absensi/get_data_detail',
			data: {
				id: id_absensi
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				if (data) {
					$("#id_absensi").val(data.id_absensi)
					$("#nama_absensi").val(data.nama_absensi)
					$("#shift_absensi").val(data.shift_absensi)
					$("#t_ot").val(data.t_ot)
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_absensi() {
		$.ajax({
			url: base_url + 'Absensi/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td width='10'>Info Karyawan</td>
							<td>Bulan</td>
							<td>Hadir</td>
							<td>Absen</td>
							<td align="center">
								<a href="<?= base_url() ?>absensi/absensi-detail/` + data[i].id_absensi + `" class="btn btn-info"><i class="mdi mdi-account-network"></i> Detail</a>
								<button type="button" id="btn-edit" data-id="` + data[i].id_absensi + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_absensi + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-absensi').DataTable().clear().destroy();
				$("#tbl-absensi tbody").html(html);
				$('#tbl-absensi').dataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "25%",
							"targets": 0
						},
						{
							"width": "25%",
							"targets": 1
						},
						{
							"width": "15%",
							"targets": 2
						},
						{
							"width": "15%",
							"targets": 3
						},
						{
							"width": "15%",
							"targets": 4
						},
						{
							"width": "5%",
							"targets": 5
						},
					]
				});
			}
		});
	}
</script>