<div class="box">
	<div class="box-header with-border">
		<h6 class="box-subtitle">
			<button class="float-right btn btn-success ml-2" id="btnTambah"><i class="mdi mdi-plus-box-outline"></i>
				Tambah</button>
			<!-- <button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import Data</button> -->
		</h6>

	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="table-responsive">
			<table id="tblLembur" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
				<thead>
					<tr>
						<th>ID Lembur</th>
						<th>Nama Lembur</th>
						<th>Nilai</th>
						<th>Keterangan</th>
						<th>Status</th>
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

<div class="modal fade" id="mdlLembur" tabindex="-1">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Lembur</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form ecntype="multipart/form-data">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="nama">Nama Lembur</label>
								<input type="text" class="form-control required required" name="nama" id="nama"
									placeholder="">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
							  <label for="jenis_nilai">Perhitungan</label>
							  <select class="form-control required" name="jenis_nilai" id="jenis_nilai">
								<option value="" selected readonly> -Pilih- </option>
								<option value="rp">Rupiah (Rp)</option>
								<option value="persen">Persen (%)</option>
							  </select>
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label for="nilai">Nilai Lembur</label>
								<input type="number" class="form-control required required" name="nilai" id="nilai" readonly>
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="status">Status</label>
								<select class="form-control required" name="status" id="status">
									<option value="aktif" selected>Aktif</option>
									<option value="non aktif">Non Aktif</option>
								</select>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
							  <label for="keterangan">Keterangan</label>
							  <textarea class="form-control required" name="keterangan" id="keterangan" rows="3"></textarea>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary float-right" id="btnSimpan">Simpan</button>
			</div>
		</div>
	</div>
</div>

<script>
	let act = '';
	let id_lembur = '';
	$(document).ready(function () {
		get_lembur();
		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#jenis_nilai").change(function(){
			let jenis_nilai = $(this).val();
			$("#nilai").removeAttr('readonly');
		})
		$("#btnTambah").click(function () {
			act = 'Tambah';
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdlLembur").modal('show');
		})
		$("#btnSimpan").click(function (e) {
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
					simpan(act, id_lembur);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})

		//tbody button action
		$("#tblLembur tbody").on("click", "#btn-edit", function () {
			act = "Edit";
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdlLembur").modal('show');
			id_lembur = $(this).data("id");
			get_lembur_detail(id_lembur)
		})
		$("#tblLembur tbody").on("click", "#btn-hapus", function () {
			id_lembur = $(this).data("id");
			hapus_lembur(id_lembur)
		})
	})

	function hapus_lembur(id_lembur) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Lembur/hapus_lembur',
				data: {
					id: id_lembur
				},
				method: "POST",
				dataType: "json",
				success: function (data) {
					if (data) {
						get_lembur();
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
			url: base_url + 'Lembur/simpan_lembur/' + act + '/' + id_lembur,
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
					get_lembur();
					$("#mdlLembur").modal('hide');
				} else {
					a_error('Gagal!', res.msg);
				}
			}
		});
	}

	function get_lembur_detail(id_lembur) {
		$.ajax({
			url: base_url + 'Lembur/get_data_detail',
			data: {
				id: id_lembur
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				if (data) {
					$("#nama").val(data.nama)
					$("#jenis_nilai").val(data.jenis_nilai)
					$("#nilai").val(data.nilai)
					$("#keterangan").val(data.keterangan)
					$("#status").val(data.status)
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_lembur() {
		$.ajax({
			url: base_url + 'Lembur/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					let jenis_nilai, btn_warna = '';
					(data[i].jenis_nilai == 'rp')? jenis_nilai = "Rp. " + numberFormat(data[i].nilai) : jenis_nilai = data[i].nilai + " %";
					(data[i].status == 'aktif')? btn_warna = "success" : btn_warna = "danger";
					html += `
						<tr>
							<td>`+ data[i].id_lembur +`</td>
							<td>`+ data[i].nama +`</td>
							<td>`+ jenis_nilai +`</td>
							<td>`+ data[i].keterangan +`</td>
							<td><span class="badge badge-`+ btn_warna +`">`+ data[i].status +`</span></td>
							<td align="center">
								<button type="button" id="btn-edit" data-id="` + data[i].id_lembur + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_lembur + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tblLembur').DataTable().clear().destroy();
				$("#tblLembur tbody").html(html);
				$('#tblLembur').DataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "10%",
							"targets": 0
						},
						{
							"width": "5%",
							"targets": 2
						},
						{
							"width": "5%",
							"targets": 4
						},
						{
							"width": "5%",
							"targets": 5
						}
					]
				});
			}
		});
	}
</script>