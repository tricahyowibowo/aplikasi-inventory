

<div class="row" >
  <div class="d-flex justify-content-between mb-4">
    <div class="p-2">
    <a href="<?= base_url('Datakendaraan') ?>" class="btn btn-secondary"><i class="fa fa-solid fa-angle-left"></i> Kembali</a>
    </div>
    <div class="p-2">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="fa fa-solid fa-plus"></i> tambah data</a>
    </div>
  </div>
  <div class="card">
    <div class="card-header"></div>
    <div class="detail-kendaraan">
      <div class="mb-3 row">
        <label for="no_polisi" class="col-sm-2 col-form-label">Nomor Polisi</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="<?= $data_kendaraan->nomor_polisi?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputPassword" class="col-sm-2 col-form-label">Merek Kendaraan</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="<?= $data_kendaraan->merek_kendaraan?>">
        </div>
      </div>
      <div class="mb-3 row">
        <label for="no_polisi" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
        <div class="col-sm-10">
          <input type="text" readonly class="form-control-plaintext" value="<?= $data_kendaraan->jenis_kendaraan?>">
        </div>
      </div>
    </div>
    <div class="card-body table-responsive no-padding">
      <table id="DataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Tanggal Perawatan</th>
          <th>Detail Perawatan</th>
          <?php
          if($role == ROLE_SUPERADMIN)
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
          <td><?php echo $no++ ?></td>
          <td><?php echo mediumdate_indo($data->tanggal).' | '.$data->waktu ?></td>
          <td><?php echo $data->detail_perawatan ?></td>
          <?php
          if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
          {
          ?>
          <td class="text-center">
            <a href="<?= base_url('kendaraan/deleteperawatan/'.$data->id_perawatan_kendaraan) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
          </td>
          <?php } ?>
        </tr>
        <?php
          endforeach;
        }
        ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('kendaraan/simpanperawatan')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Perawatan Kendaraan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="barang_id" class="form-label">Nomor Polisi</label>
              <input type="hidden" name="id_kendaraan" class="form-control-plaintext tabel-PR" value="<?= $data_kendaraan->id_kendaraan?>" readonly/>
              <input type="text" name="nomor_polisi" class="form-control-plaintext tabel-PR" value="<?= $data_kendaraan->nomor_polisi?>" readonly/>
            </div> 
            <div class="col-md-12">
              <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
              <input type="text" name="merek_kendaraan" placeholder="masukkan jumlah disini" class="form-control-plaintext tabel-PR" value="<?= $data_kendaraan->merek_kendaraan?>" required />
            </div> 
            <div class="col-md-12">
              <label for="tgl_perawatan" class="form-label">Tanggal Perawatan</label>
              <input type="datetime-local" name="tgl_perawatan" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="detail_perawatan" class="form-label">Detail Perawatan</label>
              <textarea name="detail_perawatan" class="form-control tabel-PR" cols="20" rows="5"></textarea>
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


<script>
function detailBarang($id){
  $.ajax({
    url:"<?php echo site_url("barang/detailpinjambarang")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("id_perawatan_kendaraan").value = hasil.id_perawatan_kendaraan;
      document.getElementById("nama_barang").value = hasil.nama_barang;
      document.getElementById("jumlah_pinjam").value = hasil.jumlah_pinjam;
    }
  });
}

function detailPenerima($id){
  $.ajax({
    url:"<?php echo site_url("barang/detailpenerima")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      console.log(hasil);
      document.getElementById("name").value = hasil.name;
    }
  });
}
</script>