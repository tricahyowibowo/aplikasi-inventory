<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Cetak</title>
</head>
<body>
  <div class="row p-2">
  <?php foreach ($barang as $data) { ?>
    <div class="col-4 cetakbarcode m-1" style="border:solid;width:250px">
    <div class="d-flex flex-column align-items-center">
      <div class="header p-2">
        <img src="<?= base_url('assets/dist/img/mirota.png'); ?>" width="80" alt="" srcset="">
      </div>
      <div class="barcode">
        <img src="<?= base_url('assets/images/qrcode/barang/'.$data->qrcode_barang); ?>" width="200" alt="" srcset="">
      </div>
      <div class="text">
        <p class="text-center m-0"><?= $data->nama_barang?></p>
        <p class="text-center m-0"><?= $data->divisi_id.sprintf("%03s", $data->id_barang).strftime('%m%y', strtotime($data->tgl_pembelian))?></p>
      </div>
    </div>
    </div>
  <?php 
  }
  ?>
  </div>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  window.print();
</script>