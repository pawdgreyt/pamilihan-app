<?php 
    class Products extends CI_Controller{
        public function index($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }
            
            // Getting the Product Filter
            $selected_category = $this->input->get('product_category');

            // Pagination config
            $config['base_url'] = base_url() . 'products/index/';
            $config['total_rows'] = $this->product_model->count_products_by_category($selected_category);
            $config['per_page'] = 8;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            $this->pagination->initialize($config);

            // Defining the data for the views
            $data['title'] = "Products";
            $url['url'] = base_url() . 'products';
            $data['products'] = $this->product_model->get_products($selected_category, FALSE, $config['per_page'], $offset);
            $data['categories'] = $this->category_model->get_categories();

            // Loading the views
            $this->load->view('templates/header',$url);
            $this->load->view('products/index', $data);
            $this->load->view('templates/footer');
        }

        public function manage($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // check role
            if ($this->session->userdata('role') == "customer") {
                redirect();
            }

            //Pagination config
            $config['base_url'] = base_url() . 'products/manage/';
            $config['total_rows'] = $this->db->count_all('products'); // counting of all rows of a table
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            $data['title'] = "Manage Products";
            $url['url'] = "";


            $data['products'] = $this->product_model->get_products_all_status(FALSE,$config['per_page'], $offset);

            $this->load->view('templates/header', $url);
            $this->load->view('products/manage', $data);
            $this->load->view('templates/footer');
        }

        public function view($id = NULL){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            $data['product'] = $this->product_model->get_products(FALSE,$id);
            $data['similar_products'] = $this->product_model->get_similar_products($data['product']['product_category'], $data['product']['id']);

            if (empty($data['product'])) {
                show_404();
            }

            $data['title'] = "VIEW PRODUCT";
            $url['url'] = "";

            $this->load->view('templates/header', $url);
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
            $url['url'] = '';

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
                $this->load->view('templates/header', $url);
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

            $data['product'] = $this->product_model->get_products(FALSE,$id);

            // set title
            $data['title'] = 'Update Product';
            $url['url'] = '';

            // set form validation
            $this->form_validation->set_rules('product_name', 'Product Name', 'required|callback_check_product_name_exists');
            $this->form_validation->set_rules('product_description', 'Product Description', 'required');
            $this->form_validation->set_rules('product_brand', 'Product Brand', 'required');
            $this->form_validation->set_rules('product_price', 'Product Price', 'required');
            $this->form_validation->set_rules('product_qty', 'Product Qty', 'required');
            $this->form_validation->set_rules('product_category', 'Product Category', 'required');
            $this->form_validation->set_rules('product_status', 'Product Status', 'required');

            // get product categories
            $data['product_categories'] = $this->category_model->get_categories();

            if (empty($data['product'])) {
                show_404();
            }

            $data['title'] = 'Edit Post';

            $this->load->view('templates/header', $url);
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

        public function addToCart($product_id){ // add to cart button
            // Get the product details
            $product = $this->product_model->get_products(FALSE,$product_id);

            if ($product['product_status'] == "Active" AND $product['product_qty'] >= 1) { //check if product status is active and has stocks
                // Add product to the cart
                $data = array(
                    'id'    => $product['id'],
                    'qty'    => 1,
                    'price'    => $product['product_price'],
                    'name'    => $product['product_name'],
                    'image' => $product['product_image']
                );
                $this->cart->insert($data);

                if ($this->items_not_existing_in_cart($this->session->userdata('user_id'), $product['id'])) { // if not existing in table cart insert the data
                    $data_cart = array(
                        'user_id'    => $this->session->userdata('user_id'),
                        'product_id'    => $product['id'],
                        'qty'    => 1,
                        'price'    => $product['product_price'],
                        'name'    => $product['product_name'],
                        'image' => $product['product_image']
                    );

                    $this->cart_model->create_cart($data_cart);
                } else {
                    $cart_details = $this->cart_model->cart_details_by_user_and_product_id($this->session->userdata('user_id'), $product['id']); // else update the data

                    $data_cart = array(
                        'user_id'    => $this->session->userdata('user_id'),
                        'product_id'    => $product['id'],
                        'qty'    => $cart_details['qty'] + 1,
                        'price'    => $product['product_price'],
                        'name'    => $product['product_name'],
                        'image' => $product['product_image']
                    );

                    $this->cart_model->update_cart($data_cart, $cart_details['id']);
                }
            }
            
            // Redirect 
            redirect($_SERVER['HTTP_REFERER']);
        }

        public function add_to_cart_from_form(){
            $productId = $this->input->post('product_id');
            $quantity = $this->input->post('quantity');
            $product = $this->product_model->get_products(FALSE,$productId);

            if ($product['product_status'] == 'Active' AND $product['product_qty'] >= $quantity) { // check if the product status is active and the quantity is greater than or equal to qty stocks
                // Add product to the cart
                $data = array(
                    'id'    => $productId,
                    'qty'    => $quantity,
                    'price'    => $product['product_price'],
                    'name'    => $product['product_name'],
                    'image' => $product['product_image']
                );
                $this->cart->insert($data);

                if ($this->items_not_existing_in_cart($this->session->userdata('user_id'), $productId)) { // if not existing in table cart insert the data
                    $data_cart = array(
                        'user_id'    => $this->session->userdata('user_id'),
                        'product_id'    => $productId,
                        'qty'    => $quantity,
                        'price'    => $product['product_price'],
                        'name'    => $product['product_name'],
                        'image' => $product['product_image']
                    );

                    $this->cart_model->create_cart($data_cart);
                } else {
                    $cart_details = $this->cart_model->cart_details_by_user_and_product_id($this->session->userdata('user_id'), $productId); // else update the data

                    $data_cart = array(
                        'user_id'    => $this->session->userdata('user_id'),
                        'product_id'    => $productId,
                        'qty'    => $cart_details['qty'] + $quantity,
                        'price'    => $product['product_price'],
                        'name'    => $product['product_name'],
                        'image' => $product['product_image']
                    );

                    $this->cart_model->update_cart($data_cart, $cart_details['id']);
                }
            }
            
            // Redirect 
            redirect('products/view/' . $productId);
        }

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
            $config['per_page'] = 8;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');
            $this->pagination->initialize($config);

            // Defining the data for the views
            $data['title'] = "Orders";
            $url['url'] = "";
            $data['orders'] = $this->product_model->get_orders(FALSE, $config['per_page'], $offset);

            // Loading the views
            $this->load->view('templates/header',$url);
            $this->load->view('products/manage_orders', $data);
            $this->load->view('templates/footer');
        }

        public function items_not_existing_in_cart($user_id,$product_id){
            if ($this->cart_model->items_not_existing_in_cart($user_id, $product_id)) {
                return true;
            } else {
                return false;
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