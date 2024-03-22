<div class="d-flex justify-content-center">
  <?php foreach ($divisi as $d) { ?>
  <div class="col-md-3 p-2">
    <a href="<?= base_url('Formpeminjamankendaraan/').$d->id_divisi?>">
    <div class="card card-divisi">
      <div class="card-body">
        <div class="d-flex">
          <div class="p-2 flex-fill">
            <h2><?= $d->nama_divisi ?></h2>
          </div>
          <div class="p-2">
            <p><i class="fa-solid fa-screwdriver-wrench"></i></p>
          </div>
        </div>
      </div>
    </div>
    </a>
  </div>
  <?php } ?>

</div>