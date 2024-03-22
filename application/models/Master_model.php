<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Master_model extends CI_Model
{

  function cekDataNotif($id, $tabel){
    $this->db->select($id,'is_read');
    $this->db->where('is_read',0);
    $this->db->from($tabel);
    $query = $this->db->get();

    return $query->result();
  }

  function getPenangananById($where,$tabel){
    $this->db->select('*');
    $this->db->where($where);
    $this->db->from($tabel);
    $query = $this->db->get();

    return $query->result();
  }
// ------------------------------------- RUANGAN ------------------------------------------------
  function getDataRuanganLimit(){
    $this->db->select('*, DATE(tgl_mulai) as tanggal_mulai, DATE(tgl_selesai) as tanggal_selesai, TIME(tgl_mulai) as waktu_mulai, TIME(tgl_selesai) as waktu_selesai');
    $this->db->from('tbl_pinjam_ruangan a');
    $this->db->join('tbl_ruangan b', 'b.id_ruangan = a.ruangan_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = a.divisi_id');
    $this->db->limit(5);
    $this->db->order_by('id_pinjam_ruangan','DESC');
    $query = $this->db->get();

    return $query->result();
  }

  function getjadwalruangan(){
    $this->db->select('*, DATE(tgl_mulai) as tanggal_mulai, DATE(tgl_selesai) as tanggal_selesai, TIME(tgl_mulai) as waktu_mulai, TIME(tgl_selesai) as waktu_selesai');
    $this->db->from('tbl_pinjam_ruangan a');
    $this->db->join('tbl_ruangan b', 'b.id_ruangan = a.ruangan_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = a.divisi_id');
    $query = $this->db->get();

    return $query;
  }

  function getLaporanKerusakanRuangan(){
    $this->db->select('id_kerusakan_ruangan, nama_ruangan, keterangan_kerusakan_ruangan, bukti_kerusakan_ruangan, DATE(datecreated) as tgl_pengaduan, TIME(datecreated) as waktu_pengaduan, tgl_penanganan, keterangan_penanganan, status');
    $this->db->from('tbl_kerusakan_ruangan a');
    $this->db->join('tbl_ruangan b','b.id_ruangan = a.ruangan_id');
    $query = $this->db->get();

    return $query->result();
  }
// ------------------------------------- BARANG -----------------------------------------------------
  function getDataBarang($divisi){
    $this->db->select('*');
    $this->db->from('tbl_barang a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');

    if($divisi > 0){
    $this->db->where('divisi_id',$divisi);
    }
    
    $query = $this->db->get();

    return $query->result();
  }

  function cekDataNotifBarang($divisi_id){
    $this->db->select('id_kerusakan_barang, is_read, divisi_id');
    $this->db->from('tbl_kerusakan_barang a');
    $this->db->join('tbl_barang b', 'a.barang_id=b.id_barang');
    $this->db->where('is_read',0);
    $this->db->where('b.divisi_id',$divisi_id);
    $query = $this->db->get();

    return $query->result();
  }

  function getDataBarangLimit(){
    $this->db->select('id_pinjam_barang, id_barang, nama_pinjam_barang, jumlah_pinjam, nama_barang, nama_divisi, userId, DATE(tgl_mulai) as tanggal_mulai, DATE(tgl_selesai) as tanggal_selesai,DATE(tgl_kembali) as tanggal_kembali, TIME(tgl_mulai) as waktu_mulai, TIME(tgl_selesai) as waktu_selesai, TIME(tgl_kembali) as waktu_kembali');
    $this->db->from('tbl_pinjam_barang a');
    $this->db->join('tbl_barang b', 'b.id_barang = a.barang_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = a.divisi_id');
    $this->db->limit(5);
    $this->db->order_by('id_pinjam_barang','DESC');
    $query = $this->db->get();

    return $query->result();
  }

  function getBarangByDivisi($divisi){
    $this->db->select('*');
    $this->db->from('tbl_barang a');
    $this->db->join('tbl_divisi b','b.id_divisi = a.divisi_id');
    $this->db->where('a.divisi_id', $divisi);
    $this->db->where('a.keterangan_barang', 2);
    $query = $this->db->get();

    return $query->result();
  }

  function cekStokBarang($id){
    $this->db->select('stok_barang_normal, stok_barang_dipinjam, stok_barang_rusak');
    $this->db->from('tbl_barang');
    $this->db->where('id_barang', $id);
    $query = $this->db->get();

    $result = $query->row();
    return $result;
  }

  function getPenerimaById($id){
    $this->db->select('*');
    $this->db->from('tbl_pinjam_barang a');
    $this->db->join('tbl_users b', 'b.userId = a.updateId');
    $this->db->where('a.id_pinjam_barang', $id);
    $query = $this->db->get();

    return $query->result();
  }

  function getjadwalbarang($divisi){
    $this->db->select('*, DATE(tgl_mulai) as tanggal_mulai, DATE(tgl_selesai) as tanggal_selesai,DATE(tgl_kembali) as tanggal_kembali, b.divisi_id, TIME(tgl_mulai) as waktu_mulai, TIME(tgl_selesai) as waktu_selesai, TIME(tgl_kembali) as waktu_kembali');
    $this->db->from('tbl_pinjam_barang a');
    $this->db->join('tbl_barang b', 'b.id_barang = a.barang_id');

    if($divisi > 0){
    $this->db->where('b.divisi_id', $divisi);
    }
    
    $this->db->join('tbl_divisi c', 'c.id_divisi = a.divisi_id');
    $query = $this->db->get();

    return $query;
  }

  function getLaporanKerusakanBarang(){
    $this->db->select('id_kerusakan_barang, barang_id, nama_barang, jml_barang, keterangan_kerusakan_barang, bukti_kerusakan_barang, DATE(datecreated) as tgl_pengaduan, TIME(datecreated) as waktu_pengaduan, status');
    $this->db->from('tbl_kerusakan_barang a');
    $this->db->join('tbl_barang b','b.id_barang = a.barang_id');
    $query = $this->db->get();

    return $query->result();
  }

  function getPinjamBarangById($id){
    $this->db->select('id_pinjam_barang, id_barang, jumlah_pinjam, nama_barang, nama_divisi, userId, DATE(tgl_mulai) as tanggal_mulai, DATE(tgl_selesai) as tanggal_selesai,DATE(tgl_kembali) as tanggal_kembali, TIME(tgl_mulai) as waktu_mulai, TIME(tgl_selesai) as waktu_selesai, TIME(tgl_kembali) as waktu_kembali');
    $this->db->from('tbl_pinjam_barang a');
    $this->db->join('tbl_barang b', 'b.id_barang = a.barang_id');
    $this->db->join('tbl_divisi c', 'c.id_divisi = a.divisi_id');
    $this->db->where('a.id_pinjam_barang', $id);
    $query = $this->db->get();

    return $query->result();
  }

  function getBarangByPenangananId($id){
    $this->db->select('barang_id, jml_barang');
    $this->db->from('tbl_kerusakan_barang a');
    $this->db->join('tbl_penanganan_barang b', 'b.kerusakan_barang_id = a.id_kerusakan_barang');
    $this->db->where('id_kerusakan_barang',$id);
    $query = $this->db->get();

    $result = $query->row();
    return $result;
  }

// ------------------------------------- KENDARAAN ------------------------------
  function getDataMobil(){
    $this->db->select('*');
    $this->db->from('tbl_kendaraan');
    $this->db->where('jenis_kendaraan','mobil');
    $query = $this->db->get();

    return $query->result();
  }

  function getDataMontor(){
    $this->db->select('*');
    $this->db->from('tbl_kendaraan');
    $this->db->where('jenis_kendaraan','montor');
    $query = $this->db->get();

    return $query->result();
  }

  function getDataKendaraanById($id){

    $this->db->select('*');
    $this->db->from('tbl_kendaraan');
    $this->db->where('id_kendaraan',$id);
    $query = $this->db->get();
    $result = $query->row();
    return $result;
  }

  function getDataPerawatanByIdKendaraan($id){
    $this->db->select('DATE(tgl_perawatan) as tanggal, TIME(tgl_perawatan) as waktu, detail_perawatan, id_perawatan_kendaraan');
    $this->db->from('tbl_perawatan_kendaraan a');
    $this->db->join('tbl_kendaraan b', 'b.id_kendaraan = a.kendaraan_id');
    $this->db->where('id_kendaraan',$id);
    $query = $this->db->get();

    return $query->result();
  }
}