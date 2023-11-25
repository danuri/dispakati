<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="page-content">
  <div class="container-fluid">

    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6 col-xl-5">
        <h5 class="fs-20">REKAP HASIL SINKRON BKN</h5>
      </div>
    </div>
    <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th>STATUS</th>
                                    <th>KETERANGAN</th>
                                    <th>JUMLAH</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($rekaps as $row) {?>
                                    <tr>
                                      <td><?= $row->status?></td>
                                      <td><?= $row->dispakati_message?></td>
                                      <td><?= $row->jumlah?></td>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
                            </div>
                        </div>

                    </div>
                </div>
  </div>
</div>
<?= $this->endSection() ?>
