<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

function set_notifikasi_swal($icon,$title,$text){
  $this->session->set_flashdata('swal_icon', $icon);
  $this->session->set_flashdata('swal_title', $title);
  $this->session->set_flashdata('swal_text', $text);
}