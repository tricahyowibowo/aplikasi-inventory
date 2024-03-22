<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function lihatdata($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result();
	}

    function getdataOrderBy($table){
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();

        return $query->result();
	}

    function GetDataById($where,$table){
        $this->db->select('*');
        $this->db->from($table);
		$this->db->where($where);
        $query = $this->db->get();

        return $query->result();
    }

    function input($data,$table)
    {
        $this->db->insert($table,$data);
    }

    function update($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
	}

    function delete($where,$table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    function cekMaxId($id,$table){
        $this->db->select('MAX('.$id.') as maxId');
        $this->db->from($table);
        $query = $this->db->get();

        $result = $query->row();
        return $result->maxId;
    }

    function selectIn($id, $param, $table){
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($param.' IN ('.$id.')');
        $query = $this->db->get();

        return $query->result();
	}
}