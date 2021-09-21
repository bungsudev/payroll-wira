<style>
	.dataTables_wrapper .form-control{
		padding:none !important;
	}
</style>
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
						Proses </button>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="box" id="secTbl">
	<div class="box-header with-border">
		<h6 class="box-subtitle">
			<!-- <button class="float-right btn btn-info" id="btn-import"><i class="mdi mdi-file-import"></i> Import Data</button> -->
		</h6>
	</div>
	<div class="box-body">
		<div class="table-responsive">
			<form id="formCek">
				<table id="tblCekPrint" class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
					<thead>
						<tr>
							<th width="1">No</th>
							<th>Info Karyawan</th>
							<th>LBU</th>
							<th>LHK</th>
							<th>LLR</th>
							<th>KBL</th>
							<th>SP</th>
							<th>LL</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</form>
		</div>
		<div class="row">
			<div class="col-md-12">
				<button class="float-right btn btn-warning mt-2 ml-2" id="btnTambah"><i
						class="mdi mdi-content-save"></i> 
						<span id="txtTambah">
							Simpan & Print
						</span>
				</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="mdlCek" tabindex="-1">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><span id="act"></span> Buat Laporan PPP SDM</h5>
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table id="tblCekPrint"
						class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
						<thead>
							<tr>
								<th width="1">No</th>
								<th>Info Karyawan</th>
								<th>LBU</th>
								<th>LHK</th>
								<th>KBL</th>
								<th>LLR</th>
								<th>KBL</th>
								<th>SP</th>
								<th>LL</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer modal-footer-uniform">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
				<button type="button" class="btn btn-primary float-right" id="btnSimpan">Simpan & Print</button>
			</div>
		</div>
	</div>
