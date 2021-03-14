<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class OrderOutModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        $this->db->select('oi.*')
                 ->from('order_out oi');

        $data = $this->db->get()->result();

        $return = array();
        foreach ($data as $v) {
            $return[$v->id]['id'] = $v->id;
            $return[$v->id]['date'] = $v->date;
            $return[$v->id]['customer'] = $v->customer;
            $return[$v->id]['alamat'] = $v->alamat;
            $return[$v->id]['delivery_cost'] = $v->delivery_cost;
            $return[$v->id]['delivery_status'] = $v->delivery_status;
            $return[$v->id]['type'] = $v->type;
            $return[$v->id]['tagihan'] = $this->get_total($v->id);
            $return[$v->id]['total_tagihan'] = $this->get_total($v->id) + $v->delivery_cost;
            $return[$v->id]['data'] = $this->find_by_det($v->id);
        }

        return $return;
    }

    public function find_by_det($id){
        $this->db->select('oid.*, o.nama')
                 ->from('order_out_det oid')
                 ->join('obat o', 'o.id = oid.id_obat')
                 ->join('order_out oi', 'oi.id = oid.id_order_out')
                 ->where('id_order_out', $id);
        
        return $this->db->get()->result_array();       
    }

    public function insert_head($data){
        return $this->db->insert('order_out', $data);
    }

    public function insert_det($data){
        return $this->db->insert('order_out_det', $data);
    }

    public function cek_stok($id_obat, $qty){
        $get_stok = $this->db->get_where('v_stock', ['id_obat' => $id_obat])->row();

        if($get_stok->stock > $qty){
            return true;
        }else{
            return false;
        }
    }

    public function get_total($id){
        $this->db->select('SUM(total) as tagihan, id_order_out')
                 ->from('(select ood.*, o2.harga, (ood.qty * o2.harga) as total 
                    from order_out_det ood 
                    join obat o2 on o2.id = ood.id_obat) t')
                 ->where('id_order_out', $id);

        $data = $this->db->get()->row();
        return $data->tagihan;
    }
}