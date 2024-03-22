<div class="d-flex justify-content-center ">
  <div class="col-md-6">
  <div class="card">
    <form action="<?=base_url('Booking/'.$id_divisi)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
    <div class="card-header">
      <h1 class="card-title fs-1 mt-2" id="exampleModalLabel">Formulir Booking barang</h1>
    </div>
    <div class="card-body">
      <div class="form-group">
        <div class="row">
          <div class="col-md-12">
            <label for="barang_id" class="form-label">Barang</label>
            <select name="barang_id" placeholder="barang" class="form-select tabel-PR select2">
              <option>--pilih barang--</option>
              <?php foreach($barang as $data){?>
              <option value=<?= $data->id_barang ?>><?= $data->nama_barang ?></option>
              <?php } ?>
            </select>
          </div> 
          <div class="col-md-12">
            <label for="jumlah_barang" class="form-label">Jumlah pinjam</label>
            <input type="text" name="jumlah_barang" placeholder="masukkan jumlah disini" class="form-control tabel-PR" required />
          </div>
          <div class="col-md-12">
            <label for="nama_peminjam" class="form-label">Nama peminjam</label>
            <input type="text" name="nama_peminjam" placeholder="masukkan nama disini" class="form-control tabel-PR" required />
          </div>
          <div class="col-md-12">
            <label for="divisi_id" class="form-label">Divisi</label>
            <select name="divisi_id" class="form-select tabel-PR">
              <option>--pilih divisi--</option>
              <?php foreach($divisi as $data){?>
              <option value=<?= $data->id_divisi ?>><?= $data->nama_divisi ?></option>
              <?php } ?>
            </select>
          </div>  
          <div class="col-md-12">
            <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
            <input type="datetime-local" name="tgl_mulai" class="form-control tabel-PR" required />
          </div>  
          <div class="col-md-12">
            <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
            <input type="datetime-local" name="tgl_selesai" class="form-control tabel-PR" required />
          </div>         
        </div>
      </div>
    </div>
    <div class="card-footer d-flex justify-content-end">
      <a href="<?= base_url()?>" class="btn btn-secondary me-2"><i class="fa fa-arrow-left"></i> Kembali</a>
      <button type="submit" class="btn btn-success">Simpan</button>
    </div>
    </form>
  </div>
  </div>
</div>