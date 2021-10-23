<div class="col-md-12">
    <!-- <span class="text-danger">*jika data  0 <i>(nol)</i>/tidak di isi maka akan mengkuti pengaturan yang di tetapkan pada master outlet(default)</span> -->
    <hr />
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="shift_outlet">Jam Kerja</label>
        <select class="form-control required" name="shift_outlet" id="shift_outlet">
            <option value="">-Pilih-</option>
            <option value="1">1 Shift</option>
            <option value="2">2 Shift</option>
            <option value="3">3 Shift</option>
        </select>
    </div>
</div>
<div class="col-md-3 d-none">
    <div class="form-group">
        <label for="b_spkwt">Berakhir SPKWT</label>
    </div>
</div>
<input type="hidden" class="form-control" name="b_spkwt" id="b_spkwt">

<div class="col-md-3">
    <div class="form-group">
        <label for="g_pkk">Gaji Pokok</label>
        <input type="text" class="number form-control required" name="g_pkk" id="g_pkk" value="0">
    </div>
</div>
<!-- <div class="col-md-3">
    <div class="form-group">
        <label for="t_jbt">Tunjangan Jabatan</label>
        <input type="text" class="number form-control required" name="t_jbt" id="t_jbt" value="0">
    </div>
</div> -->
<div class="col-md-3">
    <div class="form-group">
        <label for="t_trans">Tunjangan Transportasi</label>
        <input type="text" class="number form-control required" name="t_trans" id="t_trans" value="0">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="t_ot">Tunjangan Outlet</label>
        <input type="text" class="number form-control required" name="t_ot" id="t_ot" value="0">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="jst">Jamsostek</label>
        <input type="text" class="number form-control required" name="jst" id="jst" value="0">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="dpst">Deposito Perlengkapan</label>
        <input type="text" class="number form-control required" name="dpst" id="dpst" value="0">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="srg">Seragam</label>
        <input type="text" class="number form-control required" name="srg" id="srg" value="0">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label for="bpdd">Biaya Pendidikan</label>
        <input type="text" class="number form-control required" name="bpdd" id="bpdd" value="0">
    </div>
</div>

<!-- //tambahan -->
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