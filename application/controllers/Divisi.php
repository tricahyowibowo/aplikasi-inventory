<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Divisi extends BaseController
{
  /**
   * This is default constructor of the class
   */
  public function __construct()
  {
      parent::__construct();
      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->isLoggedIn();   
  }


  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Dashboard';
      
    $data['list_data']= $this->crud_model->lihatdata('tbl_divisi');


    $this->loadViews("divisi/data", $this->global, $data, NULL);
  }

  public function save(){
    $nama_divisi = $this->input->post('nama_divisi');


    $data = array(
      'nama_divisi' => $nama_divisi
    );

    $sql = $this->crud_model->input($data,'tbl_divisi');

    if (is_null($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Disimpan');
    }

    redirect('divisi');
  }

  public function detaildivisi($id) {

    $where = array(
      'id_divisi' => $id
    );

    $divisi = $this->crud_model->GetDataById($where,'tbl_divisi');
    echo json_encode($divisi[0]);
  }

  public function update(){
    $id_divisi = $this->input->post('id_divisi');
    $nama_divisi = $this->input->post('nama_divisi');

    $where = array(
      'id_divisi' => $id_divisi
    );

    $data = array(
      'nama_divisi' => $nama_divisi
    );

    $sql = $this->crud_model->update($where, $data,'tbl_divisi');

    if (isset($sql)){
      $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Diubah');
    }else{
      $this->set_notifikasi_swal('error','Gagal','Data Gagal Diubah');
    }

    redirect('divisi');
  }

  public function delete(){
    $id_divisi = $this->uri->segment(2);

    $where = array(
      'id_divisi' => $id_divisi
    );

    $this->crud_model->delete($where, 'tbl_divisi');
    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Dihapus');
    redirect('divisi');
  }
}