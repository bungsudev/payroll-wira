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

<div class="box containerAbsensi">
	<div class="box-body">
		<div class="row">
			<div class="col-md-6">
				<div class="table-responsive">
					<table id="tbl-karyawan"
						class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
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
				<form ecntype="multipart/form-data" id="formAbsensi">
					<div class="row">
						<input type="hidden" name="id_outlet" id="id_outlet">
						<input type="hidden" name="id_karyawan" id="id_karyawan">
						<input type="hidden" name="bulan" id="bulan" value="<?= date("m") ?>">
						<input type="hidden" name="periode" id="periode">
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
						<div class="col-md-6">
							<div class="form-group">
								<label for="hadir">Hadir</label>
								<input type="number" class="form-control required" name="hadir" id="hadir">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="absen">Absen</label>
								<input type="number" class="form-control required" name="absen" id="absen">
							</div>
						</div>
						<div id="inputanLembur"></div>

						<div class="col-md-12">
							<button class="float-right btn btn-success mt-2 ml-2" id="btnTambah"><i
									class="mdi mdi-content-save"></i> <span id="txtTambah">Selesai</span></button>
							<button class="float-right btn btn-info mt-2" id="btnTambahLemburMdl"><i
									class="mdi mdi-plus-box-outline"></i> Input Lembur</button>
						</div>
					</div>
				</form>
			</div>
		</div>
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
									<option value="" selected>-Pilih-</option>
									<option value="001">Lembur Harian</option>
									<option value="002">Hari Raya Waisak</option>
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
	let act = '';
	let id_absensi = '';
	let periode_filter, outlet_filter = '';
	$(document).ready(function () {
		console.clear();
		$('#tblLembur').DataTable({
			"autoWidth": false,
			"columnDefs": [{
					"width": "94%",
					"targets": 0
				},
				{
					"width": "5%",
					"targets": 1
				},
				{
					"width": "1%",
					"targets": 2
				}
			]
		});

		//note selesaikan input absensi
		let dtTblLembur = $("#tblLembur").DataTable();
		$(".containerAbsensi").hide();
		$("#outlet_filter").select2();
		//button action
		$("#btnFilter").click(function (e) {
			e.preventDefault();
			periode_filter = $("#periode_filter").val();
			outlet_filter = $("#outlet_filter").val();
			if (periode_filter != '' && outlet_filter != '') {
				$('#tblAbsensi').DataTable().clear().destroy();
				getKaryawanOutlet(outlet_filter)
				getAbsensi(periode_filter, outlet_filter)
				$(".delthis").remove();
				$("#formAbsensi")[0].reset();
			} else {
				a_error('Maaf!', 'Silahkan pilih Periode dan outlet dahulu!');
			}
		})
		$("#btnTambahLemburMdl").click(function (e) {
			e.preventDefault();
			if (act == 'Tambah') {
				dtTblLembur.clear().draw();
			}
			$("#mdlLembur").modal('show')
		})
		$("#btnSimpanLembur").click(function (e) {
			e.preventDefault();
			let check = true;
			$('.requiredLembur').each(function () {
				if (this.value.trim() !== '') {
					$(this).removeClass('is-invalid');
				} else {
					$(this).addClass('is-invalid');
					check = false;
				}
			})
			if (check) {
				let jenis_lembur = $('#jenis_lembur').val();
				let jenis_lembur_text = $('#jenis_lembur :selected').text();
				let tanggal_lembur = $('#tanggal_lembur').val();
				let form_lembur = jenis_lembur + ' - ' + jenis_lembur_text + '&' + tanggal_lembur;
				let btnHapusLembur =
					'<button class="btn btn-rounded btn-danger btn-sm btnHapusLembur"><i class="mdi mdi-playlist-remove"></i></button>';

				//addKeTable
				dtTblLembur.row.add([jenis_lembur + ' - ' + jenis_lembur_text, tanggal_lembur,
					btnHapusLembur
				]).draw();
			}
		})
		$("#btnTambah").click(function (e) {
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
		$("#btnSelesaiLembur").click(function (e) {
			var heads = [];

			$("#tblLembur thead").find("th").each(function () {
				heads.push($(this).text().replace(' ', ''));
			});
			var rows = [];
			$("#tblLembur tbody tr").each(function () {
				cur = {};
				$(this).find("td").each(function (i, v) {
					cur[heads[i]] = $(this).text().trim();
				});
				rows.push(cur);
				cur = {};
			});
			appendInputLembur(rows);
			$("#mdlLembur").modal('hide');
		})

		//tbody button action
		$("#formAbsensi").on("click", ".btnHapusLemburX", function (e) {
			e.preventDefault();
			let id = $(this).data('id');
			$("." + id).remove();
		})
		$("#tblLembur tbody").on("click", ".btnHapusLembur", function () {
			dtTblLembur.row($(this).parents('tr'))
				.remove()
				.draw();
		})
		$("#tbl-karyawan tbody").on("click", ".btnPilihKaryawan", function () {
			act = 'Tambah';
			$("#txtTambah").text('Selesai');
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
		$("#tblAbsensi tbody").on("click", "#btnEdit", function () {
			act = "Edit";
			$('html, body').animate({
				scrollTop: $(".main-header").offset().top
			}, 1000);
			$("#hadir").focus();
			$("#formAbsensi")[0].reset();
			$(".delthis").remove();
			id_absensi = $(this).data("id");
			getAbsensiDtl(id_absensi)
		})
		$("#tblAbsensi tbody").on("click", "#btnHapus", function () {
			id_absensi = $(this).data("id");
			hapus_absensi(id_absensi);
		})
	})

	function getAbsensiDtl(id_absensi) {
		$.ajax({
			url: base_url + 'Absensi/getAbsensiDtl',
			data: {
				id_absensi: id_absensi
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				if (data) {
					$("#id_outlet").val(data.id_outlet);
					$("#id_karyawan").val(data.id_karyawan);
					$("#bulan").val(data.bulan);
					$("#periode").val(data.periode);
					$("#nik").val(data.nik);
					$("#nama").val(data.nama);
					$("#hadir").val(data.hadir);
					$("#absen").val(data.absen);
					$("#txtTambah").text('Selesai Edit');

					let lembur = data.lembur;
					lembur = lembur.split(',');

					let dataLembur = [];
					$.each(lembur, function (i, val) {
						let lemburDtl = '';
						lemburDtl = val.split('|');
						dataLembur[i] = {
							"JenisLembur": lemburDtl[0],
							"Tanggal": lemburDtl[1]
						}

						let btnHapusLembur =
							'<button class="btn btn-rounded btn-danger btn-sm btnHapusLembur"><i class="mdi mdi-playlist-remove"></i></button>';

						//addKeTable
						$('#tblLembur').DataTable().row.add([lemburDtl[0], lemburDtl[1],
							btnHapusLembur]).draw();
					})
					appendInputLembur(dataLembur)
				} else {
					a_error('Gagal!', 'Menghapus data');
				}
			}
		});
	}

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
								<button type="button" id="btnEdit" data-id="` + data[i].id_absensi + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
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

	function getKaryawanOutlet(id_outlet) {
		$.ajax({
			url: base_url + 'Absensi/get_karyawanOutlet',
			data: {
				id_outlet: id_outlet
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				let r = 0;
				for (let i = 0; i < data.length; i++) {
					r = i + 1;
					html += `
						<tr>
							<td class="text-center">` + r + `</td>
							<td>
								` + data[i].nik + ` <br />
								<b>` + data[i].nama + `</b> <br />
								` + data[i].tempat_lahir + `, ` + format_tanggal(data[i].tanggal_lahir) + ` <br />
								<b>` + (data[i].jabatan || "").toUpperCase() + `</b>
							</td>
							<td class="text-center" style="vertical-align:middle;">
								<button type="button" 
									data-id="` + data[i].idOutlet + `"
									data-id_karyawan="` + data[i].idKaryawan + `"
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
						getAbsensi(periode_filter, outlet_filter);
						a_ok('Berhasil!', 'Data dihapus');
					} else {
						a_error('Gagal!', 'Menghapus data');
					}
				}
			});
		}
	}

	function simpan(act, id_absensi) {
		$.ajax({
			url: base_url + 'Absensi/simpan_absensi/' + act + '/' + id_absensi,
			type: "POST",
			data: new FormData($("#formAbsensi").get(0)),
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (res) {
				if (res.res) {
					a_ok('Berhasil!', res.msg);
					$("#formAbsensi")[0].reset();
					$("#inputanLembur").empty();
					$(".delthis").remove();
					getKaryawanOutlet(outlet_filter);
					getAbsensi(periode_filter, outlet_filter);
					$("#mdl-absensi").modal('hide');
					action = 'Tambah';
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function appendInputLembur(data) {
		let r = 0;
		let html = '';
		for (let i = 0; i < data.length; i++) {
			let classRnd = Math.floor(Math.random() * 999999999);
			r++;
			html += `
				<div class="col-md-7 delthis ` + classRnd + `">
					<div class="form-group">
						<label for="jenisLembur">Jenis Lembur ` + r + `</label>
						<input type="text" class="form-control" name="jenisLembur[]" readonly value="` + data[i].JenisLembur + `">
					</div>
				</div>
				<div class="col-md-5 delthis ` + classRnd + `">
					<label for="tanggalLembur">Tanggal Lembur ` + r + `</label>
					<div class="input-group mb-3">
						<input type="text" class="form-control" name="tanggalLembur[]" readonly value="` + data[i].Tanggal + `">
						<div class="input-group-append">
							<button class="btn btn-danger text-white btnHapusLemburX" data-id="` + classRnd + `" style="cursor: pointer;"><i class="mdi mdi-playlist-remove"></i></button>
						</div>
					</div>
				</div>
			`;
		}
		$("#inputanLembur").after(html);
	}
</script>