
<div class="row">
  <div class="d-flex justify-content-end mb-4">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Tambah Data</button>
  </div>

  <div class="col-md-12">
    <div class="card card-primary">
      <div class="card-header">
          <h3 class="card-title">Data barang</h3>
      </div><!-- /.box-header -->
      <div class="card-body table-responsive no-padding">
        <table id="DataTable" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Nama barang</th>
            <th>Jumlah barang</th>
            <th>Tanggal Pengaduan</th>
            <th class="text-center">Detail Laporan</th>
            <th class="text-center">Detail Penanganan</th>
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
            <td><?php echo $data->nama_barang ?></td>
            <td class="text-center"><?php echo $data->jml_barang ?></td>
            <td><?php echo mediumdate_indo($data->tgl_pengaduan).' | '.$data->waktu_pengaduan  ?></td>
            <td class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#detailLaporan" onclick="detailLaporan(<?= $data->id_kerusakan_barang?>)"><i class="fa fa-solid fa-eye" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="lihat detail"></i></a></td>
            <td class="text-center">
            <?php
            switch ($data->status) {
              case '1':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_barang?>)"><span class="badge bg-warning"> sedang diperiksa</span></a>
              <?php break;

              case '2':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_barang?>)">
              <span class="badge bg-primary"> sedang diperbaiki</span>
              </a>
              <?php break;

              case '2':?>
                <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_barang?>)">
                <span class="badge bg-info"> divendorkan</span>
                </a>
                <?php break;
              
              case '4':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_barang?>)">
              <span class="badge bg-success"> selesai</span>
              </a>
              <?php break;

              case '5':?>
              <a data-bs-toggle="modal" data-bs-target="#detailPenanganan" onclick="detailPenanganan(<?= $data->id_kerusakan_barang?>)">
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
              <a class="btn btn-sm btn-success ms-2" onclick="tindakan(<?= $data->id_kerusakan_barang?>,<?= $data->barang_id?>,<?= $data->jml_barang?>)"><i class="fa fa-solid fa-check"></i></a>
              <?php } ?>
              <?php  break;?>
            <?php } ?>
            </td>
            <?php
            if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
            {
            ?>
            <td class="text-center">
              <a href="<?= base_url('detelebarang/'.$data->id_kerusakan_barang) ?>" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="hapus"><i class="fa fa-trash"></i></a></td>
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

<!-- Modal Edit-->
<div class="modal fade" id="editData" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('barang/penangananKerusakan')?>" role="form" id="editbarang" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-3" id="exampleModalLabel">Penanganan Kerusakan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">  
            <div class="col-md-12">
              <label for="tgl_pembelian" class="form-label">Tanggal Penanganan</label>
              <input type="hidden" name="id_kerusakan_barang" id="id_kerusakan_barang"/>
              <input type="date" name="tgl_penanganan" id="tgl_penanganan" placeholder="kondisi_barang" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Status</label>
              <select name="status" id="status" class="form-select tabel-PR">
                <option>--- pilih status ---</option>
                <option value="2">selesai</option>
                <option value="3">rusak</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="keterangan_kerusakan_barang" class="form-label">Keterangan</label>
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
              <img id="gambar_barang" width="200" alt="" srcset="" class="form-control-plaintext tabel-PR">
            </div>     
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Kondisi barang</label>
              <input type="text" id="keterangan_kerusakan_barang" class="form-control-plaintext tabel-PR" required />
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
      </div>
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
            <tbody id="list_penanganan_barang">
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <form action="<?=base_url('barang/penangananKerusakan')?>" role="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="kerusakan_barang_id" id="kerusakan_barang_id"/>
        <?php
        if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
        {
        ?>
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
      </div>
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
      url:"<?php echo site_url("barang/detailkerusakanbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        document.getElementById("id_kerusakan_barang").value = $id;
        document.getElementById("keterangan_kerusakan_barang").value = hasil.keterangan_kerusakan_barang;
      }
    });
  }

  function tindakan($id_kerusakan_barang, $barang_id, $jml_barang_rusak){
    $.ajax({
      url:"<?php echo site_url("barang/approvalkerusakan")?>",
      dataType:"JSON",
      type: "POST",
      data : {
        id_kerusakan_barang : $id_kerusakan_barang,
        barang_id : $barang_id,
        jml_barang_rusak:$jml_barang_rusak,
        status:1},
      success:function(hasil){
        console.log(hasil);
        window.location.reload();
      }
    });
  }

  function detailLaporan($id){
    $.ajax({
      url:"<?php echo site_url("barang/detailkerusakanbarang")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(hasil){
        const urlgambar = "<?= site_url("assets/foto_kerusakan_barang/")?>"+hasil.bukti_kerusakan_barang;

        document.getElementById("id_kerusakan_barang").value = $id;
        document.getElementById("keterangan_kerusakan_barang").value = hasil.keterangan_kerusakan_barang;

        $("#gambar_barang").attr('src',urlgambar);
        console.log(hasil);
      }
    });
  }

  function detailPenanganan($id){
    $.ajax({
      url:"<?php echo site_url("barang/listpenanganan")?>/" + $id,
      dataType:"JSON",
      type: "get",
      success:function(data){
        document.getElementById("kerusakan_barang_id").value = $id;

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

          const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

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

        $("#list_penanganan_barang").html(html);

      }
    });
  }
</script>