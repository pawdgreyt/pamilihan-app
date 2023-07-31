<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller{    
    function index(){
        // check login
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
        
        // set title
        $data['title'] = 'Shopping Cart';
        $url['url'] = '';
        
        // Retrieve cart data from the session
        $data['cartItems'] = $this->cart->contents();
        
        // Load the cart view
        
        $this->load->view('templates/header', $url);
        $this->load->view('cart/index', $data);
        $this->load->view('templates/footer');
    }
    
    function updateItemQty(){
        $update = 0;
        
        // Get cart item info
        $rowid = $this->input->get('rowid');
        $qty = $this->input->get('qty');
        
        // Update item in the cart
        if(!empty($rowid) && !empty($qty)){
            // Update the cart in database as well
            foreach ($this->cart->contents() as $item) {
                if ($item['rowid'] == $rowid) {
                    $cart_details = $this->cart_model->cart_details_by_user_and_product_id($this->session->userdata('user_id'), $item['id']); // else update the data
                    $product_details = $this->product_model->get_products($item['id']);

                    if ($product_details['product_qty'] >= $qty) { // 
                        $data = array(
                            'rowid' => $rowid,
                            'qty'   => $qty
                        );
                        $update = $this->cart->update($data);
    
                        $data_cart = array(
                            'user_id'    => $this->session->userdata('user_id'),
                            'product_id'    => $item['id'],
                            'qty'    => $qty,
                            'price'    => $product_details['product_price'],
                            'name'    => $product_details['product_name'],
                            'image' => $product_details['product_image']
                        );
    
                        $this->cart_model->update_cart($data_cart, $cart_details['id']);
                    }
                }
            }
        }

        // Return response
        echo $update?'ok':'err';
    }
    
    function removeItem($rowid){
        // deleting the item in cart database
        foreach ($this->cart->contents() as $item) {
            if ($item['rowid'] == $rowid) {
                $cart_details = $this->cart_model->cart_details_by_user_and_product_id($this->session->userdata('user_id'), $item['id']);

                $this->cart_model->remove_item($cart_details['id']);
            }
        }

        // Remove item from cart
        $remove = $this->cart->remove($rowid);
        
        // Redirect to the cart page
        redirect('cart/index');
    }
    
}