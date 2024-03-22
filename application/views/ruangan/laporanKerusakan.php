
<div class="row">
  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data ruangan</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama ruangan</th>
            <th>Tanggal Pengaduan</th>
            <th class="text-center">Detail Laporan</th>
            <th class="text-center">Penanganan</th>
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
            <td><?php echo mediumdate_indo($data->tgl_pengaduan).' | '.$data->waktu_pengaduan  ?></td>
            <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#detailLaporan" onclick="detailLaporan(<?= $data->id_kerusakan_ruangan?>)"><i class="fa fa-solid fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lihat detail"></i></a></td>
            <td class="text-center">
            <?php
            switch ($data->status) {
              case '1':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_ruangan?>)"><span class="badge bg-warning"> sedang diperiksa</span></a>
              <?php break;

              case '2':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_ruangan?>)">
              <span class="badge bg-primary"> sedang diperbaiki</span>
              </a>
              <?php break;

              case '2':?>
                <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_ruangan?>)">
                <span class="badge bg-info"> divendorkan</span>
                </a>
                <?php break;
              
              case '4':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_ruangan?>)">
              <span class="badge bg-success"> selesai</span>
              </a>
              <?php break;

              case '5':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_ruangan?>)">
              <span class="badge bg-danger"> rusak</span>
              </a>
              <?php break;?>

              <?php
              default:?>
              <span class="badge bg-secondary"> perlu tindakan</span>
  
              <?php
              if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
              {
              ?>
              <a class="btn btn-sm btn-success ms-2" onclick="tindakan(<?= $data->id_kerusakan_ruangan?>)"><i class="fa fa-solid fa-check"></i></a>
              <?php } ?>

              <?php  break;?>
            <?php } ?>
             </td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <a href="<?= base_url('deteleruangan/'.$data->id_kerusakan_ruangan) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></td>
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

<!-- Modal Detail Laporan-->
<div class="modal fade" id="detailLaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Laporan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">     
            <div class="col-md-12">
              <img id="gambar_ruangan" width="200" alt="" srcset="" class="form-control-plaintext tabel-PR">
            </div>     
            <div class="col-md-12">
              <label for="nama_ruangan" class="form-label">Kondisi Ruangan</label>
              <input type="text" id="keterangan_kerusakan_ruangan" class="form-control-plaintext tabel-PR" required />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<!-- Modal Input Penanganan-->
<div class="modal fade" id="inputPenanganan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('ruangan/penangananKerusakan')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Penanganan Kerusakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">  
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">Tanggal Penanganan</label>
              <input type="hidden" name="id_kerusakan_ruangan" id="id_kerusakan_ruangan"/>
              <input type="date" name="tgl_penanganan" placeholder="kondisi_barang" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Status</label>
              <select name="status" class="form-select tabel-PR">
                <option value="0">--- pilih status ---</option>
                <option value="2">selesai</option>
                <option value="3">rusak</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="keterangan_penanganan" class="form-label">Keterangan</label>
              <textarea type="text" name="keterangan_penanganan" class="form-control tabel-PR"></textarea>
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

<!-- Modal Detail Penanganan-->
<div class="modal fade" id="detailPenanganan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Penanganan Kerusakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
            </thead>
            <tbody id="list_penanganan_ruangan">
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <form action="<?=base_url('ruangan/penangananKerusakan')?>" role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kerusakan_ruangan_id" id="kerusakan_ruangan_id"/>
        <?php
        if ($role != ROLE_MANAGER){ ?> 
        <div class="form-group">
          <div class="row">  
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">Tanggal Penanganan</label>
              <input type="date" name="tgl_penanganan" placeholder="kondisi_barang" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Status</label>
              <select name="status" class="form-select tabel-PR">
                <option value="0">--- pilih status ---</option>
                <option value="2">sedang diperbaiki</option>
                <option value="3">divendorkan</option>
                <option value="4">selesai</option>
                <option value="5">rusak</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="keterangan_penanganan" class="form-label">Keterangan</label>
              <textarea type="text" name="keterangan_penanganan" class="form-control tabel-PR"></textarea>
            </div>    
          </div>
        </div>
        <?php } ?>

      </div>
      <?php
      if ($role != ROLE_MANAGER){ ?> 
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
      <?php } ?>
    </div>
  </div>
</div>


<script>

  function editData($id){
    $.ajax({
      url:"<?php echo site_url("ruangan/detailruangan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        console.log(hasil.keterangan_ruangan);
        document.getElementById("id_ruangan").value = hasil.id_ruangan;
        document.getElementById("nama_ruangan").value = hasil.nama_ruangan;
        document.getElementById("lokasi_ruangan").value = hasil.divisi_id;
        document.getElementById("tgl_pembelian").value = hasil.tgl_pembelian;
        document.getElementById("stok_normal").value = hasil.stok_ruangan_normal;
        document.getElementById("stok_rusak").value = hasil.stok_ruangan_rusak;
        document.getElementById("keterangan_ruangan").value = hasil.keterangan_ruangan;
      }
    });
  }

  function tindakan($id){
    $.ajax({
      url:"<?php echo site_url("ruangan/approvalkerusakan")?>",
      dataType:"JSON",
      type: "POST",
      data : {id_kerusakan_ruangan : $id, status:1},
      success:function(hasil){
        window.location.reload();
      }
    });
  }

  function detailLaporan($id){
    $.ajax({
      url:"<?php echo site_url("ruangan/detailkerusakanruangan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const urlgambar = "<?= site_url("assets/foto_kerusakan_ruangan/")?>"+hasil.bukti_kerusakan_ruangan;

        document.getElementById("id_kerusakan_ruangan").value = $id;
        document.getElementById("keterangan_kerusakan_ruangan").value = hasil.keterangan_kerusakan_ruangan;

        $("#gambar_ruangan").attr('src',urlgambar);
        console.log(hasil);
      }
    });
  }

  function detailPenanganan($id){
    $.ajax({
      url:"<?php echo site_url("ruangan/listpenanganan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(data){
        console.log(data);
        document.getElementById("kerusakan_ruangan_id").value = $id;
        let html = '';
        for ( i=0; i < data.length ; i++){
          let no = i + 1;

          switch(data[i].status) {
          case "1":
            status = "sedang diperiksa";
            break;
          
          case "2":
            status = "sedang perbaiki";
            break;
          case "3":
            status = "divendorkan";
            break;

          case "4":
            status = "selesai";
            break;
          
          case "5":
            status = "rusak";
            break;
          }

          const months = ["Januari","Februari","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

          let d = new Date(data[i].tgl_penanganan);
          let month = months[d.getMonth()];
          let date = d.getDate();
          let year = d.getFullYear();
          
          html +=
          '<tr>'+
          '<td>'+no+'</td>'+
          '<td>'+date+' '+month+' '+year+'</td>'+
          '<td>'+status+'</td>'+
          '<td>'+data[i].keterangan_penanganan+'</td>'+
          '</tr>';
        }

        $("#list_penanganan_ruangan").html(html);

      }
    });
  }
</script>