
<div class="row" id="scanbarcode">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <div class="card-body">
          <div class="d-flex justify-content-center">
              <div class="col-md-6" id="scancekbarang">
                <div style="width:100%;" id="reader"></div>
              </div>
          </div>

          <div class="row" id="infobarang">
            <div class="col-md-3">
              <button class="btn btn-info" onclick="scanbarcode()"><i class="fa fa-magnifying-glass"></i> scan barang</button>
            </div>
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-6">
                  <label for="nama_barang" class="form-label">Nama barang</label>
                  <input type="text" id="nama_barang" class="form-control-plaintext tabel-PR" required />
                </div>
                <div class="col-md-6">
                  <label for="stok_barang_normal" class="form-label">Stok barang tersedia</label>
                  <input type="text" name="stok_normal" id="stok_normal" class="form-control-plaintext tabel-PR" required />
                </div>
                <div class="col-md-6">
                  <label for="stok_barang_dipinjam" class="form-label">Stok barang dipinjam</label>
                  <input type="text" name="stok_dipinjam" id="stok_dipinjam" class="form-control-plaintext tabel-PR" required />
                </div>
                <div class="col-md-6">
                  <label for="stok_barang_rusak" class="form-label">Stok barang rusak</label>
                  <input type="text" name="stok_rusak" id="stok_rusak" class="form-control-plaintext tabel-PR" required />
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label for="tgl_pembelian" class="form-label">Tanggal Pembelian</label>
                  <input type="text" name="tgl_pembelian" id="tgl_pembelian" class="form-control-plaintext tabel-PR" required />
                </div>
                <div class="col-md-6">
                  <label for="spesifikasi_barang" class="form-label">Spesifikasi Barang</label>
                  <textarea  class="form-control-plaintext tabel-PR" name="spesifikasi_barang" id="spesifikasi_edit" cols="30" rows="5"></textarea>
                </div>
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>

// QRCODE
function onScanSuccess(qrCodeMessage) {
  $("#infobarang").show();
  $("#scancekbarang").hide();
  $.ajax({
    url:"<?php echo site_url("barang/detailbarang")?>/" + qrCodeMessage,
    dataType:"JSON",
    type: "get",
    success:function(hasil){
      const months = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agust","Sep","Okt","Nov","Des"];

      let d = new Date(hasil.tgl_pembelian);
      let month = months[d.getMonth()];
      let date = d.getDate();
      let year = d.getFullYear();

      document.getElementById("nama_barang").value = hasil.nama_barang;
      document.getElementById("tgl_pembelian").value = date+' '+month+' '+year;
      document.getElementById("stok_normal").value = hasil.stok_barang_normal+" item";
      document.getElementById("stok_dipinjam").value = hasil.stok_barang_dipinjam+" item";
      document.getElementById("stok_rusak").value = hasil.stok_barang_rusak+" item";
      document.getElementById("spesifikasi_edit").value = hasil.spesifikasi_barang;
    }
  });
}

function onScanError(qrCodeMessage) {
  Swal.fire({
				icon: 'error',
				title: 'Gagal!!',
				text: 'gagal scan',
				position: "center",
				showConfirmButton: false,
  			timer: 1500
				})
}

function scanbarcode(){
  window.location.reload();
}
</script>