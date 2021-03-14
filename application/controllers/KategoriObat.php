<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class KategoriObat extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('KategoriObatModel', 'kategori_obat');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $kategori_obat = $this->kategori_obat->find_by()->result();
        } else {
            $criteria = array('id' => $id);
            $kategori_obat = $this->kategori_obat->find_by($criteria)->result();
        }
        
        $this->response($kategori_obat, 200);
    }

    function index_post(){
        $data = array(
                    'nama' => $this->post('nama')
                );

        $insert = $this->kategori_obat->insert($data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'nama' => $this->put('nama')
                );

        $update = $this->kategori_obat->update($id, $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        
        $delete = $this->kategori_obat->delete($id);
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
}