<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Karyawan</h3>
		<h6 class="box-subtitle">
			Biodata lengkap Karyawan PT Wira Pradana Mukti
			<button class="float-right btn btn-success ml-2" id="btn-tambah"><i class="mdi mdi-plus-box-outline"></i>
				Tambah</button>
			<button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import
				Data</button>
		</h6>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="tbl-karyawan" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>Foto</th>
						<th>Info Karyawan</th>
						<th>Alamat</th>
						<th>Pendidikan</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<!-- <tr>
						<td width="25%">Info Karyawan</td>
						<td width="15%">Alamat</td>
						<td width="15%">Pendidikan</td>
						<td width="15%">Pengalaman</td>
						<td width="15%">Pelatihan</td>
						<td width="15%">Foto</td>
					</tr> -->
				</tbody>
				<tfoot>
					<!-- <tr>
						<th>Info Karyawan</th>
						<th>Alamat</th>
						<th>Pendidikan</th>
						<th>Pengalaman</th>
						<th>Pelatihan</th>
						<th>Foto</th>
					</tr> -->
				</tfoot>
			</table>
		</div>
	</div>
	<!-- /.box-body -->
</div>

<div class="modal fade" id="mdl-karyawan" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Karyawan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="nik">NIK</label>
								<input type="text" class="form-control required" name="nik" id="nik"
									placeholder="16 Digit NIK">
							</div>
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="nama">Nama Karyawan</label>
								<input type="text" class="form-control required" name="nama" id="nama"
									placeholder="Nama Karyawan">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="status">Status</label>
								<input type="text" class="form-control required" name="status" id="status"
									placeholder="Status">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="tempat_lahir">Tempat Lahir</label>
								<input type="text" class="form-control required" name="tempat_lahir" id="tempat_lahir"
									placeholder="Tempat Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="tanggal_lahir">Tanggal Lahir</label>
								<input type="date" class="form-control required" name="tanggal_lahir" id="tanggal_lahir"
									placeholder="Tanggal Lahir">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="agama">Agama</label>
								<input type="text" class="form-control required" name="agama" id="agama"
									placeholder="Agama">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="suku">Suku</label>
								<input type="text" class="form-control required" name="suku" id="suku"
									placeholder="Suku">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="handphone">Telepon</label>
								<input type="text" class="form-control required" name="handphone" id="handphone"
									placeholder="handphone">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="tinggi">Tinggi Badan</label>
								<input type="number" class="form-control required" name="tinggi" id="tinggi"
									placeholder="170">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="berat">Berat Badan</label>
								<input type="number" class="form-control required" name="berat" id="berat"
									placeholder="75">
							</div>
						</div>
						<div class="col-md-6"></div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="alamat">Alamat</label>
								<textarea name="alamat" id="alamat" cols="10" rows="3"
									class="form-control required"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pendidikan">Pendidikan</label>
								<textarea name="pendidikan" id="pendidikan" cols="10" rows="3"
									class="form-control required"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pengalaman">Pengalaman Kerja</label>
								<textarea name="pengalaman" id="pengalaman" cols="10" rows="3"
									class="form-control required"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="pelatihan">Pelatihan Kerja</label>
								<textarea name="pelatihan" id="pelatihan" cols="10" rows="3"
									class="form-control required"></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Foto Karyawan <span class="text-danger">(MAX 500Kb)</span></label>
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="gambar_karyawan"
										name="gambar_karyawan">
									<label class="custom-file-label" for="gambar_karyawan">Pilih gambar</label>
								</div>
							</div>
						</div>
						<div class="col-md-6 text-center">
							<img id="img-prev" src="" width="100px">
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

