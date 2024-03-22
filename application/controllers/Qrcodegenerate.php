<?php 
class Qrcodegenerate extends CI_Controller{
  
  public function __construct()
  {
      parent::__construct();
      $name = $this->session->userdata ( 'name' );

      $this->load->model('user_model');
      $this->load->model('crud_model');
      $this->load->model('master_model');
  }

  public function saveBarang(){
    $cekMaxId = $this->crud_model->cekMaxId('id_barang', 'tbl_barang');
    $id = $cekMaxId+1;
    $kode = 'barang';

    $nama_barang = $this->input->post('nama_barang');
    $tgl_pembelian = $this->input->post('tgl_pembelian');
    $lokasi_barang = $this->input->post('lokasi_barang');
    $stok_barang = $this->input->post('stok_barang');
    $keterangan_barang = $this->input->post('keterangan_barang');
    $spesifikasi_barang = $this->input->post('spesifikasi_barang');
    $userId = $this->uri->segment(3);
    $image_name = $this->generateBarcode($kode, $id);


    $data = array(
      'id_barang' => $id,
      'nama_barang' => $nama_barang,
      'tgl_pembelian' => $tgl_pembelian,
      'divisi_id' => $lokasi_barang,
      'stok_barang_normal' => $stok_barang,
      'keterangan_barang' => $keterangan_barang,
      'spesifikasi_barang' => $spesifikasi_barang,
      'qrcode_barang' => $image_name,
      'userId' => $userId
    );

    $sql = $this->crud_model->input($data,'tbl_arang');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('barang');
  }

  public function saveRuangan(){
    $cekMaxId = $this->crud_model->cekMaxId('id_ruangan', 'tbl_ruangan');
    $id = $cekMaxId+1;
    $kode = 'ruangan';

    $nama_ruangan = $this->input->post('nama_ruangan');
    $kondisi_ruangan = $this->input->post('kondisi_ruangan');
    $keterangan_ruangan = $this->input->post('keterangan_ruangan');
    $userId = $this->uri->segment(3);
    $image_name = $this->generateBarcode($kode, $id);


    $data = array(
      'id_ruangan' => $id,
      'nama_ruangan' => $nama_ruangan,
      'kondisi_ruangan' => $kondisi_ruangan,
      'keterangan_ruangan' => $keterangan_ruangan,
      'qrcode_ruangan' => $image_name,
      'userId' => $userId
    );

    $sql = $this->crud_model->input($data,'tbl_ruangan');

    $this->set_notifikasi_swal('success','Berhasil','Data Berhasil Disimpan');
    redirect('ruangan');
  }

  function generateBarcode($kode, $namaqrcode){
    $this->load->library('ciqrcode'); //pemanggilan library QR CODE

    $config['cacheable']    = true; //boolean, the default is true
    $config['cachedir']             = './assets/'; //string, the default is application/cache/
    $config['errorlog']             = './assets/'; //string, the default is application/logs/
    $config['imagedir']             = './assets/images/qrcode/'.$kode.'/'; //direktori penyimpanan qr code
    $config['quality']              = true; //boolean, the default is true
    $config['size']                 = '1024'; //interger, the default is 1024
    $config['black']                = array(224,255,255); // array, default is array(255,255,255)
    $config['white']                = array(70,130,180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $image_name = $kode.'_'.$namaqrcode.'.png'; //buat name dari qr code sesuai dengan nim
 
    $params['data'] = $namaqrcode; //data yang akan di jadikan QR CODE
    $params['level'] = 'H'; //H=High
    $params['size'] = 10;
    $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

		return $image_name;
  }

  function set_notifikasi_swal($icon,$title,$text){
    $this->session->set_flashdata('swal_icon', $icon);
    $this->session->set_flashdata('swal_title', $title);
    $this->session->set_flashdata('swal_text', $text);
  }

}