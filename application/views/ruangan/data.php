
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data Ruangan</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama ruangan</th>
            <th>Kondisi</th>
            <th>Keterangan</th>
            <th>Qrcode</th>
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
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_ruangan ?></td>
            <td>
              <?php
              switch ($data->kondisi_ruangan) {
                case 'baik':?>
                <span class="badge bg-success"><?php echo $data->kondisi_ruangan ?></span>
                <?php break;?>

                <?php
                default:?>
                <span class="badge bg-danger"><?php echo $data->kondisi_ruangan ?></span>
                <?php  break;?>
              <?php 
              }
              ?>
            </td>
            <td><?php echo $data->keterangan_ruangan ?></td>
            <td><img src="<?= base_url('assets/images/qrcode/ruangan/'.$data->qrcode_ruangan); ?>" width="100" alt="" srcset=""></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_ruangan?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <a href="<?= base_url('deteleRuangan/'.$data->id_ruangan) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></a></td>
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
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('Qrcodegenerate/saveRuangan/'.$userId)?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
              <input type="text" name="nama_ruangan" placeholder="tulis nama ruangan disini" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="kondisi_ruangan" class="form-label">Kondisi Ruangan</label>
              <select name="kondisi_ruangan" class="form-select tabel-PR">
                <option value="baik">baik</option>
                <option value="rusak">rusak</option>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="keterangan_ruangan" class="form-label">Keterangan</label>
              <textarea type="text" name="keterangan_ruangan" placeholder="tulis keterangan disini" class="form-control tabel-PR"></textarea>
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
      <form action="<?=base_url('Ruangan/update')?>" role="form" id="editRuangan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
              <input type="hidden" name="id_ruangan" id="id_ruangan" placeholder="Nama Ruangan" class="form-control tabel-PR" required />
              <input type="text" name="nama_ruangan" id="nama_ruangan" placeholder="Nama Ruangan" class="form-control tabel-PR" required />
            </div>    
            <div class="col-md-12">
              <label for="kondisi_ruangan" class="form-label">Kondisi Ruangan</label>
              <select name="kondisi_ruangan" id="kondisi_ruangan" class="form-select">
                <option value="baik">baik</option>
                <option value="rusak">rusak</option>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="keterangan_ruangan" class="form-label">Keterangan</label>
              <textarea type="text" name="keterangan_ruangan" id="keterangan_ruangan" class="form-control tabel-PR"></textarea>
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
  function editData($id){
    $.ajax({
      url:"<?php echo site_url("Ruangan/detailruangan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_ruangan").value = hasil.id_ruangan;
        document.getElementById("nama_ruangan").value = hasil.nama_ruangan;
        document.getElementById("kondisi_ruangan").value = hasil.kondisi_ruangan;
        document.getElementById("keterangan_ruangan").value = hasil.keterangan_ruangan;
      }
    });
  }
</script>