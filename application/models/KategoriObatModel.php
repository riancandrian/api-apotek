<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class KategoriObatModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        return $this->db->get('kategori_obat');
    }

    public function insert($data){
        return $this->db->insert('kategori_obat', $data);
    }

    public function update($id, $data){
        $this->db->where('id', $id);
        return $this->db->update('kategori_obat', $data);
    }

    public function delete($id){
        $is_used = $this->db->get_where('obat', ['id_kategori' => $id])->num_rows();
        if($is_used > 0){
            return false;
        }else{
            $this->db->where('id', $id);
            return $this->db->delete('kategori_obat');
        }
    }
}