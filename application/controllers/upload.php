<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Upload extends CI_Controller {

public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

public function index()
    {
        $this->load->view('/templates/asian/upload', array('error' => ''));
    }
}