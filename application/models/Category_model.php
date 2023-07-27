<?php 
    class Category_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_categories(){
            $this->db->order_by('category');
            $query = $this->db->get('product_categories');
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

        public function delete_category($id){
            $this->db->where('id', $id);
            $this->db->delete('product_categories');
            return true;
        }
    }
?>