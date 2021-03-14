<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class OrderInModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        $this->db->select('oi.*, s.nama')
                 ->from('order_in oi')
                 ->join('supplier s', 's.id = oi.id_supplier');

        $data = $this->db->get()->result();

        $return = array();
        foreach ($data as $v) {
            $return[$v->id]['id'] = $v->id;
            $return[$v->id]['date'] = $v->date;
            $return[$v->id]['id_supplier'] = $v->id_supplier;
            $return[$v->id]['data'] = $this->find_by_det($v->id);
        }

        return $return;
    }

    public function find_by_det($id){
        $this->db->select('oid.*, o.nama')
                 ->from('order_in_det oid')
                 ->join('obat o', 'o.id = oid.id_obat')
                 ->join('order_in oi', 'oi.id = oid.id_order_in')
                 ->where('id_order_in', $id);
        
        return $this->db->get()->result_array();       
    }

    public function insert_head($data){
        return $this->db->insert('order_in', $data);
    }

    public function insert_det($data){
        return $this->db->insert('order_in_det', $data);
    }
}