
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>
  <div class="col-md-12">
  <?= form_open('barang/cetakSemua',['class' => 'formcetakbarcodesemua'])?>
    <div class="card card-primary">
      <div class="card-header">
        <div class="d-flex flex-wrap justify-content-between">
          <div class="p-2">
            <h3 class="card-title">Data barang</h3>
          </div>
          <div class="p-2">
          <button type="submit" class="btn btn-info cetakSemua"><i class="fa fa-print"></i> cetak semua</button>
          </div>
        </div>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th><input type="checkbox" id="check-all"></th>
            <th>No</th>
            <th>Nama barang</th>
            <th class="text-center">Detail Barang</th>
            <th>Lokasi Barang</th>
            <th>Stok tersedia</th>
            <th>Stok Dipinjam</th>
            <th>Stok Rusak</th>
            <th>Status</th>
            <th class="text-center">Cetak</th>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <th class="text-center">Actions</th>
            <?php } ?>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
            foreach($list_data as $data):
          ?>
          <tr>
            <td><input type="checkbox" class="check-item" name="id_barangcheck[]" value="<?= $data->id_barang ?>"></td>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_barang ?></td>
            <!-- <td><?php echo is_null($data->tgl_pembelian) ? '-' : mediumdate_indo($data->tgl_pembelian); ?></td> -->
            <td class="text-center">
              <a data-bs-toggle="modal" data-bs-target="#spesifikasi" onclick="detailBarang(<?= $data->id_barang?>)"><i class="fa fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lihat detail"></i></a>
            </td>
            <td><?php echo $data->nama_divisi ?></td>
            <td><?php echo $data->stok_barang_normal ?></td>
            <td><?php echo $data->stok_barang_dipinjam ?></td>
            <td><?php echo $data->stok_barang_rusak ?></td>
            <td>
              <?php 
              switch ($data->keterangan_barang) {
                case 1: ?>
                  <span class="badge text-bg-warning">asset</span>
                <?php break;
                
                default:?>
                  <span class="badge text-bg-warning">dipinjamkan</span>
                <?php  
                break;}
                ?>
            </td>
            <td class="text-center">
              <a href="<?= base_url('barang/cetakQRCode/'.$data->id_barang)?>" target="_blank" class="btn btn-sm btn-info"><i class="fa fa-print" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="cetak"></i></a>
            </td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <a class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_barang?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></a>
              <a href="<?= base_url('detelebarang/'.$data->id_barang) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"></i></a>
            </td>
            <?php } ?>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  <?= form_close(); ?>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('Qrcodegenerate/saveBarang/'.$userId)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama barang</label>
              <input type="text" name="nama_barang" placeholder="Nama barang" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">tanggal pembelian</label>
              <input type="date" name="tgl_pembelian" class="form-control tabel-PR" />
            </div> 
            <div class="col-md-12">
              <label for="lokasi_barang" class="form-label">Lokasi barang</label>
              <select name="lokasi_barang" placeholder="lokasi barang" class="form-select tabel-PR">
                <option>pilih divisi</option>
                <?php foreach($divisi as $d){?>
                <option value=<?= $d->id_divisi ?>><?= $d->nama_divisi ?></option>
                <?php } ?>
              </select>
            </div> 
            <div class="col-md-12">
              <label for="stok_barang" class="form-label">Stok barang</label>
              <input type="text" name="stok_barang" placeholder="isikan stok barang disini" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="keterangan_barang" class="form-label">Keterangan</label>
              <select name="keterangan_barang" class="form-select tabel-PR" required>
                <option>pilih keterangan</option>
                <option value="1">asset</option>
                <option value="2">dipinjamkan</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="spesifikasi_barang" class="form-label">Spesifikasi Barang</label>
              <textarea  class="form-control tabel-PR" name="spesifikasi_barang" cols="30" rows="5"></textarea>
            </div>         
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('barang/update')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama barang</label>
              <input type="hidden" name="id_barang" id="id_barang"/>
              <input type="text" name="nama_barang" id="nama_barang" placeholder="Nama barang" class="form-control tabel-PR" required />
            </div>    
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
              <input type="date" name="tgl_pembelian" id="tgl_pembelian" placeholder="kondisi_barang" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Lokasi Barang</label>
              <select name="divisi_id" id="divisi_id" class="form-select tabel-PR">
                <?php foreach($divisi as $d){?>
                <option value=<?= $d->id_divisi ?>><?= $d->nama_divisi ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-6">
              <label for="stok_barang" class="form-label">Stok barang normal</label>
              <input type="text" name="stok_normal" id="stok_normal" class="form-control tabel-PR" required />
              </div>
              <div class="col-md-6">
              <label for="stok_barang" class="form-label">Stok barang rusak</label>
              <input type="text" name="stok_rusak" id="stok_rusak" class="form-control tabel-PR" required />
              </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="keterangan_barang" class="form-label">Keterangan</label>
              <select name="keterangan_barang" id="keterangan_barang"  class="form-select tabel-PR" required>
                <option value="1">asset</option>
                <option value="2">dipinjamkan</option>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="spesifikasi_barang" class="form-label">Spesifikasi Barang</label>
              <textarea  class="form-control tabel-PR" name="spesifikasi_barang" id="spesifikasi_edit" cols="30" rows="5"></textarea>
            </div>   
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Spesifikasi-->
<div class="modal fade" id="spesifikasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Detail Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 row">
          <label for="spesifikasi" class="col-sm-6 col-form-label">Spesifikasi</label>
          <div class="col-sm-4">
            <input type="text" readonly class="form-control-plaintext" id="spesifikasi_barang">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="tgl_pembelian" class="col-sm-6 col-form-label">Tanggal Pembelian</label>
          <div class="col-sm-4">
            <input type="text" readonly class="form-control-plaintext" id="tanggal">
          </div>
        </div>
        <div class="mb-3 row">
          <label for="Barcode" class="col-sm-6 col-form-label">Barcode</label>
          <div class="col-sm-4">
            <img id="barcode_barang" width="200" alt="barcode" srcset="" class="form-control-plaintext tabel-PR">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function editData($id){
    $.ajax({
      url:"<?php echo site_url("barang/detailbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil.keterangan_barang);
        document.getElementById("id_barang").value = hasil.id_barang;
        document.getElementById("nama_barang").value = hasil.nama_barang;
        document.getElementById("divisi_id").value = hasil.divisi_id;
        document.getElementById("tgl_pembelian").value = hasil.tgl_pembelian;
        document.getElementById("stok_normal").value = hasil.stok_barang_normal;
        document.getElementById("stok_rusak").value = hasil.stok_barang_rusak;
        document.getElementById("keterangan_barang").value = hasil.keterangan_barang;
        document.getElementById("spesifikasi_edit").value = hasil.spesifikasi_barang;
      }
    });
  }

  function detailBarang($id){
    $.ajax({
      url:"<?php echo site_url("barang/detailbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

        let d = new Date(hasil.tgl_pembelian);
        let month = months[d.getMonth()];
        let date = d.getDate();
        let year = d.getFullYear();

        document.getElementById("tanggal").value = date+' '+month+' '+year;
        document.getElementById("spesifikasi_barang").value = hasil.spesifikasi_barang;
        const urlgambar = "<?= site_url("assets/images/qrcode/barang/")?>"+hasil.qrcode_barang;

        $("#barcode_barang").attr('src',urlgambar);
      }
    });
  }
</script>