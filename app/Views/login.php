<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <h5 class="fs-20">Digitalisasi Sistem Penilaian Angka Kredit Konvensional ke Integrasi (DISPAKATI)</h5>
        <p class="text-muted fs-15">Pemutakhiran Data PAK secara Mandiri.</p>
      </div>
    </div>
    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Login Menggunakan SSO Kemenag</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="" method="post">

                                        <div class="mb-3">
                                            <label for="username" class="form-label">NIP</label>
                                            <input type="text" class="form-control" id="nip" name="nip" placeholder="Masukan NIP">
                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <!-- <a href="https://sso.kemenag.go.id/reset-password" class="text-muted" target="_blank">Lupa Password?</a> -->
                                            </div>
                                            <label class="form-label" for="password-input">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5 password-input" placeholder="Password SSO Kemenag" id="password" name="password">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon" fdprocessedid="xsdgol"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit" fdprocessedid="aq95ua">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
  </div>
</div>
<?= $this->endSection() ?>
