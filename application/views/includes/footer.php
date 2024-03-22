<?php 
if(isset($name)){ ?>
</div>
</main>
<?php 
}else{ ?>
</div>
<?php 
} ?>
<footer class="footer" style="background-color:#1c88e3;">
	<div class="container-fluid">
		<div class="row text-muted">
			<div class="col-6 text-start">
				<p class="mb-0 text-white">
					<strong>Copyright &copy;</strong> - <a class="text-muted" href="https://mirota.id/" target="_blank"><strong class="text-white">TIM IT PT Mirota KSM <?= DATE('Y')?></strong></a>
				</p>
			</div>
			<div class="col-6 text-end">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a class="text-white" href="https://wa.me/08993932789" target="_blank">Support</a>
					</li>
					<li class="list-inline-item">
						<a class="text-white" href="https://wa.me/08993932789" target="_blank">Help Center</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<div class="flash-data" data-icon="<?= $this->session->flashdata('swal_icon')?>"  data-title="<?= $this->session->flashdata('swal_title')?>"  data-text="<?= $this->session->flashdata('swal_text')?>"></div>
</div>


	<!-- jQuery 3 -->
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

	<!-- Popper -->
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
	
	<!-- Bootsrap 5 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>



	<!-- Datatable -->
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

	<!-- AdminKit -->
	<script src="<?php echo base_url(); ?>assets/adminkit/js/app.js"></script>

	<!-- FullCalendar -->
	<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.10/index.global.min.js"></script>
	
	<!-- SELECT2 -->
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<script src="<?php echo base_url(); ?>assets/dist/js/html5-qrcode.min.js"></script>


	<script>
		$(document).ready(function() {

 		 	$("#infobarang").hide();
			swal();
			datatable();
			indicator();
			datatableDashboard();
			checklist();
			$('.selectDivisi, .selectBarang').select2({
				theme: 'bootstrap-5',
				placeholder: "Pilih disini",
				allowClear: true
			});

			const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
			const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
	});

	function checklist(){
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
	}

	function indicator(){
			// setInterval(function(){
			$.ajax({
      url:"<?php echo site_url("dashboard/notiflaporan")?>",
      dataType:"JSON",
      type: "get",
      success:function(hasil){
				let notif_ruangan = hasil.jumlah_notif_ruangan;
				let notif_barang = hasil.jumlah_notif_barang;

				total = parseInt(notif_ruangan)+parseInt(notif_barang);
        document.getElementById("indicator").innerHTML = total;
        document.getElementById("indicator-header").innerHTML = total+" laporan baru";
        document.getElementById("indicator-barang").innerHTML = notif_barang+" laporan baru";
        document.getElementById("indicator-ruangan").innerHTML = notif_ruangan+" laporan baru";
      }
			// }, 2000);
    });
	}

	var html5QrcodeScanner = new Html5QrcodeScanner(
			"reader", { fps: 10, qrbox: 250 });
	html5QrcodeScanner.render(onScanSuccess, onScanError);

	function bacaNotifRuangan(){
		$.ajax({
      url:"<?php echo site_url("ruangan/bacanotif")?>",
      dataType:"JSON",
      type: "get",
    });
	}

	function bacaNotifBarang(){
		$.ajax({
      url:"<?php echo site_url("barang/bacanotif")?>",
      dataType:"JSON",
      type: "get",
    });
	}

	function swal(){

		const icon = $('.flash-data').data('icon');
		const tittle = $('.flash-data').data('title');
		const text = $('.flash-data').data('text');

		if (icon){
			Swal.fire({
			icon: icon,
			title: tittle,
			text: text,
			position: "center",
			showConfirmButton: false,
			timer: 1500
			})
		}
	}

	function datatable(){
		Object.assign(DataTable.defaults, {
		searching: true,
		responsive: true,
		ordering: true
		});
		
		new DataTable('#DataTable, #DataMontor');
	}

	function datatableDashboard(){
		Object.assign(DataTable.defaults, {
		paging: false,
		searching: true,
		ordering: false,
		info: false,
		responsive: true
		});
		
		new DataTable('#DashboardRuangan, #DashboardBarang');
	}

	// Script Navbar active
	var windowURL = window.location.href;
	pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
	var x= $('a[href="'+pageURL+'"]');
			x.addClass('active');
			x.parent().addClass('active');
	var y= $('a[href="'+windowURL+'"]');
			y.addClass('active');
			y.parent().addClass('active');
</script>

</body>

</html>