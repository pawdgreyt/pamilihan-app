<?php 
    class Category_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_categories() {
            $this->db->select('product_categories.id, product_categories.category, COUNT(products.id) as product_count');
            $this->db->from('product_categories');
            $this->db->join('products', 'products.product_category = product_categories.id', 'left');
            $this->db->group_by('product_categories.id');
            $query = $this->db->get();
            return $query->result_array();
        }

        public function create_category(){
            $data = array(
                'category' => $this->input->post('category'),
                'date_added' => date('Y-m-d H:i:s'),
            );

            return $this->db->insert('product_categories', $data);
        }

        public function get_category($id){
            $query = $this->db->get_where('categories', array('id' => $id));
            return $query->row();
        }
    }
?>