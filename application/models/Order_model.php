<?php 
    class Order_model extends CI_Model{
        public function __construct(){
            $this->load->database();
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
            $result['items'] = ($query2->num_rows() > 0) ? $query2->result_array() : array() ; // ternary operator checker if the order has order items under it

            // Return fetched data
            return !empty($result)?$result:false;
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
    }
?>
