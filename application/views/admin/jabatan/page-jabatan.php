<div class="box">
	<div class="box-header with-border">
		<h6 class="box-subtitle">
			<button class="float-right btn btn-success ml-2" id="btn-tambah"><i class="mdi mdi-plus-box-outline"></i>
				Tambah</button>
			<!-- <button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import Data</button> -->
		</h6>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="tbl-jabatan" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>Jabatan</th>
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

<div class="modal fade" id="mdl-jabatan" tabindex="-1">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Jabatan</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="jabatan">Jabatan</label>
								<input type="text" class="form-control required" name="jabatan" id="jabatan"
									placeholder="">
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
	let id_jabatan = '';
	$(document).ready(function () {
		get_jabatan();
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
			$("#mdl-jabatan").modal('show');
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
					simpan(act, id_jabatan);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})
		
		//tbody button action
		$("#tbl-jabatan tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-jabatan").modal('show');
			id_jabatan = $(this).data("id");
			get_jabatan_detail(id_jabatan)
		})
		$("#tbl-jabatan tbody").on("click", "#btn-hapus", function () {
			id_jabatan = $(this).data("id");
			hapus_jabatan(id_jabatan)
		})
	})

	function hapus_jabatan(id_jabatan) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Jabatan/hapus_jabatan',
				data: {
					id: id_jabatan
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_jabatan();
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
			url: base_url + 'Jabatan/simpan_jabatan/' + act + '/' + id_jabatan,
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
					get_jabatan();
					$("#mdl-jabatan").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_jabatan_detail(id_jabatan) {
		$.ajax({
			url: base_url + 'Jabatan/get_data_detail',
			data: {
				id: id_jabatan
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				if (data) {
					$("#jabatan").val(data.jabatan)
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_jabatan() {
		$.ajax({
			url: base_url + 'Jabatan/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>` + data[i].jabatan + `</td>
							<td align="center">
								<button type="button" id="btn-edit" data-id="` + data[i].id_jabatan + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_jabatan + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-jabatan').DataTable().clear().destroy();
				$("#tbl-jabatan tbody").html(html);
				$('#tbl-jabatan').DataTable();
			}
		});
	}

</script>
