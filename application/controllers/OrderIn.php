<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class OrderIn extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('OrderInModel', 'order_in');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $order_in = $this->order_in->find_by();
        } else {
            $criteria = array('oi.id' => $id);
            $order_in = $this->order_in->find_by($criteria);
        }
        
        $this->response($order_in, 200);
    }

    function index_post(){
        $return = array();
        $data = $this->post();
        $head = array('id_supplier' => $data['id_supplier'], 'date' => date('Y-m-d'));
        $ins_head = $this->order_in->insert_head($head);

        if($ins_head){
            $id_head = $this->db->insert_id();
            $detil   = array(
                'id_obat' => $data['data']['id_obat'],
                'qty' => $data['data']['qty'],
                'id_order_in' => $id_head
            );

            $ins_det = $this->order_in->insert_det($detil);

            if($ins_det){
                $return = $head;
                $return['id'] = $id_head;
                $return['data'] = $detil;
            }
        }

        $this->response($return, 200);
    }
}