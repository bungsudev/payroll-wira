<div class="box">
	<div class="box-header with-border">
		<h6 class="box-subtitle">
			<button class="float-right btn btn-success ml-2" id="btn-tambah"><i
					class="mdi mdi-account-multiple-plus"></i>
				Karyawan Outlet</button>
			<a href="<?= base_url(); ?>outlet" class="btn btn-warning"><i class="mdi mdi-backburger"></i> Kembali</a>
			<!-- <button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import Data</button> -->
			<a href="<?= base_url(); ?>outlet/outlet-detail/print/<?= $this->uri->segment(3) ?>" target="_blank" class="float-right btn btn-primary btnCetak"><i class="fa fa-print"></i></a>
		</h6>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="tbl-outlet" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>Info Karyawan</th>
						<th>Jam Kerja</th>
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

<div class="modal fade" id="mdl-karyawan" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cari Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table id="tbl-karyawan" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th>ID Karyawan</th>
							<th>Nama Karyawan</th>
							<th></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mdl-outlet" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Karyawan Outlet</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data" id="form-outlet">
					<div class="row">
						<div class="col-md-12">
							<input type="hidden" name="id_outlet" id="id_outlet" value="<?= $outlet->id_outlet ?>">
							<input type="hidden" name="id_karyawan" id="id_karyawan" value="">
							<div class="form-group">
								<label>Nama Karyawan</label>
								<div class="input-group">
									<input type="text" class="form-control required" placeholder="Cari Karyawan"
										id="nik" name="nik" readonly>
									<div class="input-group-append">
										<button class="btn btn-rounded btn-info btn-sm"
											id="btn-cari-karyawan">Cari</button>
									</div>
								</div>
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
								<label for="shift_karyawan">Jam Kerja</label>
								<select class="form-control required" name="shift_karyawan" id="shift_karyawan">
									<option value="">-Pilih-</option>
									<?php
										if ($outlet->shift_outlet == '1') {
											echo "<option value='1'>Shift 1</option>";
										}else if ($outlet->shift_outlet == '2'){
											echo "<option value='1'>Shift 1</option>";
											echo "<option value='2'>Shift 2</option>";
										}
									?>
								</select>
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
</div>

<script>
	let act = '';
	let id_outletdetail = '';
	let id_outlet = $("#id_outlet").val();
	$(document).ready(function () {
		get_outlet(id_outlet);

		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btn-cari-karyawan").click(function (e) {
			e.preventDefault();
			$("#mdl-outlet").modal('hide');
			get_karyawan()
		})
		$("#btn-tambah").click(function () {
			act = 'Tambah';
			$("#btn-cari-karyawan").removeAttr("disabled", true);
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-outlet").modal('show');
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
			console.log(check)
			if (check) {
				if (act == 'Tambah') {
					simpan(act, '');
				} else if (act == 'Edit') {
					simpan(act, id_outletdetail);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})

		//tbody button action
		$("#tbl-karyawan tbody").on("click", ".btn-pilih-karyawan", function () {
			id_outletdetail = $(this).data("id");
			id_karyawan = $(this).data("id_karyawan");
			nik = $(this).data("nik");
			nama = $(this).data("nama");
			$("#id_karyawan").val(id_karyawan);
			$("#nama").val(nama);
			$("#nik").val(nik);
			$("#mdl-outlet").modal('show');
			$("#mdl-karyawan").modal('hide');
		})
		$("#tbl-outlet tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$("#btn-cari-karyawan").attr("disabled", true);
			$("#act").text(act);
			$("#form-outlet")[0].reset();
			$("#mdl-outlet").modal('show');
			id_outletdetail = $(this).data("id");
			get_outlet_detail(id_outletdetail)
		})
		$("#tbl-outlet tbody").on("click", "#btn-hapus", function () {
			id_outletdetail = $(this).data("id");
			console.log(id_outletdetail);
			hapus_outlet(id_outletdetail)
		})
	})

	function get_karyawan() {
		$.ajax({
			url: base_url + 'Karyawan/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>` + data[i].nik + `</td>
							<td>` + data[i].nama + `</td>
							<td class="text-center">
								<button type="button" 
									data-id="` + data[i].id_outlet + `"
									data-id_karyawan="` + data[i].id_karyawan + `"
									data-nik="` + data[i].nik + `"
									data-nama="` + data[i].nama + `"
								class="btn btn-warning btn-pilih-karyawan"><i class="mdi mdi-account-plus"></i></button>
							</td>
						</tr>
					`;
				}
				$('#tbl-karyawan').DataTable().clear().destroy();
				$("#tbl-karyawan tbody").html(html);
				$('#tbl-karyawan').DataTable();
				$("#mdl-karyawan").modal('show');
			}
		});
	}

	function hapus_outlet(id_outletdetail) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Outlet/hapus_outlet_detail',
				data: {
					id: id_outletdetail
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_outlet(id_outletdetail);
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
			url: base_url + 'Outlet_detail/simpan_outlet_karyawan/' + act + '/' + id_outletdetail,
			type: "POST",
			data: new FormData($("#form-outlet").get(0)),
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (res) {
				cl(res.res);
				if (res.res) {
					a_ok('Berhasil!', res.msg);
					get_outlet(id_outlet);
					$("#mdl-outlet").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_outlet_detail(id_outletdetail) {
		$.ajax({
			url: base_url + 'Outlet_detail/get_data_detail',
			data: {
				id: id_outletdetail
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				if (data) {
					$("#id_karyawan").val(data.id_karyawan);
					$("#id_outlet").val(data.id_outlet);
					$("#nama").val(data.nama);
					$("#nik").val(data.nik);
					$("#shift_karyawan").val(data.shift_karyawan);
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_outlet(id_outlet) {
		$.ajax({
			url: base_url + 'Outlet_detail/get_data',
			data:{
				id:id_outlet
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>
								` + data[i].nik + ` <br />
								<b>` + data[i].nama + `</b> <br />
								` + data[i].tempat_lahir + `, ` + format_tanggal(data[i].tanggal_lahir) + ` <br />
								<b>` + (data[i].jabatan || "").toUpperCase() + `</b>
							</td>
							<td>Shift ` + data[i].shift_karyawan + `</td>
							<td align="center">
								<button type="button" id="btn-edit" data-id="` + data[i].id_outletdetail + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_outletdetail + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-outlet').DataTable().clear().destroy();
				$("#tbl-outlet tbody").html(html);
				$('#tbl-outlet').DataTable();
			}
		});
	}
</script>