<?php 
    class Products extends CI_Controller{
        public function index(){
            $data['title'] = "Products";

            $data['products'] = $this->product_model->get_products();
            $this->load->view('templates/header');
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }

        public function create(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // set title
            $data['title'] = 'Create Product';

            // get product categories
            $data['product_categories'] = $this->category_model->get_categories();
            
            // set form validation
            $this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_check_product_name_exists');
            $this->form_validation->set_rules('product_description', 'Product Description', 'required');
            $this->form_validation->set_rules('product_brand', 'Product Brand', 'required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'required');
            $this->form_validation->set_rules('product_qty', 'Product Qty', 'required');
            $this->form_validation->set_rules('product_category', 'Product Category', 'required');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('products/create', $data);
                $this->load->view('templates/footer');
            } else {
                // Upload image
                $config['upload_path'] = './assets/images/products';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2000';
                $config['max_height'] = '2000';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload()) {
                    $errors = array('error' => $this->upload->display_errors());
                    $post_image = 'noimage.png';
                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $post_image = $_FILES['userfile']['name'];
                }

                $this->product_model->create_product($post_image);

                // Set message
                $this->session->set_flashdata('product_created', 'Product Created!');

                redirect('products');
            }
        }

        public function check_product_name_exists($product_name){
            $this->form_validation->set_message('check_product_name_exists', 'Duplicate Product Name.');

            if ($this->product_model->check_product_name_exists($product_name)) {
                return true;
            } else {
                return false;
            }
            
        }
    }
?>