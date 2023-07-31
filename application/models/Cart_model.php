<?php 
    class Cart_model extends CI_Model{
        public function __construct(){
            $this->load->database();
        }

        public function cart_details_by_user_and_product_id($user_id, $product_id){
            $query = $this->db->get_where('cart', array('user_id' => $user_id, 'product_id' => $product_id));
            return $query->row_array();
        }

        public function get_all_cart_items_by_user(){
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $query = $this->db->get('cart');
            return $query->result_array();
        }

        public function create_cart($insert_data){
            $data = array(
                'user_id' => $insert_data['user_id'],
                'product_id' => $insert_data['product_id'],
                'qty' => $insert_data['qty'],
                'price' => $insert_data['price'],
                'name' => $insert_data['name'],
                'image' => $insert_data['image'],
            );

            return $this->db->insert('cart', $data);
        }

        public function update_cart($update_data, $row_id){
            $data = array(
                'user_id' => $update_data['user_id'],
                'product_id' => $update_data['product_id'],
                'qty' => $update_data['qty'],
                'price' => $update_data['price'],
                'name' => $update_data['name'],
                'image' => $update_data['image'],
            );

            $this->db->where('id', $row_id);
            return $this->db->update('cart', $data);
        }

        public function remove_item($row_id){
            return $this->db->delete('cart', array('id' => $row_id));
        }

        public function items_not_existing_in_cart($user_id, $product_id){
            $query = $this->db->get_where('cart', array('user_id' => $user_id, 'product_id' => $product_id));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }
    }
?>