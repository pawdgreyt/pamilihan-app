<?php 
    class Orders extends CI_Controller {
        public function manage_orders($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // check login
            if(!$this->session->userdata('role') == "customer"){
                redirect();
            }

            // Pagination config
            $config['base_url'] = base_url() . 'manage_orders';
            $config['total_rows'] = $this->db->count_all('orders');
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            $this->pagination->initialize($config);

            // Defining the data for the views
            $data['title'] = "Orders List";
            $url['url'] = "";
            $data['orders'] = $this->order_model->get_orders(FALSE, $config['per_page'], $offset);

            // Loading the views
            $this->load->view('templates/header',$url);
            $this->load->view('orders/manage_orders', $data);
            $this->load->view('templates/footer');
        }

        public function my_orders($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // Pagination config
            $config['base_url'] = base_url() . 'my_orders';
            $config['total_rows'] = $this->db->where('customer_id', $this->session->userdata("user_id"))->count_all_results('orders');
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            $this->pagination->initialize($config);

            // Defining the data for the views
            $data['title'] = "My Orders History";
            $url['url'] = "";
            $data['orders'] = $this->order_model->get_orders($this->session->userdata("user_id"), $config['per_page'], $offset);

            // Loading the views
            $this->load->view('templates/header',$url);
            $this->load->view('orders/my_orders', $data);
            $this->load->view('templates/footer');
        }

        public function view_order($id = NULL){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // Fetch order data from the database
            $data['order'] = $this->order_model->getOrder($id);
            
            if ($this->session->userdata("role") == 'customer' AND $data['order']['customer_id'] != $this->session->userdata("user_id")) {
                redirect();
            }

            // Load order details view
            $url['url'] = "";
            $this->load->view('templates/header', $url);
            $this->load->view('orders/view_order', $data);
            $this->load->view('templates/footer');
        }
    }
?>