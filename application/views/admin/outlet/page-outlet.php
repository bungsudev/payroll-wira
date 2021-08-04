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
			<table id="tbl-outlet" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>ID Outlet</th>
						<th>Nama Outlet</th>
						<th>Shift Outlet</th>
						<th>Tunjangan Outlet</th>
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

<div class="modal fade" id="mdl-outlet" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Outlet</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data" id="form-outlet">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="nama_outlet">Nama Outlet</label>
								<input type="text" class="form-control required" name="nama_outlet" id="nama_outlet"
									placeholder="">
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label for="shift_outlet">Jam Kerja</label>
							  <select class="form-control" name="shift_outlet" id="shift_outlet">
								<option value="">-Pilih-</option>
								<option value="1">1 Shift</option>
								<option value="2">2 Shift</option>
							  </select>
							</div>
						</div>
						<div class="col-md-9">
							<div class="form-group">
								<label for="tunjangan_outlet">Tunjangan Outlet</label>
								<input type="number" class="form-control required" name="tunjangan_outlet" id="tunjangan_outlet" value="0">
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
	let id_outlet = '';
	$(document).ready(function () {
		get_outlet();
		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btn-tambah").click(function () {
			act = 'Tambah';
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
			if (check) {
				if (act == 'Tambah') {
					simpan(act, '');
				} else if (act == 'Edit') {
					simpan(act, id_outlet);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})
		
		//tbody button action
		$("#tbl-outlet tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-outlet").modal('show');
			id_outlet = $(this).data("id");
			get_outlet_detail(id_outlet)
		})
		$("#tbl-outlet tbody").on("click", "#btn-hapus", function () {
			id_outlet = $(this).data("id");
			hapus_outlet(id_outlet)
		})
	})

	function hapus_outlet(id_outlet) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Outlet/hapus_outlet',
				data: {
					id: id_outlet
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_outlet();
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
			url: base_url + 'Outlet/simpan_outlet/' + act + '/' + id_outlet,
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
					get_outlet();
					$("#mdl-outlet").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_outlet_detail(id_outlet) {
		$.ajax({
			url: base_url + 'Outlet/get_data_detail',
			data: {
				id: id_outlet
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				if (data) {
					$("#nama_outlet").val(data.nama_outlet)
					$("#shift_outlet").val(data.shift_outlet)
					$("#tunjangan_outlet").val(data.tunjangan_outlet)
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_outlet() {
		$.ajax({
			url: base_url + 'Outlet/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				console.log(data)
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>` + data[i].id_outlet + `</td>
							<td>` + data[i].nama_outlet + `</td>
							<td>` + data[i].shift_outlet + ` Shift</td>
							<td>Rp. ` + data[i].tunjangan_outlet + `</td>
							<td align="center">
								<a href="<?= base_url() ?>outlet/outlet-detail/` + data[i].id_outlet + `" class="btn btn-info"><i class="mdi mdi-account-network"></i> Detail</a>
								<button type="button" id="btn-edit" data-id="` + data[i].id_outlet + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_outlet + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
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
