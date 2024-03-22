
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data kendaraan Mobil</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Tanggal STNK</th>
            <th>Tahun</th>
            <th class="text-center">Perawatan</th>
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
          if(!empty($mobil))
          {
            foreach($mobil as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nomor_polisi ?></td>
            <td><?php echo $data->merek_kendaraan ?></td>
            <td><?php echo mediumdate_indo($data->tgl_stnk) ?></td>
            <td><?php echo $data->tahun ?></td>
            <td class="text-center"><a href="<?= base_url('kendaraan/perawatan/'.$data->id_kendaraan) ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="detail perawatan"><i class="fa fa-solid fa-eye"></i></a></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_kendaraan?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <a href="<?= base_url('detelekendaraan/'.$data->id_kendaraan) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus" ><i class="fa fa-trash"></i></a></td>
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

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data kendaraan Montor</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataMontor" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>No. Polisi</th>
            <th>Merek</th>
            <th>Tanggal STNK</th>
            <th>Tahun</th>
            <th class="text-center">Perawatan</th>
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
          if(!empty($montor))
          {
            foreach($montor as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nomor_polisi ?></td>
            <td><?php echo $data->merek_kendaraan ?></td>
            <td><?php echo mediumdate_indo($data->tgl_stnk) ?></td>
            <td><?php echo $data->tahun ?></td>
            <td class="text-center"><a href="<?= base_url('kendaraan/perawatan/'.$data->id_kendaraan) ?>" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="detail perawatan"><i class="fa fa-solid fa-eye"></i></a></td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_kendaraan?>)"><i class="fa fa-pencil" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="edit"></i></button>
              <a href="<?= base_url('detelekendaraan/'.$data->id_kendaraan) ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
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
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('kendaraan/save')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Formulir Tambah Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
              <input type="text" name="nomor_polisi" placeholder="Nomor Polisi" class="form-control tabel-PR" required />
            </div>

            <div class="col-md-12">
              <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
              <input type="text" name="merek_kendaraan" placeholder="Merek Kendaraan" class="form-control tabel-PR" required />
            </div>

            <div class="col-md-12">
              <label for="jenis_kendaraan" class="form-label">Jenis kendaraan</label>
              <select name="jenis_kendaraan" class="form-select tabel-PR" required>
                <option readonly>pilih jenis kendaraan</option>
                <option value="Motor">Motor</option>
                <option value="Mobil">Mobil</option>
              </select>
            </div> 
 
            <div class="col-md-12">
              <label for="tgl_stnk" class="form-label">STNK</label>
              <input type="date" name="tgl_stnk" class="form-control tabel-PR" required />
            </div> 

            <div class="col-md-12">
              <label for="tahun" class="form-label">Tahun</label>
              <input type="text" name="tahun" placeholder="Tahun pembelian" class="form-control tabel-PR" required />
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
      <form action="<?=base_url('kendaraan/update')?>" role="form" id="editkendaraan" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Edit Data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nomor_polisi" class="form-label">Nomor Polisi</label>
              <input type="hidden" name="id_kendaraan" id="id_kendaraan" placeholder="Nomor Polisi" class="form-control tabel-PR" required />
              <input type="text" name="nomor_polisi" id="nomor_polisi" placeholder="Nomor Polisi" class="form-control tabel-PR" required />
            </div>

            <div class="col-md-12">
              <label for="merek_kendaraan" class="form-label">Merek Kendaraan</label>
              <input type="text" name="merek_kendaraan" id="merek_kendaraan" placeholder="Merek Kendaraan" class="form-control tabel-PR" required />
            </div>
 
            <div class="col-md-12">
              <label for="tgl_stnk" class="form-label">STNK</label>
              <input type="date" name="tgl_stnk" id="tgl_stnk" class="form-control tabel-PR" required />
            </div> 

            <div class="col-md-12">
              <label for="tahun" class="form-label">Tahun</label>
              <input type="text" name="tahun" id="tahun" placeholder="Tahun pembelian" class="form-control tabel-PR" required />
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
      url:"<?php echo site_url("kendaraan/detailkendaraan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_kendaraan").value = hasil.id_kendaraan;
        document.getElementById("nomor_polisi").value = hasil.nomor_polisi;
        document.getElementById("merek_kendaraan").value = hasil.merek_kendaraan;
        document.getElementById("tgl_stnk").value = hasil.tgl_stnk;
        document.getElementById("tahun").value = hasil.tahun;
      }
    });
  }
</script>