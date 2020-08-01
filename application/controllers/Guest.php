<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Guest extends CI_Controller{
	public $aktif='guest';
	function __construct(){
		parent:: __construct();
		$this->load->model('M_guest', 'm');
	}

	function index(){
		$data['aktif'] = $this->aktif;
		$data['content'] = 'guest/index';
		$this->load->view('tampilan', $data);
	}

	function showAllGuest(){
		$result = $this->m->showAllGuest();
		echo json_encode($result);
	}

	function addGuest(){
		$result = $this->m->addGuest();
		$msg['success'] = false;
		$msg['type'] = 'add';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	function editGuest(){
		$result = $this->m->editGuest();
		echo json_encode($result);
	}

	function updateGuest(){
		$result = $this->m->updateGuest();
		$msg['success'] = false;
		$msg['type'] = 'update';
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

	function deleteGuest(){
		$result = $this->m->deleteGuest();
		$msg['success'] = false;
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}

}