<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class ObatModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        return $this->db->get('obat');
    }

    public function insert($data){
        return $this->db->insert('obat', $data);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('obat', $data);
    }

    public function delete($id){
        $this->db->where('id', $id);
        return $this->db->delete('obat');
    }
}