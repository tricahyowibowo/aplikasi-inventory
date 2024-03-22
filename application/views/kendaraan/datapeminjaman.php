
<div class="row">
  <div class="col-md-12">
    <div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-end mb-4">
      <button class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="fa fa-add"></i> Booking barang</button>
    </div>
    <div class="calendar" id='calendar'></div>
    </div>
    </div>
  </div>
</div>
<?php 
if(isset($name)){ ?>
<div class="row" >
  <div class="card">
    <div class="card-body table-responsive no-padding">
      <table id="DataTable" class="table table-hover">
        <thead>
        <tr>
          <th>No</th>
          <th>Barang</th>
          <th>Peminjam</th>
          <th>Qty</th>
          <th>Mulai Pinjam</th>
          <th>Selesai Pinjam</th>
          <th class="text-center">Tanggal Kembali</th>
          <th>Status</th>
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
          <td><?php echo $data->nama_pinjam_barang ?></td>
          <td><?php echo $data->jumlah_pinjam ?> pcs</td>
          <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
          <td><?php echo mediumdate_indo($data->tanggal_selesai).' '.$data->waktu_selesai ?></td>
            <?php if(is_null($data->tanggal_kembali)){?>
              <td class="text-center">
              <button class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#ModalKembali" onclick="detailBarang(<?= $data->id_pinjam_barang?>)">kembali</button>
              </td>
            <?php }else{ ?>
              <td>
              <?php echo mediumdate_indo($data->tanggal_kembali).' '.$data->waktu_kembali ?>
              </td>
            <?php } ?>
          <td>
            <?php
            switch ($data->status_pinjam_barang) {
              case 'N':?>
              <span class="badge bg-danger">dipinjam</span>
              <?php break;?>
              
              <?php case 'I':?>
              <span class="badge bg-success">sudah kembali</span>
              <?php break;?>
            <?php 
            }
            ?>
          </td>
          <?php
          if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
          {
          ?>
          <td class="text-center">
            <?php if(isset($data->tanggal_kembali)){?>
              <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#ModalPenerima" onclick="detailPenerima(<?= $data->id_pinjam_barang?>)"><i class="fa fa-solid fa-eye"></i></button>
            <?php } ?>
            <a href="<?= base_url('barang/deletepinjamanbarang/'.$data->id_pinjam_barang) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
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
<?php } ?>

<!-- Modal -->
<div class="modal fade" id="ModalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('barang/booking')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Booking barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="barang_id" class="form-label">Barang</label>
              <select name="barang_id" placeholder="barang" class="form-select tabel-PR">
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
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Barang Kembali-->
<div class="modal fade" id="ModalKembali" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?=base_url('barang/pengembalianbarang')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Barang Kembali</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama barang</label>
              <input type="hidden" name="id_pinjam_barang" id="id_pinjam_barang"/>
              <input type="hidden" name="id_barang" id="id_barang"/>
              <input type="text" name="nama_barang" id="nama_barang" class="form-control tabel-PR" readonly />
            </div>
            <div class="col-md-12">
              <div class="row">
              <div class="col-md-6">
                <label for="nama_barang" class="form-label">Jumlah Pinjam</label>
                <input type="text" name="jumlah_pinjam" id="jumlah_pinjam" class="form-control tabel-PR" readonly />
              </div>
              <div class="col-md-6">
                <label for="nama_barang" class="form-label">Jumlah Kembali</label>
                <input type="text" name="jml_kembali" class="form-control tabel-PR" required />
              </div>
              </div>
            </div>
            <div class="col-md-12">
              <label for="tgl_kembali" class="form-label">tanggal pengembalian</label>
              <input type="datetime-local" name="tgl_kembali" id="tgl_kembali" class="form-control tabel-PR" />
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

<!-- Modal Barang Kembali-->
<div class="modal fade" id="ModalPenerima" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti Penerima</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="nama_barang" class="form-label">Nama Penerima</label>
              <input type="text" name="name" id="name" class="form-control tabel-PR" readonly />
            </div>         
          </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'listMonth',
    locale: 'id',
    themeSystem: 'bootstrap5',
    editable : true,
    headerToolbar: {
      left: 'title',
      center: false,
      right: 'prev,next'
    },
    events: "<?= base_url();?>barang/jadwalpinjam",
  });

  calendar.render();
});

function detailBarang($id){
  $.ajax({
    url:"<?php echo site_url("barang/detailpinjambarang")?>/" + $id,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      document.getElementById("id_pinjam_barang").value = hasil.id_pinjam_barang;
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