<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Visitor_model extends CI_Model{

  function GetVisitor($ip, $date){
      $this->db->select('*');
      $this->db->from('visitor');
      $this->db->where('ip',$ip);
      $this->db->where('date',$date);

      $query = $this->db->get();
      return $query->num_rows();
  }

  function GetHitsVisitor($ip, $date){
      $this->db->select('hits');
      $this->db->from('visitor');
      $this->db->where('ip',$ip);
      $this->db->where('date',$date);

      $query = $this->db->get();
      return $query->row();
  }

  function CountVisitor(){
      $this->db->select('COUNT(hits) as hits');
      $this->db->from('visitor');

      $query = $this->db->get();
      return $query->row();
  }

  function GetVisitorOnline($bataswaktu){
      $this->db->select('*');
      $this->db->from('visitor');
      $this->db->where('online >',$bataswaktu);

      $query = $this->db->get();
      return $query->num_rows();
  }

  function GetVisitorToday($date){
      $this->db->select('*');
      $this->db->from('visitor');
      $this->db->where('date',$date);
      $this->db->group_by('ip');

      $query = $this->db->get();
      return $query->num_rows();
  }
  
}