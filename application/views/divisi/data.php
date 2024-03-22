
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data divisi</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama divisi</th>
            <th class="text-center">Actions</th>
          </tr>
          </thead>
          <?php
          $no = 1;
          if(!empty($list_data))
          {
              foreach($list_data as $data)
              {
          ?>
          <tbody>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_divisi ?></td>
            <td class="text-center">
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_divisi?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <a href="<?= base_url('deteledivisi/'.$data->id_divisi) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></a></td>
          </tr>
          </tbody>
          <?php
              }
          }
          ?>
        </table>
        
      </div><!-- /.box-body -->
    </div><!-- /.box -->
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('divisi/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_divisi" class="form-label">Nama divisi</label>
              <input type="text" name="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
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
      <form action="<?=base_url('divisi/update')?>" role="form" id="editdivisi" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_divisi" class="form-label">Nama divisi</label>
              <input type="hidden" name="id_divisi" id="id_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
              <input type="text" name="nama_divisi" id="nama_divisi" placeholder="Nama divisi" class="form-control tabel-PR" required />
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
      url:"<?php echo site_url("divisi/detaildivisi")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_divisi").value = hasil.id_divisi;
        document.getElementById("nama_divisi").value = hasil.nama_divisi;
      }
    });
  }
</script>