<div class="modal fade" id="mdl-import" tabindex="-1" role="dialog" aria-labelledby="mdl-importLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="mdl-importLabel">Import List Pasien</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo base_url(); ?>karyawan/import_karyawan" method="post" id="import_form"
				enctype="multipart/form-data">
				<div class="modal-body">
					<p>Jika belum memiliki template import, silahkan download terlebih dahulu!</p>
					<a href="<?= base_url() ?>assets/template-import/template-import-karyawan.xlsx">
						<button type="button" class="btn btn-warning mb-3">Download Template (.xlsx)</button>
					</a>
					<p>Jika sudah memiliki template import data, silahkan isi dan upload file disini</p>
					<div class="form-group">
						<label for="uploadFile">Import Template File (.xlsx)</label>
						<input type="file" name="uploadFile" id="uploadFIle" class="form-control" id="uploadFile"
							required accept=".xls, .xlsx">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Import</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	let act = '';
	let id_karyawan = '';
	$(document).ready(function () {
		get_karyawan();
		$('#tbl-karyawan').DataTable({
			// dom: 'Bfrtip',
			// buttons: [
			// 	'csv', 'excel', 'pdf', 'print'
			// ]
		});

		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btn-tambah").click(function () {
			act = 'Tambah';
			$("#act").text(act);
			$("form")[0].reset();
			$('.custom-file-label').html('Pilih Gambar');
			$("#img-prev").attr('src', '');
			$("#mdl-karyawan").modal('show');
		})
		$("#btn-simpan").click(function () {
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
					simpan(act, id_karyawan);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})
		//tbody button action
		$("#tbl-karyawan tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-karyawan").modal('show');
			id_karyawan = $(this).data("id");
			get_karyawan_detail(id_karyawan)
		})
		$("#tbl-karyawan tbody").on("click", "#btn-hapus", function () {
			id_karyawan = $(this).data("id");
			hapus_karyawan(id_karyawan)
		})

		//file input
		$('#gambar_karyawan').on('change', function () {
			var fileName = $(this).val();
			$(this).next('.custom-file-label').html(fileName);
			preview_img(this, 'img-prev');
		})
	})

	function hapus_karyawan(id_karyawan) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Karyawan/hapus_karyawan',
				data: {
					id: id_karyawan
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_karyawan();
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
			url: base_url + 'Karyawan/simpan_karyawan/' + act + '/' + id_karyawan,
			type: "POST",
			data: new FormData($("form").get(0)),
			cache: false,
			contentType: false,
			processData: false,
			dataType: 'json',
			success: function (res) {
				cl(res.res);
				if (res.res) {
					a_ok('Berhasil!', res.msg);
					get_karyawan();
					$("#mdl-karyawan").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_karyawan_detail(id_karyawan) {
		$.ajax({
			url: base_url + 'Karyawan/get_data_detail',
			data: {
				id: id_karyawan
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				ct(data)
				if (data) {
					$("#nik").val(data.nik)
					$("#nama").val(data.nama)
					$("#status").val(data.status)
					$("#tempat_lahir").val(data.tempat_lahir)
					$("#tanggal_lahir").val(data.tanggal_lahir)
					$("#agama").val(data.agama)
					$("#suku").val(data.suku)
					$("#handphone").val(data.handphone)
					$("#tinggi").val(data.tinggi)
					$("#berat").val(data.berat)
					$("#alamat").val(data.alamat)
					$("#pendidikan").val(data.pendidikan)
					$("#pengalaman").val(data.pengalaman)
					$("#pelatihan").val(data.pelatihan)
					$('.custom-file-label').html(data.foto);
					$('#img-prev').attr('src', base_url + 'assets/img/karyawan/' + data.foto);
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_karyawan() {
		$.ajax({
			url: base_url + 'Karyawan/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					let foto = (data[i].foto == '') ? 'default.png' : data[i].foto;
					html += `
						<tr>
							<td v-align="center"><img src="` + base_url + "assets/img/karyawan/" + foto + `"></td>
							<td>
								` + data[i].nik + ` <br />
								<b>` + data[i].nama + `</b> <br />
								` + data[i].tempat_lahir + `, ` + format_tanggal(data[i].tanggal_lahir) + `
							</td>
							<td width="100px">` + data[i].alamat + `</td>
							<td>` + data[i].pendidikan + `</td>
							<td>
								<button type="button" id="btn-edit" data-id="` + data[i].id_karyawan + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_karyawan + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-karyawan').DataTable().clear().destroy();
				$("#tbl-karyawan tbody").html(html);
				$('#tbl-karyawan').DataTable({
					// dom: 'Bfrtip',
					// buttons: [
					// 	'csv', 'excel', 'pdf', 'print'
					// ]
				});
			}
		});
	}

</script>
