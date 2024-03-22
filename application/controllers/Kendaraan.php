<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Kendaraan extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
      
      $name = $this->session->userdata ( 'name' );
    
      if(isset($name)){
      $this->isLoggedIn();
      }
  }


  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Dashboard';
      
    $data['mobil']= $this->master_model->getDataMobil();
    $data['montor']= $this->master_model->getDataMontor();
    
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');


    $this->loadViews("kendaraan/data", $this->global, $data, NULL);
  }

  public function save(){
    $merek_kendaraan = $this->input->post('merek_kendaraan');
    $jenis_kendaraan = $this->input->post('jenis_kendaraan');
    $merek_kendaraan = $this->input->post('merek_kendaraan');
    $nomor_polisi = $this->input->post('nomor_polisi');
    $tgl_stnk = $this->input->post('tgl_stnk');
    $tahun = $this->input->post('tahun');


    $data = array(
      'merek_kendaraan' => $merek_kendaraan,
      'jenis_kendaraan' => $jenis_kendaraan,
      'merek_kendaraan' => $merek_kendaraan,
      'nomor_polisi' => $nomor_polisi,
      'tgl_stnk' => $tgl_stnk,
      'tahun' => $tahun,
    );

    $sql = $this->crud_model->input($data,'tbl_kendaraan');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('kendaraan');
  }

  public function detailkendaraan($id) {

    $where = array(
      'id_kendaraan' => $id
    );

    $kendaraan = $this->crud_model->GetDataById($where,'tbl_kendaraan');
    echo json_encode($kendaraan[0]);
  }

  public function update(){
    $id_kendaraan = $this->input->post('id_kendaraan');
    $merek_kendaraan = $this->input->post('merek_kendaraan');
    $nomor_polisi = $this->input->post('nomor_polisi');
    $tgl_stnk = $this->input->post('tgl_stnk');
    $tahun = $this->input->post('tahun');

    $where = array(
      'id_kendaraan' => $id_kendaraan
    );

    $data = array(
      'merek_kendaraan' => $merek_kendaraan,
      'merek_kendaraan' => $merek_kendaraan,
      'nomor_polisi' => $nomor_polisi,
      'tgl_stnk' => $tgl_stnk,
      'tahun' => $tahun,
    );

    $sql = $this->crud_model->update($where, $data,'tbl_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    redirect('kendaraan');
  }

  public function delete(){
    $id_kendaraan = $this->uri->segment(2);

    $where = array(
      'id_kendaraan' => $id_kendaraan
    );

    $this->crud_model->delete($where, 'tbl_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('kendaraan');
  }

  public function perawatan(){
    $this->global['pageTitle'] = 'Admin Panel : Perawatan Kendaraan';

    $id = $this->uri->segment(3);
    
    $data['data_kendaraan']= $this->master_model->getDataKendaraanById($id);
    $data['list_data']= $this->master_model->getDataPerawatanByIdKendaraan($id);


    $this->loadViews("kendaraan/dataperawatan", $this->global, $data, NULL);
  }

  public function simpanperawatan(){
    $kendaraan_id = $this->input->post('id_kendaraan');
    $tgl_perawatan = $this->input->post('tgl_perawatan');
    $detail_perawatan = $this->input->post('detail_perawatan');


    $data = array(
      'kendaraan_id' =>$kendaraan_id,
      'tgl_perawatan' =>$tgl_perawatan,
      'detail_perawatan' =>$detail_perawatan
    );

    $this->crud_model->input($data,'tbl_perawatan_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil!!!','Data Berhasil Disimpan');
    redirect('kendaraan/perawatan/'.$kendaraan_id);
  }

  public function deleteperawatan(){
    $id = $this->uri->segment(3);

    $where = array(
      'id_perawatan_kendaraan' => $id
    );

    $this->crud_model->delete($where,'tbl_perawatan_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('kendaraan');
  }

  public function jadwalpinjam(){
    $list_data  = $this->master_model->getjadwalkendaraan();

    foreach ($list_data->result_array() as $row){

        $data[] = array(
            'id' => $row['id_pinjam_kendaraan'],
            'title' => $row['nama_kendaraan'].' | '.$row['nama_pinjam_kendaraan'].' '.$row['nama_divisi'].' | '.$row['jumlah_pinjam'].' pcs',
            'start' => $row['tanggal_mulai'],
            'end' => $row['tanggal_selesai']
        );
    }
    
    echo json_encode($data);
  }

  public function pinjamkendaraan(){
    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';
    $data['list_data'] = $this->master_model->getjadwalkendaraan()->result();
    $data['kendaraan']= $this->crud_model->lihatdata('tbl_kendaraan');
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->global['pageHeader'] = 'Peminjaman kendaraan PT. Mirota KSM';


    $this->loadViews("kendaraan/datapeminjaman", $this->global, $data, NULL);
  }

  public function booking(){
    $this->load->library('form_validation');
            
    $this->form_validation->set_rules('divisi_id','Divisi','trim|required|numeric');
    $this->form_validation->set_rules('kendaraan_id','kendaraan','trim|required|numeric');
    if($this->form_validation->run() == FALSE)
    {
      $this->set_notifikasi_swal('error','GAGAL !!!','Data Divisi/kendaraan Tidak Boleh Kosong');
      redirect('Pinjamkendaraan');
    }
    else
    {
    $kendaraan_id = $this->input->post('kendaraan_id');
    $jumlah_kendaraan = $this->input->post('jumlah_kendaraan');
    $nama_peminjam = $this->input->post('nama_peminjam');
    $divisi_id = $this->input->post('divisi_id');
    $tgl_mulai = $this->input->post('tgl_mulai');
    $tgl_selesai = $this->input->post('tgl_selesai');


    $data = array(
      'kendaraan_id' => $kendaraan_id,
      'jumlah_pinjam' => $jumlah_kendaraan,
      'nama_pinjam_kendaraan' => $nama_peminjam,
      'divisi_id' => $divisi_id,
      'tgl_mulai' => $tgl_mulai,
      'tgl_selesai' => $tgl_selesai,
    );

    $cek_stok = $this->master_model->cekStokkendaraan($kendaraan_id);

    if($cek_stok > $jumlah_kendaraan){
      $stok_kendaraan = $cek_stok - $jumlah_kendaraan;
  
      $stok = array(
        'stok_kendaraan_normal' => $stok_kendaraan,
      );
  
      $where = array(
        'id_kendaraan' => $kendaraan_id,
      );
  
      $sql = $this->crud_model->input($data,'tbl_pinjam_kendaraan');
      $sql2 = $this->crud_model->update($where, $stok,'tbl_kendaraan');
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','GAGAL!!!','Stok tidak cukup');
    }

    if(isset($name)){
      redirect('Pinjamkendaraan');
    }else{
      $divisi = $this->uri->segment(2);
      redirect('Formpeminjaman/'.$divisi);
    }
  }
  }

  public function detailpinjamkendaraan($id) {
    $kendaraan = $this->master_model->getPinjamkendaraanById($id);
    echo json_encode($kendaraan[0]);
  }

  public function pengembaliankendaraan(){
    $id_pinjam_kendaraan = $this->input->post('id_pinjam_kendaraan');
    $jml_kembali = $this->input->post('jml_kembali');
    $tgl_kembali = $this->input->post('tgl_kembali');

    // update tanggal kembali
    $where  = array(
      'id_pinjam_kendaraan' => $id_pinjam_kendaraan,
    );

    $data = array(
      'tgl_kembali' => $tgl_kembali,
      'status_pinjam_kendaraan' => 'I',
      'tgl_update' => DATE('Y-m-d H:i:s'),
      'updateId' => $this->vendorId
    );


    // update stok kendaraan
    $kendaraan = $this->master_model->getPinjamkendaraanById($id_pinjam_kendaraan);

    foreach( $kendaraan as $kendaraan){
      $id_kendaraan = $kendaraan->id_kendaraan;
    }

    $cek_stok = $this->master_model->cekStokkendaraan($id_kendaraan);
    $stok_kendaraan = $cek_stok + $jml_kembali;

    $wherestok = array(
      'id_kendaraan' => $id_kendaraan
    );

    $datastok = array(
      'stok_kendaraan_normal' => $stok_kendaraan
    );


    $this->crud_model->update($wherestok, $datastok,'tbl_kendaraan');
    $this->crud_model->update($where, $data,'tbl_pinjam_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('Pinjamkendaraan');
  }

  public function detailpenerima($id) {
    $kendaraan = $this->master_model->getPenerimaById($id);
    echo json_encode($kendaraan[0]);
  }

  public function deletepinjamankendaraan(){
    $id_pinjam_kendaraan = $this->uri->segment(3);

    $where = array(
      'id_pinjam_kendaraan' => $id_pinjam_kendaraan
    );

    $this->crud_model->delete($where, 'tbl_pinjam_kendaraan');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('Pinjamkendaraan');
  }

  public function peminjamankendaraan(){
    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';

    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->global['pageHeader'] = 'Peminjaman kendaraan PT. Mirota KSM';


    $this->loadViews("kendaraan/peminjamankendaraan", $this->global, $data, NULL);
  }

  public function formpeminjaman(){
    $divisi = $this->uri->segment(2);

    $this->global['pageTitle'] = 'SI ATTA | PT Mirota KSM';
    $data['kendaraan']= $this->master_model->getkendaraanByDivisi($divisi);
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');
    $data['id_divisi'] = $divisi;

    $this->global['pageHeader'] = 'Peminjaman kendaraan PT. Mirota KSM';


    $this->loadViews("kendaraan/formpeminjaman", $this->global, $data, NULL);
  }
}
