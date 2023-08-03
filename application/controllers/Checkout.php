<?php 
    Class Checkout extends CI_Controller{
        function index(){
            // Redirect if the cart is empty
            if($this->cart->total_items() <= 0){
                redirect('products/index');
            }
            
            // If order request is submitted
            $submit = $this->input->post('placeOrder');
            if(isset($submit)){
                // Insert order
                $order = $this->placeOrder($this->session->userdata("user_id"));
                
                // If the order submission is successful
                if($order){
                    $this->session->set_userdata('success_msg', 'Order placed successfully.');
                    redirect("checkout".'/orderSuccess/'.$order);
                }else{
                    $data['error_msg'] = 'Order submission failed, please try again.';
                }
            }
            
            // Retrieve cart data from the session
            $data['cartItems'] = $this->cart->contents();
            
            // Pass products data to the view
            $url['url'] = "";
            $this->load->view('templates/header', $url);
            $this->load->view("checkout".'/index', $data);
            $this->load->view('templates/footer');
        }

        function placeOrder($custID){
            // Insert order data
            $ordData = array(
                'customer_id' => $custID,
                'grand_total' => $this->cart->total()
            );
            $insertOrder = $this->product_model->insertOrder($ordData);
            
            if($insertOrder){
                // Retrieve cart data from the session
                $cartItems = $this->cart->contents();
                
                // Cart items
                $ordItemData = array();
                $i=0;
                foreach($cartItems as $item){
                    $ordItemData[$i]['order_id']     = $insertOrder;
                    $ordItemData[$i]['product_id']     = $item['id'];
                    $ordItemData[$i]['quantity']     = $item['qty'];
                    $ordItemData[$i]['sub_total']     = $item["subtotal"];

                    // Delete Cart in Database
                    $cart_details = $this->cart_model->cart_details_by_user_and_product_id($this->session->userdata('user_id'), $item['id']);
                    $this->cart_model->remove_item($cart_details['id']);

                    // Todo Deduct the Order to the Inventory of Products
                    
                    $i++;
                }
                
                if(!empty($ordItemData)){
                    // Insert order items
                    $insertOrderItems = $this->product_model->insertOrderItems($ordItemData);
                    
                    if($insertOrderItems){
                        // Remove items from the cart
                        $this->cart->destroy();
                        
                        // Return order ID
                        return $insertOrder;
                    }
                }
            }
            return false;
        }
        
        function orderSuccess($ordID){
            // Fetch order data from the database
            $data['order'] = $this->product_model->getOrder($ordID);

            // Load order details view
            $url['url'] = "";
            $this->load->view('templates/header', $url);
            $this->load->view('checkout/order-success', $data);
            $this->load->view('templates/footer');
        }
    }
?>