<?php 
    class Product_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_products(){
            $this->db->order_by('id');
            
            $query = $this->db->get('products');
            return $query->result_array();
        }

        public function create_product($post_image){

            $data = array(
                'product_name' => $this->input->post('product_name'),
                'product_description' => $this->input->post('product_description'),
                'product_brand' => $this->input->post('product_brand'),
                'product_price' => $this->input->post('product_price'),
                'product_qty' => $this->input->post('product_qty'),
                'product_category' => $this->input->post('product_category'),
                'product_image' => $post_image,
                'product_status' => "Active",
                'date_added' => date('Y-m-d H:i:s'),
            );

            return $this->db->insert('products', $data);
        }

        public function check_product_name_exists($product){
            $query = $this->db->get_where('products', array('product_name' => $product));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }
    }

?>