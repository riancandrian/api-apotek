<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class OrderOut extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);

        $this->load->model('OrderOutModel', 'order_out');
    }

    function index_get(){
        $id = $this->get('id');
        if ($id == '') {
            $order_out = $this->order_out->find_by();
        } else {
            $criteria = array('oi.id' => $id);
            $order_out = $this->order_out->find_by($criteria);
        }
        
        $this->response($order_out, 200);
    }

    function index_post(){
        $data  = $this->post();
        $valid = true;

        # cek apakah semua stok memenuhi
        foreach ($data['data'] as $key => $value) {
            $cek_stok = $this->order_out->cek_stok($value['id_obat'], $value['qty']);

            if(!$cek_stok){
                $valid = false;
                $this->response(array('status' => 'fail', 'msg' => 'Obat : '.$value['id_obat'].' Tidak cukup !', 502));
            }
        }

        # jika stok memenuhi
        if($valid){
            $return = array();
            $head = array(
                'customer' => $data['customer'],
                'type' => 1,
                'alamat' => $data['alamat'],
                'delivery_cost' => $data['delivery_cost'],
                'delivery_status' => $data['delivery_status']
            );

            $ins_head = $this->order_out->insert_head($head);
            if($ins_head){
                $id_head = $this->db->insert_id();
                $return_det = array();
                foreach ($data['data'] as $key => $value) {
                    $detil = array(
                        'id_obat' => $value['id_obat'],
                        'qty' => $value['qty'],
                        'id_order_out' => $id_head
                    );

                    $return_det[] = $detil;
                    $ins_det = $this->order_out->insert_det($detil);
                }

                $return = $head;
                $return['id'] = $id_head;
                $return['tagihan'] = $this->order_out->get_total($id_head);
                $return['data'] = $return_det;

                $this->response($return, 200);
            }
        }
    }

}