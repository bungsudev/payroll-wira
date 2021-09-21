<div class="box">
	<!-- /.box-header -->
	<div class="box-body">
		<div class="mb-3">
			<span class="text-danger text-sm">*Pengaturan awal akan digunakan jika inputan Outlet di kosongkan</span>
			<hr />
		</div>
		<form ecntype="multipart/form-data">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="bpjs_kesehatan">BPJS Kesehatan</label>
						<input type="number" class="form-control required" name="bpjs_kesehatan" id="bpjs_kesehatan"
							value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="bpjs_tk">BPJS Ketenaga Kerjaan</label>
						<input type="number" class="form-control required" name="bpjs_tk" id="bpjs_tk" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="bpjs_jp">BPJS JP</label>
						<input type="number" class="form-control required" name="bpjs_jp" id="bpjs_jp" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="t_urine">Tes Urine</label>
						<input type="number" class="form-control required" name="t_urine" id="t_urine" value="0">
					</div>
				</div>
				<div class="col-md-12 text-center">
					<button class="btn btn-warning ml-2" id="btn-batal"><i class="mdi mdi-reload"></i>
						Batal</button>
					<button class="btn btn-success ml-2" id="btn-simpan"><i class="mdi mdi-content-save-settings"></i>
						Simpan</button>
				</div>
			</div>
			<div class="row d-none">
				<div class="col-md-3">
					<div class="form-group">
						<label for="shift_outlet">Jam Kerja</label>
						<select class="form-control" name="shift_outlet" id="shift_outlet">
							<option value="">-Pilih-</option>
							<option value="1">1 Shift</option>
							<option value="2">2 Shift</option>
							<option value="3">3 Shift</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="g_pkk">Gaji Pokok</label>
						<input type="number" class="form-control required" name="g_pkk" id="g_pkk" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="t_jbt">Tunjangan Jabatan</label>
						<input type="number" class="form-control required" name="t_jbt" id="t_jbt" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="t_trans">Tunjangan Transportasi</label>
						<input type="number" class="form-control required" name="t_trans" id="t_trans" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="t_ot">Tunjangan Outlet</label>
						<input type="number" class="form-control required" name="t_ot" id="t_ot" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group d-none">
						<label for="lhk">Lembur HK</label>
						<input type="number" class="form-control required" name="lhk" id="lhk" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group d-none">
						<label for="lbu">Lembur Back Up</label>
						<input type="number" class="form-control required" name="lbu" id="lbu" value="0">
					</div>
				</div>
				<div class="col-md-3 d-none">
					<div class="form-group">
						<label for="llr">Lembur Libur</label>
						<input type="number" class="form-control" name="llr" id="llr" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="jst">Jamsostek</label>
						<input type="number" class="form-control required" name="jst" id="jst" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dpst">Deposito Perlengkapan</label>
						<input type="number" class="form-control required" name="dpst" id="dpst" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="srg">Seragam</label>
						<input type="number" class="form-control required" name="srg" id="srg" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="bpdd">Biaya Pendidikan</label>
						<input type="number" class="form-control required" name="bpdd" id="bpdd" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dab">Denda Absen</label>
						<input type="number" class="form-control required" name="dab" id="dab" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="diz">Denda Izin</label>
						<input type="number" class="form-control required" name="diz" id="diz" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="dis">Denda Sakit</label>
						<input type="number" class="form-control required" name="dis" id="dis" value="0">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="lain">Lainnya</label>
						<input type="number" class="form-control required" name="lain" id="lain" value="0">
					</div>
				</div>
				<!-- <div class="col-md-12 text-center">
					<button class="btn btn-warning ml-2" id="btn-batal"><i class="mdi mdi-reload"></i>
						Batal</button>
					<button class="btn btn-success ml-2" id="btn-simpan"><i class="mdi mdi-content-save-settings"></i>
						Simpan</button>
				</div> -->
			</div>
		</form>
	</div>
	<!-- /.box-body -->
</div>

<script>
	let act = 'Edit';
	let id_setting = '';
	$(document).ready(function () {
		console.clear()
		get_setting();
		get_setting_detail(0)
		//button action
		$("#btn-import").click(function () {
			$("#mdl-import").modal('show');
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
					simpan(act, id_setting);
				} else {
					a_error('Terjadi Kesalahan!', 'Reload Page dahulu');
				}
			}
		})
		$("#btn-batal").click(function (e) {
			e.preventDefault();
			if (confirm('Apakah kamu yakin?')) {
				get_setting_detail(0);
			}
		})
	})

	function simpan(act) {
		if (confirm('Apakah kamu yakin?')) {
			$.ajax({
				url: base_url + 'Setting_default/simpan_setting/' + act + '/' + id_setting,
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
						get_setting();
						get_setting_detail(0)
						$("#mdl-setting").modal('hide');
					} else {
						a_error('Gagal!', res.msg);
					}
				}
			});
		}
	}

	function get_setting_detail(id_setting) {
		$.ajax({
			url: base_url + 'Setting_default/get_data_detail',
			data: {
				id: id_setting
			},
			method: "POST",
			dataType: "json",
			success: function (data) {
				if (data) {
					$("#bpjs_kesehatan").val(data.bpjs_kesehatan)
					$("#bpjs_tk").val(data.bpjs_tk)
					$("#bpjs_jp").val(data.bpjs_jp)
					$("#t_urine").val(data.t_urine)
					$("#shift_outlet").val(data.shift_outlet)
					$("#g_pkk").val(data.g_pkk)
					$("#t_jbt").val(data.t_jbt)
					$("#t_trans").val(data.t_trans)
					$("#t_ot").val(data.t_ot)
					$("#lhk").val(data.lhk)
					$("#lbu").val(data.lbu)
					$("#llr").val(data.llr)
					$("#jst").val(data.jst)
					$("#dpst").val(data.dpst)
					$("#srg").val(data.srg)
					$("#bpdd").val(data.bpdd)
					$("#dab").val(data.dab)
					$("#diz").val(data.diz)
					$("#dis").val(data.dis)
					$("#lain").val(data.lain)
				} else {
					a_error('Terjadi Kesalahan!', 'Silahkan refresh page');
				}
			}
		});
	}

	function get_setting() {
		$.ajax({
			url: base_url + 'Setting_default/get_data',
			method: "POST",
			dataType: "json",
			success: function (data) {
				let html = '';
				for (let i = 0; i < data.length; i++) {
					html += `
						<tr>
							<td>` + data[i].setting + `</td>
							<td align="center">
								<button type="button" id="btn-edit" data-id="` + data[i].id_setting + `" class="btn btn-warning"><i class="fa fa-pencil"></i> Edit</button>
								<button type="button" id="btn-hapus" data-id="` + data[i].id_setting + `" class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button>
							</td>
						</tr>
					`;
				}
				$('#tbl-setting').DataTable().clear().destroy();
				$("#tbl-setting tbody").html(html);
				$('#tbl-setting').DataTable();
			}
		});
	}

</script>
