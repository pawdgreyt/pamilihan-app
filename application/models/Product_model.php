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
                // Search Query
                // $this->db->like('products.product_name', $search);
                // $this->db->or_like('products.product_brand', $search);
                // $this->db->or_like('products.product_description', $search);
                // $this->db->or_like('product_categories.category', $search);
                $query = $this->db->get('products');
                return $query->result_array();
            }

            $query = $this->db->get_where('products', array('id' => $id));
            return $query->row_array();
        }

        public function get_orders($id = FALSE, $limit = FALSE, $offset = FALSE){
            if ($limit) {
                $this->db->limit($limit, $offset);
            }

            if ($id === FALSE) {
                $this->db->order_by('o.id', "DESC");
                $this->db->select('o.*, c.name, c.email, c.phone, c.address, c.id as customer_id');
                $this->db->from('orders as o');
                $this->db->join('users as c', 'c.id = o.customer_id', 'left');
                $query = $this->db->get();
                return $result = $query->result_array();
            }

            $this->db->order_by('o.id', "DESC");
            $this->db->select('o.*, c.name, c.email, c.phone, c.address');
            $this->db->from('orders as o');
            $this->db->join('users as c', 'c.id = o.customer_id', 'left');
            $this->db->where('c.id', $id);
            $query = $this->db->get();
            return $result = $query->result_array();
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

        public function getOrder($id){
            $this->db->select('o.*, c.name, c.email, c.phone, c.address');
            $this->db->from('orders as o');
            $this->db->join('users as c', 'c.id = o.customer_id', 'left');
            $this->db->where('o.id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
            
            // Get order items
            $this->db->select('i.*, p.product_image, p.product_name, p.product_price');
            $this->db->from('order_items as i');
            $this->db->join('products as p', 'p.id = i.product_id', 'left');
            $this->db->where('i.order_id', $id);
            $query2 = $this->db->get();
            $result['items'] = ($query2->num_rows() > 0)?$query2->result_array():array();
            
            // Return fetched data
            return !empty($result)?$result:false;
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