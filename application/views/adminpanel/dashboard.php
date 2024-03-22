<div class="row">
  <div class="card card-dashboard">
    <div class="card-body d-flex flex-wrap align-items-center">
        <h1>Hai, Selamat Datang kembali <span class="header-dashboard"><?= $name ?></span></h1>
    </div>
  </div>
</div>
<?php
if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER || $role == ROLE_ADMIN || $role == ROLE_HRD){?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data peminjaman barang</h3>
        </div>
        <div class="card-body table-responsive">
        <table id="DashboardBarang" class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Barang</th>
              <th>Peminjam</th>
              <th>Qty</th>
              <th>Mulai Pinjam</th>
              <th>Selesai Pinjam</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            if(!empty($barang))
            {
              foreach($barang as $data):
            ?>
            <tr>
              <td><?php echo $no++ ?></td>
              <td><?php echo $data->nama_barang ?></td>
              <td><?php echo $data->nama_pinjam_barang ?></td>
              <td><?php echo $data->jumlah_pinjam ?> pcs</td>
              <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
              <td><?php echo mediumdate_indo($data->tanggal_selesai).' '.$data->waktu_selesai ?></td>
            </tr>
            <?php
              endforeach;
            }
            ?>
          </tbody>
        </table>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('Pinjambarang'); ?>">lihat selengkapnya <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
    if($role == ROLE_SUPERADMIN || $role == ROLE_MANAGER || $role == ROLE_HRD){?>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Data peminjaman ruangan</h3>
        </div>
        <div class="card-body table-responsive">
        <table id="DashboardRuangan" class="table table-hover">
          <thead>
          <tr>
            <th>No</th>
            <th>Ruangan</th>
            <th>Peminjam</th>
            <th>Mulai Pinjam</th>
            <th>Selesai Pinjam</th>
            <th>Agenda</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(!empty($ruangan))
          {
            foreach($ruangan as $data):
          ?>
          <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data->nama_ruangan ?></td>
            <td><?php echo $data->nama_pinjam_ruangan ?></td>
            <td><?php echo mediumdate_indo($data->tanggal_mulai).' '.$data->waktu_mulai ?></td>
            <td><?php echo mediumdate_indo($data->tanggal_selesai).' '.$data->waktu_selesai ?></td>
            <td><?php echo $data->keterangan_pinjam ?></td>
          </tr>
          <?php
            endforeach;
          }
          ?>
          </tbody>
        </table>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-end">
            <a href="<?php echo base_url('Pinjamruangan'); ?>">lihat selengkapnya <i class="fa fa-arrow-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
<?php } ?>