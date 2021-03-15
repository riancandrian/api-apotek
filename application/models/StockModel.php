<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class StockModel extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function find_by(array $criteria = null){
        if(!empty($criteria)){
            foreach ($criteria as $k => $v) {
                $this->db->where($k, $v);
            }
        }

        return $this->db->get('v_stock');
    }
}