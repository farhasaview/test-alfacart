<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Dum extends CI_Controller{
	public $aktif='dum';
	function __construct(){
		parent:: __construct();
	}

	function index(){
		$data['aktif'] = $this->aktif;
		$data['content'] = 'permainan/index';
		$this->load->view('tampilan', $data);
	}

}