</div>
<script>
	let act = '';
	let id_outlet = '';
	$("#secTbl").hide();
	$(document).ready(function () {
		$("body").addClass("sidebar-collapse");
		get_pppsdm();
		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
		})
		$("#btnTambah").click(function () {
			let periode = $("#periode_filter").val();
			id_outlet = $("#outlet_filter").val();
			$('#tblCekPrint').find('input[type=number]').each(function () {
				let data = [];
				let data_input = $(this).attr('name').split('_');
				let input_type = data_input[0];
				let id_karyawan = data_input[1];
				let kbl, sp, llr, lhk, lain, lbu = 0;
				if (input_type == 'kbl') {
					kbl = this.value;
					sp = 0;
					lhk = 0;
					llr = 0;
					lbu = 0;
					lain = 0;
				} else if (input_type == 'sp') {
					kbl = 0;
					sp = this.value;
					lhk = 0;
					llr = 0;
					lbu = 0;
					lain = 0;
				}  else if (input_type == 'lhk') {
					kbl = 0;
					sp = 0;
					lhk = this.value;
					llr = 0;
					lbu = 0;
					lain = 0;
				}  else if (input_type == 'llr') {
					kbl = 0;
					sp = 0;
					lhk = 0;
					llr = this.value;
					lbu = 0;
					lain = 0;
				} else if (input_type == 'lbu') {
					kbl = 0;
					sp = 0;
					lhk = 0;
					llr = 0;
					lbu = this.value;
					lain = 0;
				} else if (input_type == 'lain') {
					kbl = 0;
					sp = 0;
					lhk = 0;
					llr = 0;
					lbu = 0;
					lain = this.value;
				}
				update_detail_cek(input_type, periode, id_karyawan, kbl, sp, lhk, llr, lbu, lain);
			});
			a_ok('Berhasil!', 'Berhasil menyimpan dan mencetak data');
			let link = base_url + 'ppp_sdm/print/'+ id_outlet +'/' + periode;
			window.open(link, link);
		})
		$("#btnFilter").click(function (e) {
			e.preventDefault();
			outlet_filter = $("#outlet_filter").val();
			periode_filter = $("#periode_filter").val();
			if (periode_filter != '' && outlet_filter != '') {
				getKaryawanOutlet(outlet_filter, periode_filter)
				// getAbsensi(periode_filter, outlet_filter)
			} else {
				a_error('Maaf!', 'Silahkan pilih Periode dan outlet dahulu!');
			}
		})

		//tbody button action
		$("#tblPPP tbody").on("click", ".btnCekPrint", function () {
			id_outlet = $(this).data("id");
			// console.log(id_outlet)
			getKaryawanOutlet(id_outlet)
			$("#mdlCek").modal('show');
		})
	})

	function update_detail_cek(input_type, periode, id_karyawan, kbl, sp, lhk, llr, lbu, lain) {
		$.ajax({
			url: base_url + 'Ppp_sdm/update_detail_cek',
			data: {
				input_type: input_type,
				periode: periode,
				id_karyawan: id_karyawan,
				kbl: kbl,
				sp: sp,
				lhk: lhk,
				llr: llr,
				lbu: lbu,
				lain: lain
			},
			method: "POST",
			dataType: "json",
			async: false,
			success: function (res) {
				// if (res.res) {
				// 	a_ok('Berhasil!', res.msg);
				// 	// $("#mdl-outlet").modal('hide');
				// } else {
				// 	a_error('Gagal!', res.msg);
				// }
			}
		});
	}

	function getKaryawanOutlet(id_outlet, periode) {
		$.ajax({
			url: base_url + 'Ppp_sdm/get_karyawanOutlet',
			data: {
				id_outlet: id_outlet,
				periode: periode
			},
			method: "POST",
			dataType: "json",
			async: false,
			success: function (data) {
				console.log(data);
				if (data != '') {
					let r = 0;
					let html = '';
					for (let i = 0; i < data.length; i++) {
						r = i + 1;
						$.ajax({
							url: base_url + 'ppp_sdm/json_dataPPP/' + data[i].periode + '/' + data[i]
								.id_karyawan,
							method: "POST",
							dataType: "json",
							async: false,
							success: function (dataPPP) {
								let kbl, sp, lain, lhk, llr, lbu = 0;
								(dataPPP.lhk != 0 || dataPPP.lhk != '') ? lhk = dataPPP.lhk: lhk = 0;
								(dataPPP.llr != 0 || dataPPP.llr != '') ? llr = dataPPP.llr: llr = 0;
								(dataPPP.lbu != 0 || dataPPP.lbu != '') ? lbu = dataPPP.lbu: lbu = 0;

								(dataPPP.kbl != 0 || dataPPP.kbl != '') ? kbl = dataPPP.kbl: kbl = 0;
								(dataPPP.sp != 0 || dataPPP.sp != '') ? sp = dataPPP.sp: sp = 0;
								(dataPPP.lain != 0 || dataPPP.lain != '') ? lain = dataPPP.lain:
									lain = 0;
								html += `
								<tr>
									<td class="text-center">` + r + `</td>
									<td>
										` + data[i].nik + ` <br />
										<b>` + data[i].nama + `</b> <br />
										` + data[i].tempat_lahir + `, ` + format_tanggal(data[i].tanggal_lahir) + ` <br />
										<b>` + (data[i].jabatan || "").toUpperCase() + `</b>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="lbu_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="lbu_` + data[i].id_karyawan + `" id="lbu_` +
									data[i].id_karyawan + `" value="` + lbu + `">
										</div>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="lhk_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="lhk_` + data[i].id_karyawan + `" id="lhk_` +
									data[i].id_karyawan + `" value="` + lhk + `">
										</div>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="llr_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="llr_` + data[i].id_karyawan + `" id="llr_` +
									data[i].id_karyawan + `" value="` + llr + `">
										</div>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="kbl_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="kbl_` + data[i].id_karyawan + `" id="kbl_` + data[
										i].id_karyawan + `" value="` + kbl + `">
										</div>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="sp_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="sp_` + data[i].id_karyawan + `" id="sp_` + data[i]
									.id_karyawan + `" value="` + sp + `">
										</div>
									</td>
									<td>
										<div class="form-group mr-4">
											<label for="lain_` + data[i].id_karyawan + `"></label>
											<input type="number" class="form-control" name="lain_` + data[i].id_karyawan + `" id="lain_` +
									data[i].id_karyawan + `" value="` + lain + `">
										</div>
									</td>
								</tr>
							`;
							}
						});
					}
					$('#tblCekPrint').DataTable().clear().destroy();
					$("#tblCekPrint tbody").html(html);
					$('#tblCekPrint').dataTable({
						"autoWidth": false,
						"columnDefs": [{
							"width": "1%",
							"targets": 0
						},
						{
							"width": "10%",
							"targets": 1
						}]
					});
					$("#secTbl").show();
				} else {
					$("#secTbl").hide();
					a_error('Maaf!', 'Tidak ada data absensi karyawan yang sudah di input!');
				}
			}
		});
	}

	function get_pppsdm() {
		$.ajax({
			url: base_url + 'Outlet/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td width='10'>` + data[i].id_outlet + `</td>
							<td>` + data[i].nama_outlet + `</td>
							<td align="center">
								<button class="btn btn-info btnCekPrint" data-id="` + data[i].id_outlet + `"><i class="mdi mdi-printer"></i> Print</button>
							</td>
						</tr>
					`;
				}
				$('#tblPPP').DataTable().clear().destroy();
				$("#tblPPP tbody").html(html);
				$('#tblPPP').dataTable({
					"autoWidth": false,
					"columnDefs": [{
							"width": "1%",
							"targets": 0
						},
						{
							"width": "5%",
							"targets": 2
						},
					]
				});
			}
		});
	}
</script>