
<div class="row">
  <div class="col-md-12">
    <div class="card">
    <div class="card-body">
    <div class="d-flex justify-content-end mb-4">
      <button class="btn btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#ModalAdd"><i class="fa fa-add"></i> Booking Ruangan</button>
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
          <th>Ruangan</th>
          <th>Peminjam</th>
          <th>Mulai Pinjam</th>
          <th>Selesai Pinjam</th>
          <th>Agenda</th>
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
          <td><?php echo $data->nama_pinjam_ruangan ?></td>
          <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
          <td><?php echo mediumdate_indo($data->tanggal_selesai).' '.$data->waktu_selesai ?></td>
          <td><?php echo $data->keterangan_pinjam ?></td>
          <?php
          if($role == ROLE_SUPERADMIN | $role == ROLE_ADMIN)
          {
          ?>
          <td class="text-center">
            <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editData" onclick="editData(<?= $data->id_ruangan?>)"><i class="fa fa-pencil"></i></button>
            <a href="<?= base_url('deteleRuangan/'.$data->id_ruangan) ?>" class="btn btn-sm btn-danger" ><i class="fa fa-trash"></i></a></td>
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
      <form action="<?=base_url('Ruangan/booking')?>" role="form" id="addPurchaseRequest" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Booking Ruangan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <div class="row">
            <div class="col-md-12">
              <label for="ruangan_id" class="form-label">Ruangan</label>
              <select name="ruangan_id" id="ruangan_id" placeholder="Ruangan" class="form-select tabel-PR" required>
                <option>--pilih ruangan--</option>
                <?php foreach($ruangan as $data){?>
                <option value=<?= $data->id_ruangan ?>><?= $data->nama_ruangan ?></option>
                <?php } ?>
              </select>
            </div> 
            <div class="col-md-12">
              <label for="kondisi_ruangan" class="form-label">Nama peminjam</label>
              <input type="text" name="nama_peminjam" placeholder="masukkan nama disini" class="form-control tabel-PR" required />
            </div>
            <div class="col-md-12">
              <label for="divisi_id" class="form-label">Divisi</label>
              <select name="divisi_id" class="form-select tabel-PR" required>
                <option>--pilih divisi--</option>
                <?php foreach($divisi as $data){?>
                <option value=<?= $data->id_divisi ?>><?= $data->nama_divisi ?></option>
                <?php } ?>
              </select>
            </div>  
            <div class="col-md-12">
              <label for="tgl_mulai" class="form-label">Tanggal Mulai</label>
              <input type="datetime-local" name="tgl_mulai" id="tgl_mulai" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
              <input type="datetime-local" name="tgl_selesai" id="tgl_selesai" class="form-control tabel-PR" required />
            </div>  
            <div class="col-md-12">
              <label for="keterangan_pinjam" class="form-label">Keperluan</label>
              <input type="text" name="keterangan_pinjam" id="keterangan_pinjam" placeholder="masukkan keperluan disini" class="form-control tabel-PR" required />
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
    events: "<?= base_url();?>ruangan/jadwalpinjam",
  });

  calendar.render();
});

</script>