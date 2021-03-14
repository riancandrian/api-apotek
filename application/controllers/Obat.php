<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Obat extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('ObatModel', 'obat');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $obat = $this->obat->find_by()->result();
        } else {
            $criteria = array('id' => $id);
            $obat = $this->obat->find_by($criteria)->result();
        }
        
        $this->response($obat, 200);
    }

    function index_post(){
        $data = array(
                    'id_kategori'   => $this->post('kategori'),
                    'nama'          => $this->post('nama'),
                    'harga'         => $this->post('harga'),
                    'satuan'        => $this->post('satuan')
                );

        $insert = $this->obat->insert($data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id_kategori'   => $this->put('kategori'),
                    'nama'          => $this->put('nama'),
                    'harga'         => $this->put('harga'),
                    'satuan'        => $this->put('satuan')
                );

        $update = $this->obat->update($id, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        
        $delete = $this->obat->delete($id);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}