<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Stock extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('StockModel', 'stock');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $stock = $this->stock->find_by()->result();
        } else {
            $criteria = array('id_obat' => $id);
            $stock = $this->stock->find_by($criteria)->result();
        }
        
        $this->response($stock, 200);
    }
}