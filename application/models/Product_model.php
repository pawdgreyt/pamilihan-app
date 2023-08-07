<?php 
    class Product_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function get_products($category_id = FALSE, $id = FALSE, $limit = FALSE, $offset = FALSE){
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
            
            if ($id === FALSE) {
                $this->db->select('products.*','products_categories.category',FALSE);
                $this->db->order_by('products.id', 'DESC');
                $this->db->join('product_categories', 'product_categories.id = products.product_category');
                $this->db->where('products.product_status', 'Active');
                if ($category_id != FALSE AND $category_id != "All") {
                    $this->db->where('products.product_category', $category_id);
                }
                $query = $this->db->get('products');
                return $query->result_array();
            }

            $query = $this->db->get_where('products', array('id' => $id));
            return $query->row_array();
        }

        public function count_products_by_category($category_id) {
            $this->db->where('products.product_status', 'Active');
            if ($category_id && $category_id !== 'All') {
                $this->db->where('products.product_category', $category_id);
            }
            return $this->db->count_all_results('products');
        }

        public function get_products_all_status($id = FALSE, $limit = FALSE, $offset = FALSE){
            if ($limit) {
                $this->db->limit($limit, $offset);
            }
            
            if ($id === FALSE) {
                $this->db->select('products.*','products_categories.category',FALSE);
                $this->db->order_by('products.id', 'DESC');
                $this->db->join('product_categories', 'product_categories.id = products.product_category');
                $query = $this->db->get('products');
                return $query->result_array();
            }

            $query = $this->db->get_where('products', array('id' => $id));
            return $query->row_array();
        }

        public function get_similar_products($product_category, $view_product_id) {
            $this->db->order_by('id', 'DESC');
            $this->db->limit(4); // limit the similar products to 4
        
            // Create a proper condition array for the where clause
            $this->db->where(array('product_category' => $product_category, 'id !=' => $view_product_id, 'product_status' => 'Active'));
        
            $query = $this->db->get('products');
            return $query->result_array();
        }

        public function create_product($product_image){

            $data = array(
                'product_name' => $this->input->post('product_name'),
                'product_description' => $this->input->post('product_description'),
                'product_brand' => $this->input->post('product_brand'),
                'product_price' => $this->input->post('product_price'),
                'product_qty' => $this->input->post('product_qty'),
                'product_category' => $this->input->post('product_category'),
                'product_image' => $product_image,
                'product_status' => "Active",
                'date_added' => date('Y-m-d H:i:s'),
            );

            return $this->db->insert('products', $data);
        }

        public function update_product($product_image){
            $data = array(
                'product_name' => $this->input->post('product_name'),
                'product_description' => $this->input->post('product_description'),
                'product_brand' => $this->input->post('product_brand'),
                'product_price' => $this->input->post('product_price'),
                // 'product_qty' => $this->input->post('product_qty'),
                'product_category' => $this->input->post('product_category'),
                'product_image' => $product_image,
                'product_status' => $this->input->post('product_status'),
            );

            $this->db->where('id', $this->input->post('id'));
            return $this->db->update('products', $data);
        }

        public function check_product_name_exists($product){
            $query = $this->db->get_where('products', array('product_name' => $product));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }
        
        /*
         * Insert order data in the database
         * @param data array
         */
        public function insertOrder($data){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Insert order data
            $insert = $this->db->insert("orders", $data);
    
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        
        /*
         * Insert order items data in the database
         * @param data array
         */
        public function insertOrderItems($data = array()) {
            
            // Insert order items
            $insert = $this->db->insert_batch("order_items", $data);
    
            // Return the status
            return $insert?true:false;
        }
    }

?>