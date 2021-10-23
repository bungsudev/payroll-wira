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
						<th>Kode</th>
						<th>Nama Outlet</th>
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
	<div class="modal-dialog modal-lg">
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
						<div class="col-md-3 id_outlet">
							<div class="form-group">
								<label for="id_outlet">Kode</label>
								<input type="text" class="form-control" name="id_outlet" id="id_outlet"
									readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="nama_outlet">Nama Outlet</label>
								<input type="text" class="form-control required" name="nama_outlet" id="nama_outlet"
									placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="alamat">Alamat Outlet</label>
								<input type="text" class="form-control required" name="alamat" id="alamat"
									placeholder="">
							</div>
						</div>
						<?php $this->load->view('admin/karyawan/page-karyawanDetail'); ?>
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
		// $("#mdl-outlet").modal('show');
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btn-tambah").click(function () {
			act = 'Tambah';
			$(".id_outlet").hide();
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
				$('input.number').each(function(event) {
					$(this).val(formatBackNumber($(this).val()));
				});
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
			$(".id_outlet").show();
			$("#act").text(act);
			$("form")[0].reset();
			$("#mdl-outlet").modal('show');
			id_outlet = $(this).data("id");
			get_outlet_detail(id_outlet)
			$('input.number').each(function(event) {
				$(this).val(numberFormat($(this).val()));
			});
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
			async:false,
			success: function (data) {
				if (data) {
					$("#id_outlet").val(data.id_outlet)
					$("#nama_outlet").val(data.nama_outlet)
					$("#alamat").val(data.alamat)
					$("#shift_outlet").val(data.shift_outlet)
					$("#g_pkk").val(data.g_pkk)
					$("#b_spkwt").val(data.b_spkwt)
					$("#t_jbt").val(data.t_jbt)
					$("#t_trans").val(data.t_trans)
					$("#t_ot").val(data.t_ot)
					$("#jst").val(data.jst)
					$("#dpst").val(data.dpst)
					$("#srg").val(data.srg)
					$("#bpdd").val(data.bpdd)
					$("#bpjs_kesehatan").val(data.bpjs_kesehatan)
					$("#bpjs_tk").val(data.bpjs_tk)
					$("#bpjs_jp").val(data.bpjs_jp)
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
							<td width='10'>` + data[i].id_outlet + `</td>
							<td>` + data[i].nama_outlet + `</td>
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
				$('#tbl-outlet').dataTable( {
					"autoWidth": false,
					"columnDefs": [
						{ "width": "1%", "targets": 0 },
						{ "width": "5%", "targets": 2 },
					]
				});
			}
		});
	}
</script>