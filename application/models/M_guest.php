<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_guest extends CI_Model {

	function showAllGuest() {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('guest');
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}

	function addGuest() {
		$field = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'no_hp' => $this->input->post('no_hp')
			);
		$this->db->insert('guest', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function editGuest() {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$query = $this->db->get('guest');
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}

	function updateGuest() {
		$id = $this->input->post('id');
		$field = array(
		'nama' => $this->input->post('nama'),
		'alamat' => $this->input->post('alamat'),
		'no_hp' => $this->input->post('no_hp')
		);
		$this->db->where('id', $id);
		$this->db->update('guest', $field);
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	function deleteGuest() {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
		$this->db->delete('guest');
		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}
}