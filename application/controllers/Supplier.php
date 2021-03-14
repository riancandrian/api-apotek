<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Supplier extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('SupplierModel', 'supplier');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $supplier = $this->supplier->find_by()->result();
        } else {
            $criteria = array('id' => $id);
            $supplier = $this->supplier->find_by($criteria)->result();
        }
        
        $this->response($supplier, 200);
    }

    function index_post(){
        $data = array(
                    'nama'      => $this->post('nama'),
                    'alamat'    => $this->post('alamat'),
                    'phone'     => $this->post('phone')
                );

        $insert = $this->supplier->insert($data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'nama'      => $this->put('nama'),
                    'alamat'    => $this->put('alamat'),
                    'phone'     => $this->put('phone')
                );

        $update = $this->supplier->update($id, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        
        $delete = $this->supplier->delete($id);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}