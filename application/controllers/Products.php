<?php 
    class Products extends CI_Controller{
        public function index($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // Pagination config
            $config['base_url'] = base_url() . 'products/index/';
            $config['total_rows'] = $this->db->count_all('products'); // counting of all rows of a table
            $config['per_page'] = 8;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            $data['title'] = "Products";

            $data['products'] = $this->product_model->get_products(FALSE, $config['per_page'], $offset);

            $this->load->view('templates/header');
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }

        public function manage($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            //Pagination config
            $config['base_url'] = base_url() . 'products/manage/';
            $config['total_rows'] = $this->db->count_all('products'); // counting of all rows of a table
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            $data['title'] = "Manage Products";

            $data['products'] = $this->product_model->get_products(FALSE,$config['per_page'], $offset);

            $this->load->view('templates/header');
            $this->load->view('products/manage', $data);
            $this->load->view('templates/footer');
        }

        public function view($id = NULL){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            $data['product'] = $this->product_model->get_products($id);

            if (empty($data['product'])) {
                show_404();
            }

            $data['title'] = "VIEW PRODUCT";

            $this->load->view('templates/header');
            $this->load->view('products/view', $data);
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

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $errors = array('error' => $this->upload->display_errors());
                    $product_image = 'noimage.png';
                } else {
                    // Load the image library
                    $this->load->library('image_lib');

                    // Get the uploaded image data
                    $uploadData = $this->upload->data();
                    $product_image = $uploadData['file_name'];

                    // Configuration for image manipulation
                    $resizeConfig['image_library'] = 'gd2';
                    $resizeConfig['source_image'] = $uploadData['full_path'];
                    $resizeConfig['maintain_ratio'] = FALSE;
                    $resizeConfig['width'] = 400;
                    $resizeConfig['height'] = 400;

                    $this->image_lib->initialize($resizeConfig);

                    if (!$this->image_lib->resize()) {
                        // Handle resizing errors if any
                        $errors = array('error' => $this->image_lib->display_errors());
                        $product_image = 'noimage.png';
                    }

                    // Clear the library configuration
                    $this->image_lib->clear();
                }

                $this->product_model->create_product($product_image);

                // Set message
                $this->session->set_flashdata('product_created', 'Product Created!');

                redirect('products/manage');
            }
        }

        public function edit($id){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            $data['product'] = $this->product_model->get_products($id);

            // set title
            $data['title'] = 'Update Product';

            // set form validation
            $this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_check_product_name_exists');
            $this->form_validation->set_rules('product_description', 'Product Description', 'required');
            $this->form_validation->set_rules('product_brand', 'Product Brand', 'required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'required');
            $this->form_validation->set_rules('product_qty', 'Product Qty', 'required');
            $this->form_validation->set_rules('product_category', 'Product Category', 'required');

            // get product categories
            $data['product_categories'] = $this->category_model->get_categories();

            if (empty($data['product'])) {
                show_404();
            }

            $data['title'] = 'Edit Post';

            $this->load->view('templates/header');
            $this->load->view('products/edit', $data);
            $this->load->view('templates/footer');
        }

        public function update(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }

            // Upload image
            $config['upload_path'] = './assets/images/products';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '2048';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $errors = array('error' => $this->upload->display_errors());
                $product_image = $this->input->post('old_image');
            } else {
                // delete old image
                unlink(FCPATH . "assets/images/products/" . $this->input->post('old_image')); 
                // Load the image library
                $this->load->library('image_lib');

                // Get the uploaded image data
                $uploadData = $this->upload->data();
                $product_image = $uploadData['file_name'];

                // Configuration for image manipulation
                $resizeConfig['image_library'] = 'gd2';
                $resizeConfig['source_image'] = $uploadData['full_path'];
                $resizeConfig['maintain_ratio'] = FALSE;
                $resizeConfig['width'] = 400;
                $resizeConfig['height'] = 400;

                $this->image_lib->initialize($resizeConfig);

                if (!$this->image_lib->resize()) {
                    // Handle resizing errors if any
                    $errors = array('error' => $this->image_lib->display_errors());
                    $product_image = 'noimage.png';
                }

                // Clear the library configuration
                $this->image_lib->clear();
            }


            $this->product_model->update_product($product_image);

            // Set message
            $this->session->set_flashdata('product_updated', 'Product Updated!');

            redirect('products/manage');
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