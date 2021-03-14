<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class SupplierModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        return $this->db->get('supplier');
    }

    public function insert($data){
        return $this->db->insert('supplier', $data);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('supplier', $data);
    }

    public function delete($id){
        $is_used = $this->db->get_where('order_in', ['id' => $id])->num_rows();
        if($is_used > 0){
            return false;
        }else{
            $this->db->where('id', $id);
            return $this->db->delete('supplier');
        }
    }
}