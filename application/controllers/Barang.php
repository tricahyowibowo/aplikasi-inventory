<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Barang extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }

  public function cetakQRCode(){
    $id_barang = $this->uri->segment(3);

    $where = array(
      'id_barang' => $id_barang
    );

    $data['barang'] = $this->crud_model->GetDataById($where,'tbl_barang');

    $this->load->view('barang/cetak',$data);
  }


  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Data Barang';
    
    $divisi = $this->divisi_id;

    $data['list_data']= $this->master_model->getDataBarang($divisi);
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['id_divisi']= $divisi;

    $this->loadViews("barang/data", $this->global, $data, NULL);
  }

  public function detailbarang($id) {

    $where = array(
      'id_barang' => $id
    );

    $barang = $this->crud_model->GetDataById($where,'tbl_barang');
    echo json_encode($barang[0]);
  }

  public function cekStokBarang($id){
    $stok_barang = $this->master_model->cekStokBarang($id)->stok_barang_normal;

    echo json_encode($stok_barang);
  }

  public function detailkerusakanbarang($id) {

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $kerusakanbarang = $this->crud_model->GetDataById($where,'tbl_kerusakan_barang');
    echo json_encode($kerusakanbarang[0]);
  }

  public function update(){
    $id_barang = $this->input->post('id_barang');
    $nama_barang = $this->input->post('nama_barang');
    $tgl_pembelian = $this->input->post('tgl_pembelian');
    $divisi_id = $this->input->post('divisi_id');
    $kondisi_barang = $this->input->post('kondisi_barang');
    $stok_barang_normal = $this->input->post('stok_normal');
    $stok_barang_rusak = $this->input->post('stok_rusak');
    $keterangan_barang = $this->input->post('keterangan_barang');
    $spesifikasi_barang = $this->input->post('spesifikasi_barang');

    $where = array(
      'id_barang' => $id_barang
    );

    $data = array(
      'nama_barang' => $nama_barang,
      'tgl_pembelian' => $tgl_pembelian,
      'divisi_id' => $divisi_id,
      'stok_barang_normal' => $stok_barang_normal,
      'stok_barang_rusak' => $stok_barang_rusak,
      'keterangan_barang' => $keterangan_barang,
      'spesifikasi_barang' => $spesifikasi_barang
    );

    $sql = $this->crud_model->update($where, $data,'tbl_barang');

    if (isset($sql)){
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Diubah');
    }else{
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    }

    redirect('barang');
  }

  public function delete(){
    $id_barang = $this->uri->segment(2);

    $where = array(
      'id_barang' => $id_barang
    );

    $this->crud_model->delete($where, 'tbl_barang');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('barang');
  }

  public function jadwalpinjam(){

    $divisi = $this->divisi_id;
    $list_data  = $this->master_model->getjadwalbarang($divisi);

    foreach ($list_data->result_array() as $row){

        $data[] = array(
            'id' => $row['id_pinjam_barang'],
            'title' => $row['nama_barang'].' | '.$row['nama_pinjam_barang'].' '.$row['nama_divisi'].' | '.$row['jumlah_pinjam'].' pcs',
            'start' => $row['tanggal_mulai'],
            'end' => $row['tanggal_selesai']
        );
    }
    
    echo json_encode($data);
  }

  public function pinjambarang(){
    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';

    $name = $this->name;
    $divisi = $this->divisi_id;
    $data['list_data'] = $this->master_model->getjadwalbarang($divisi)->result();
    $data['barang']= $this->crud_model->lihatdata('tbl_barang');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->global['pageHeader'] = 'Peminjaman Barang PT. Mirota KSM';

    $this->loadViews("barang/datapeminjaman", $this->global, $data, NULL);
  }

  public function updateStokTersedia($barang_id, $cek_stok, $jumlah_barang){
    $cek_stok_dipinjam = $this->master_model->cekStokBarang($barang_id)->stok_barang_dipinjam;

    $stok_barang = $cek_stok - $jumlah_barang;
    $stok_barang_dipinjam = $cek_stok_dipinjam + $jumlah_barang;

    $stok = array(
      'stok_barang_normal' => $stok_barang,
      'stok_barang_dipinjam' => $stok_barang_dipinjam,
    );

    $where = array(
      'id_barang' => $barang_id,
    );

    $this->crud_model->update($where, $stok,'tbl_barang');
  }

  public function booking(){
    $this->load->library('form_validation');
            
    $this->form_validation->set_rules('divisi_id','Divisi','trim|required|numeric');
    $this->form_validation->set_rules('barang_id','barang','trim|required|numeric');
    if($this->form_validation->run() == FALSE)
    {
      $this->set_notifikasi_swal('error','GAGAL !!!','Data Divisi/barang Tidak Boleh Kosong');
      redirect('Pinjambarang');
    }
    else
    {

    $barang_id = $this->input->post('barang_id');
    $jumlah_barang = $this->input->post('jumlah_barang');
    $nama_peminjam = $this->input->post('nama_peminjam');
    $divisi_id = $this->input->post('divisi_id');
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_selesai = $this->input->post('tgl_selesai');

    $cek_stok = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;

    $data = array(
      'barang_id' => $barang_id,
      'jumlah_pinjam' => $jumlah_barang,
      'nama_pinjam_barang' => $nama_peminjam,
      'divisi_id' => $divisi_id,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
    );

    $cek = $this->uri->segment(1);

    if($cek_stok > 0){
      $this->updateStokTersedia($barang_id, $cek_stok, $jumlah_barang);

      $this->crud_model->input($data,'tbl_pinjam_barang');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','STOK KOSONG!!!','Stok tidak cukup');
    }



    if($cek != 'SimpanPeminjaman'){
      redirect('Pinjambarang');
    }else{
      redirect('Formpeminjaman');
    }
  }
  }

  public function detailpinjambarang($id) {
    $barang = $this->master_model->getPinjamBarangById($id);
    echo json_encode($barang[0]);
  }

  public function pengembalianbarang(){
    $id_pinjam_barang = $this->input->post('id_pinjam_barang');
    $jml_kembali = $this->input->post('jml_kembali');
    $tgl_kembali = $this->input->post('tgl_kembali');

    // update tanggal kembali
    $where  = array(
      'id_pinjam_barang' => $id_pinjam_barang,
    );

    $data = array(
      'tgl_kembali' => $tgl_kembali,
      'status_pinjam_barang' => 'I',
      'tgl_update' => DATE('Y-m-d H:i:s'),
      'updateId' => $this->vendorId
    );


    // update stok barang
    $barang = $this->master_model->getPinjamBarangById($id_pinjam_barang);

    foreach( $barang as $barang){
      $id_barang = $barang->id_barang;
    }

    $cek_stok = $this->master_model->cekStokBarang($id_barang)->stok_barang_normal;
    $cek_stok_dipinjam = $this->master_model->cekStokBarang($id_barang)->stok_barang_dipinjam;

    $stok_barang = $cek_stok + $jml_kembali;
    $stok_barang_dipinjam = $cek_stok_dipinjam - $jml_kembali;

    $wherestok = array(
      'id_barang' => $id_barang
    );

    $datastok = array(
      'stok_barang_normal' => $stok_barang,
      'stok_barang_dipinjam' => $stok_barang_dipinjam,
    );


    $updatestok = $this->crud_model->update($wherestok, $datastok,'tbl_barang');
    $pinjambarang = $this->crud_model->update($where, $data,'tbl_pinjam_barang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('Pinjambarang');
  }

  public function detailpenerima($id) {
    $barang = $this->master_model->getPenerimaById($id);
    echo json_encode($barang[0]);
  }

  public function deletepinjamanbarang(){
    $id_pinjam_barang = $this->uri->segment(3);

    $where = array(
      'id_pinjam_barang' => $id_pinjam_barang
    );

    $this->crud_model->delete($where, 'tbl_pinjam_barang');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('Pinjambarang');
  }

  public function peminjamanbarang(){
    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';

    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->global['pageHeader'] = 'Peminjaman Barang PT. Mirota KSM';


    $this->loadViews("barang/peminjamanbarang", $this->global, $data, NULL);
  }

  public function formpeminjaman(){

    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';

    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $this->global['pageHeader'] = 'Peminjaman Barang PT. Mirota KSM';


    $this->loadViews("barang/formpeminjaman", $this->global, $data, NULL);
  }

  public function getbarangByDivisi(){
    $divisi = $this->input->post('id_divisi');
    $barang = $this->master_model->getBarangByDivisi($divisi);

    echo json_encode($barang);
  }

  public function laporankerusakan(){
    $this->global['pageTitle'] = 'SI ATTA | Asset Mirota';
      
    $this->global['pageHeader'] = 'Laporan Kerusakan barang';
    
    $data['barang']= $this->crud_model->lihatdata('tbl_barang');
    
    $this->loadViews("barang/formlaporan", $this->global, $data, NULL);
  }

  public function savelaporan(){
    $config['upload_path']          = FCPATH.'assets/foto_kerusakan_barang';
    $config['allowed_types']        = 'gif|jpg|png|PNG|jpeg|pdf';

    $barang_id = $this->input->post('barang_id');
    $jml_barang = $this->input->post('jml_barang');
    $keterangan_kerusakan_barang = $this->input->post('keterangan');

    $this->load->library('upload', $config);

    if ( ! $this->upload->do_upload('bukti_kerusakan'))
    {
      $this->set_notifikasi_swal('error','Gagal','Harus melampirkan bukti');
    }
    else
    {

      $file = $this->upload->data();
      $bukti_kerusakan = $file['file_name'];

      $data = array(
        'barang_id' => $barang_id,
        'jml_barang' => $jml_barang,
        'keterangan_kerusakan_barang' => $keterangan_kerusakan_barang,
        'bukti_kerusakan_barang' => $bukti_kerusakan,
        'datecreated' => date('Y-m-d H:i:s')
      );

      $this->crud_model->input($data,'tbl_kerusakan_barang');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }

    redirect('barang/laporankerusakan');
  }

  public function listkerusakan(){
    $this->global['pageTitle'] = 'SI ATTA | Asset Mirota';
    $this->global['pageHeader'] = 'Laporan Kerusakan barang';

    $data['list_data']= $this->master_model->getLaporanKerusakanBarang();
    
    $this->loadViews("barang/laporanKerusakan", $this->global, $data, NULL);
  }

  public function bacanotif(){
    $id_divisi = $this->$divisi_id;


    $notif = $this->master_model->cekDataNotifBarang($divisi_id);

    foreach ($notif as $n) {
      $data = array(
        'is_read' => 1,
      );

      $where = array(
        'id_kerusakan_barang' => $n->id_kerusakan_barang
      );

      $this->crud_model->update($where, $data, 'tbl_kerusakan_barang');
    }
  }


  public function approvalPenanganan($id, $tgl_penanganan, $status){
    $penanganan = array(
      'kerusakan_barang_id' => $id,
      'tgl_penanganan' => $tgl_penanganan,
      'status' => $status
    );

    $this->crud_model->input($penanganan,'tbl_penanganan_barang');
  }

  public function updateStokBarang($barang_id, $jml_barang_rusak){
    $cek_stok_normal = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;
    $cek_stok_rusak = $this->master_model->cekStokBarang($barang_id)->stok_barang_rusak;

    $wherestok = array(
      'id_barang' => $barang_id
    );

    $stok = array(
     'stok_barang_normal' =>  $cek_stok_normal - $jml_barang_rusak,
     'stok_barang_rusak' =>  $cek_stok_rusak + $jml_barang_rusak,
    );

    $this->crud_model->update($wherestok,$stok,'tbl_barang');
  }
  
  public function approvalkerusakan(){
    $id = $this->input->post('id_kerusakan_barang');
    $barang_id = $this->input->post('barang_id');
    $jml_barang_rusak = $this->input->post('jml_barang_rusak');
    $status = $this->input->post('status');
    $tgl_penanganan = DATE('Y-m-d');

    $this->approvalPenanganan($id, $tgl_penanganan, $status);
    $this->updateStokBarang($barang_id, $jml_barang_rusak);

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $data = array(
      'status' => $status,
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_barang');
    echo json_encode($data);
  }

  public function listpenanganan($id){
    $this->isLoggedIn();   

    $where = array(
      'kerusakan_barang_id' => $id
    );

    $penangananbarang = $this->master_model->getPenangananById($where,'tbl_penanganan_barang');
    echo json_encode($penangananbarang);
  }

  public function updateStatusPenanganan($id, $status){

    $where = array(
      'id_kerusakan_barang' => $id
    );

    $data = array(
      'status' => $status,
    );

    $this->crud_model->update($where,$data,'tbl_kerusakan_barang');
  }

  public function tambahStokNormal($barang_id, $jml_barang){
    $cek_stok_normal = $this->master_model->cekStokBarang($barang_id)->stok_barang_normal;
    $cek_stok_rusak = $this->master_model->cekStokBarang($barang_id)->stok_barang_rusak;

    $where = array(
      'id_barang' => $barang_id
    );

    $data = array(
     'stok_barang_normal' =>  $cek_stok_normal + $jml_barang,
     'stok_barang_rusak' =>  $cek_stok_rusak - $jml_barang
    );

    $this->crud_model->update($where,$data,'tbl_barang');
  }

  public function penangananKerusakan(){
    $id = $this->input->post('kerusakan_barang_id');
    $tgl_penanganan = $this->input->post('tgl_penanganan');
    $status = $this->input->post('status');
    $keterangan_penanganan = $this->input->post('keterangan_penanganan');

    $barang_id = $this->master_model->getBarangByPenangananId($id)->barang_id;
    $jml_barang = $this->master_model->getBarangByPenangananId($id)->jml_barang;

    var_dump($barang_id);
    var_dump($jml_barang);

    switch ($status) {
      case 4:
        $this->tambahStokNormal($barang_id, $jml_barang);
        break;
    }

    $data = array(
      'kerusakan_barang_id' => $id,
      'status' => $status,
      'tgl_penanganan' => $tgl_penanganan,
      'keterangan_penanganan' => $keterangan_penanganan,
    );

    $this->crud_model->input($data,'tbl_penanganan_barang');
    $this->updateStatusPenanganan($id, $status);
    redirect('kerusakanBarang');
  }

  public function cetakSemua(){
    $id = $this->input->post('id_barangcheck');

    if(isset($id)){
    $id = implode(',',$id);
    $data['barang'] = $this->crud_model->SelectIn($id, 'id_barang', 'tbl_barang');
    }else{
      $data['barang'] = $this->crud_model->lihatdata('tbl_barang');
    }

    $this->load->view('barang/cetak',$data);
  }

  public function cekBarang(){
    $this->global['pageTitle'] = 'Cek Barang';
    $this->global['pageHeader'] = 'Cek Barang';

    $this->loadViews("barang/cekbarang", $this->global, NULL);
  }
}
