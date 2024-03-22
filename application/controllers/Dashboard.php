<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * @author : Tri Cahya Wibawa
 * @version : 1.0
 * @since : 11 Februari 2024
 */

class Dashboard extends BaseController
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
  }

  public function index(){
    $this->global['pageTitle'] = 'Admin Panel : Dashboard';
    $this->global['pageHeader'] = 'Sistem Asset Mirota KSM';
      
    $data['list_data']= $this->master_model->getDataBarang(0);
    $data['divisi']= $this->crud_model->lihatdata('tbl_divisi');

    $this->loadViews("dashboard", $this->global, $data, NULL);
  }

  public function notiflaporan(){
    $this->isLoggedIn();
    $jumlah_notif_ruangan  = $this->master_model->cekDataNotif('id_kerusakan_ruangan', 'tbl_kerusakan_ruangan');
    $jumlah_notif_barang  = $this->master_model->cekDataNotifBarang($this->divisi_id);

    if($this->divisi_id == 4){
      $jumlah_notif_ruangan = COUNT($jumlah_notif_ruangan);
    }else{
      $jumlah_notif_ruangan = 0;
    }

    $data = array(
      'jumlah_notif_ruangan' => $jumlah_notif_ruangan,
      'jumlah_notif_barang' => COUNT($jumlah_notif_barang)
    );

    echo json_encode($data);
  }
  
}