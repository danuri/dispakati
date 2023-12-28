<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-8">
        <h5 class="fs-20">Digitalisasi Sistem Penilaian Angka Kredit Konvensional ke Integrasi (DISPAKATI)</h5>
        <p class="text-muted fs-15">Pemutakhiran Data PAK secara Mandiri.</p>
      </div>
    </div>

    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-8">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                              <div class="alert alert-primary">
								<strong>Petunjuk Pengisian :</strong><br>
								- Diisi hanya dengan Angka saja<br>
								- Jika ada angka desimal tanda koma (,) diganti menjadi tanda titik (.)
								Contoh: <strong>10,456</strong> ditulis menjadi <strong>10.456</strong>
							</div>
              <div class="alert alert-danger">
                Isi data sesuai dengan PAK terakhir yang dimiliki. Ketidaksesuaian data yang diinput menjadi tanggung jawab pegawai masing-masing.
              </div>
              <div class="alert alert-success">
                Status aplikasi DISPAKATI BKN: <?= ($paki->status == 0)?'Pending':'<b>'.$paki->dispakati_message.'</b>';?>
              </div>
              <?php if($paki->status == 1){?>
                  <form class="" action="/disabled" method="post" enctype="multipart/form-data" id="formpak">
              <?php }else{ ?>
                  <form class="" action="" method="post" enctype="multipart/form-data" id="formpak">
              <?php } ?>
                <input type="hidden" name="id" value="<?= encrypt($paki->id)?>">
              <table class="table table-bordered">
								<tbody><tr bgcolor="#3399cc" style="color:#FFFFFF;">
									<th width="5%">II</th>
									<th width="30%">PENETAPAN ANGKA KREDIT</th>
									<th width="20%" class="text-center">LAMA</th>
									<th width="20%" class="text-center">BARU</th>
									<th width="25%" class="text-center">JUMLAH</th>
								</tr>
								<tr>
									<th>1.</th>
									<th colspan="4">UNSUR UTAMA</th>
								</tr>
								<!-- PENDIDIKAN -->
								<tr>
									<th></th>
									<th>A. Pendidikan</th>
									<th>
										<input type="hidden" name="pl" id="pl">
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_penlama" name="txt_penlama" min="0" placeholder="Isi Nilai Pendidikan Lama" onkeyup="return hitung();" value="<?= $paki->paki_konv_pddk_lama?>" onkeypress="return hanyaAngka(event)" fdprocessedid="p9m83n">
				        			</th>
									<th>
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_penbaru" name="txt_penbaru" min="0" placeholder="Isi Nilai Pendidikan Baru" onkeyup="return hitung();" value="<?= $paki->paki_konv_pddk_baru?>" onkeypress="return hanyaAngka(event)" fdprocessedid="rrnpnr">
				        			</th>
									<th class="info">
										<input type="number" class="form-control input-float" name="txt_PenJumlah" id="txt_PenJumlah" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="6r1r3k">
									</th>
								</tr>
								<!-- END PENDIDIKAN -->
								<!-- TUGAS POKOK -->
								<tr>
									<th></th>
									<th>B. Tugas Pokok</th>
									<th>
										<input type="hidden" name="tpl" id="tpl">
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_tplama" name="txt_tplama" min="0" placeholder="Isi Nilai Tugas Pokok Lama" onkeyup="return hitung();" value="<?= $paki->paki_konv_tupok_lama?>" onkeypress="return hanyaAngka(event)" fdprocessedid="i7cbln">
				        			</th>
									<th>
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_tpbaru" name="txt_tpbaru" min="0" placeholder="Isi Nilai Tugas Pokok Baru" onkeyup="return hitung();" value="<?= $paki->paki_konv_tupok_baru?>" onkeypress="return hanyaAngka(event)" fdprocessedid="pdpll1">
				        			</th>
									<th class="info">
										<input type="number" class="form-control input-float" name="txt_tpjumlah" id="txt_tpjumlah" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="wbqpu">
									</th>
								</tr>
								<!-- END TUGAS POKOK -->
								<tr>
									<th></th>
									<th>C. Pengembangan Profesi</th>
									<th>
										<input type="hidden" name="ppl" id="ppl" min="0">
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_proflama" name="txt_proflama" min="0" placeholder="Isi Nilai Profesi Lama" onkeyup="return hitung();" value="<?= $paki->paki_konv_bangprov_lama?>" onkeypress="return hanyaAngka(event)" fdprocessedid="hur0t7">
				        			</th>
									<th>
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_profbaru" name="txt_profbaru" min="0" placeholder="Isi Nilai Profesi Baru" onkeyup="return hitung();" value="<?= $paki->paki_konv_bangprof_baru?>" onkeypress="return hanyaAngka(event)" fdprocessedid="7vlryt">
				        			</th>
									<th class="info">
										<input type="number" class="form-control input-float" name="txt_profjumlah" id="txt_profjumlah" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="6vmtb">
									</th>
								</tr>
								<tr class="info">
									<th></th>
									<th style="text-align:right">JUMLAH</th>
									<th>
										<input type="number" class="form-control input-float" name="txt_jmllama" id="txt_jmllama" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="vowovs">
									</th>
									<th>
										<input type="number" class="form-control input-float" name="txt_jmlbaru" id="txt_jmlbaru" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="u5hirp">
									</th>
									<th>
										<input type="number" class="form-control input-float" name="txt_jmlun" id="txt_jmlun" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="jqsjad">
									</th>
								</tr>
								<tr>
									<th>2.</th>
									<th>UNSUR PENUNJANG</th>
									<th>
										 <input type="text" class="form-control input-float" autocomplete="off" id="txt_penjuLama" name="txt_penjuLama" min="0" placeholder="Isi Nilai Unsur Penunjang Lama" onkeyup="return hitung();" value="<?= $paki->paki_konv_tunjang_lama?>" onkeypress="return hanyaAngka(event)" fdprocessedid="14xrhy">
				        			</th>
									<th>
										<input type="text" class="form-control input-float" autocomplete="off" id="txt_penjuBaru" name="txt_penjuBaru" min="0" placeholder="Isi Nilai Unsur Penunjang Baru" onkeyup="return hitung();" value="<?= $paki->paki_konv_tunjang_baru?>" onkeypress="return hanyaAngka(event)" fdprocessedid="2j7uif">
				        			</th>
									<th class="info">
										<input type="number" class="form-control input-float" name="txt_PenjuJumlah" id="txt_PenjuJumlah" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="bc8a4d">
									</th>
								</tr><tr class="info">
									<th colspan="2" style="text-align:right;">TOTAL</th>
									<th>
										<input type="number" class="form-control input-float" name="txt_ttllama" id="txt_ttllama" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="c0buf">
									</th>
									<th>
										<input type="number" class="form-control input-float" name="txt_ttlbaru" id="txt_ttlbaru" readonly="" value="0.000" style="border-color:#3399cc; color:#3399cc" fdprocessedid="j0ho3d">

									</th>
									<th>
										<input type="number" style="font-size:30px" class="form-control input-float" name="txt_ttljumlah" id="txt_ttljumlah" readonly="" value="0.000" fdprocessedid="jnvlgr">
									</th>
								</tr>
							</tbody></table>

              <table class="table table-bordered">
									<tbody><tr>
										<th width="180">Masa Penilaian :</th>
										<td>
                      <div class="row">
                        <div class=" col-md-4">
                          <input type="date" name="paki_tgl_awal" id="tgl" value="<?= $paki->paki_tgl_awal?>" class="form-control tgl hasDatepicker">
                        </div>
                        <div class=" col-md-1 text-center"> s.d </div>
                        <div class=" col-md-4">
                          <input type="date" name="paki_tgl_akhir" class="form-control" value="2022-12-31" readonly>
                        </div>
                      </div>
										</td>
									</tr>

									<tr>
										<th width="180">Upload File Pedukung :</th>
										<td>
										<div class=" col-md-7">
										<input type="file" required="" name="gambar" id="gambar" accept="application/pdf" class="form-control">
                    <?= ($paki->paki_file)?'<br><br><a href="https://docu.kemenag.go.id:9000/dispakati/attachment/'.$paki->paki_file.'" target="_blank" class="btn btn-success">Lihat Dokumen</a>':'';?>
						                </div>
						               	</td>
									</tr>
								</tbody></table>
                <input type="submit" name="submit" class="btn btn-primary" value="Simpan">
                </form>
                            </div>
                        </div>

                    </div>
                </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.input-float').inputNumberFormat({'decimal': 3,'decimalAuto': 0});
    hitung();
  <?php if($paki->status == 1){?>
    $( "#formpak :input" ).prop( "disabled", true );
  <?php } ?>
  });

  function hitung() {
		// hitung pendidikan
		var paki_konv_pddk_lama = parseFloat(document.getElementById("txt_penlama").value);
		var paki_konv_pddk_baru = parseFloat(document.getElementById("txt_penbaru").value);

		paki_konv_pddk_jum = paki_konv_pddk_lama+paki_konv_pddk_baru;
		document.getElementById("txt_PenJumlah").value = paki_konv_pddk_jum.toFixed(3);
		document.getElementById("pl").value = paki_konv_pddk_jum;

		// hitung tugas pokok
		var paki_konv_tupok_lama = parseFloat(document.getElementById("txt_tplama").value);
		var paki_konv_tupok_baru = parseFloat(document.getElementById("txt_tpbaru").value);

		paki_konv_tupok_jum = paki_konv_tupok_lama+paki_konv_tupok_baru;
		document.getElementById("txt_tpjumlah").value = paki_konv_tupok_jum.toFixed(3);
		document.getElementById("tpl").value = paki_konv_tupok_jum;

		// hitung bangprof
		var paki_konv_bangprov_lama = parseFloat(document.getElementById("txt_proflama").value);
		var paki_konv_bangprof_baru = parseFloat(document.getElementById("txt_profbaru").value);

		paki_konv_bangprof_jum = paki_konv_bangprov_lama+paki_konv_bangprof_baru;
		document.getElementById("txt_profjumlah").value = paki_konv_bangprof_jum.toFixed(3);
		document.getElementById("ppl").value = paki_konv_bangprof_jum;

		// hitung lama dan baru
		paki_konv_utama_lama 	= paki_konv_pddk_lama + paki_konv_tupok_lama + paki_konv_bangprov_lama;
		paki_konv_utama_baru 	= paki_konv_pddk_baru + paki_konv_tupok_baru + paki_konv_bangprof_baru;
		paki_konv_utama_jum 	= paki_konv_pddk_jum + paki_konv_tupok_jum + paki_konv_bangprof_jum;

		document.getElementById("txt_jmllama").value = paki_konv_utama_lama.toFixed(3);
		document.getElementById("txt_jmlbaru").value = paki_konv_utama_baru.toFixed(3);
		document.getElementById("txt_jmlun").value = paki_konv_utama_jum.toFixed(3);

		// hitung penunjang
		var paki_konv_tunjang_lama = parseFloat(document.getElementById("txt_penjuLama").value);
		var paki_konv_tunjang_baru = parseFloat(document.getElementById("txt_penjuBaru").value);

		paki_konv_tunjang_jum = paki_konv_tunjang_lama+paki_konv_tunjang_baru;
		document.getElementById("txt_PenjuJumlah").value = paki_konv_tunjang_jum.toFixed(3);

		// hitung total
		paki_konv_total_lama 	= paki_konv_utama_lama + paki_konv_tunjang_lama;
		paki_konv_total_baru 	= paki_konv_utama_baru + paki_konv_tunjang_baru;
		paki_konv_total		 	= paki_konv_total_lama + paki_konv_total_baru;

		document.getElementById("txt_ttllama").value = paki_konv_total_lama.toFixed(3);
		document.getElementById("txt_ttlbaru").value = paki_konv_total_baru.toFixed(3);
		document.getElementById("txt_ttljumlah").value = paki_konv_total.toFixed(3);
	}

  function hanyaAngka(evt) {
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode!=46 && charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
          return true;
  }

</script>
<?= $this->endSection() ?>
