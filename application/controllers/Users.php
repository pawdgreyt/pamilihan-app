<?php 
    class Users extends CI_Controller{
        public function login(){
            $data['title'] = 'Log In';
            $url['url'] = '';

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $url);
                $this->load->view('users/login', $data);
                $this->load->view('templates/footer');
            } else {
                $username = $this->input->post('username');
                $password = md5($this->input->post('password'));

                $user_details = $this->user_model->login($username, $password);

                if ($user_details) {
                    // Create Session
                    $user_data = array(
                        'user_id' => $user_details->id,
                        'username' => $username,
                        'name' => $user_details->name,
                        'role' => $user_details->role,
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_data);

                    // Fetching all the items in cart of user
                    $all_cart_items = $this->cart_model->get_all_cart_items_by_user();
                    foreach ($all_cart_items as $item) {
                        $data = array(
                            'id'    => $item['product_id'],
                            'qty'    => $item['qty'],
                            'price'    => $item['price'],
                            'name'    => $item['name'],
                            'image' => $item['image']
                        );
                        $this->cart->insert($data);
                    }

                    // Set message
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                    redirect('pages/view');
                } else {
                    // Set message
                    $this->session->set_flashdata('login_failed', 'Login Failed.');
                    redirect('users/login');
                }
            }
        }

        public function register(){
            $data['title'] = 'Sign Up';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');
            

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header');
                $this->load->view('users/register', $data);
                $this->load->view('templates/footer');
            } else {
                // Encrypt
                $enc_password = md5($this->input->post('password'));

                $this->user_model->register($enc_password);

                // Set message
                $this->session->set_flashdata('user_registered', 'You are now registered');
                redirect('login');
            }
        }

        public function logout(){
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('user_id');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('role');
            $this->session->unset_userdata('name');
            $this->cart->destroy();

            // Set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            
            redirect('login');
        }

        public function index($offset = 0){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // check role
            if ($this->session->userdata('role') == "customer") {
                redirect();
            }

            $data['title'] = "Manage Staff";
            $url['url'] = "";

            //Pagination config
            $config['base_url'] = base_url() . 'manage/staff/';
            $config['total_rows'] = $this->db->count_all('users'); // counting of all rows of a table
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            // retrieve staffs
            $data['staffs'] = $this->user_model->get_staffs(FALSE, $config['per_page'], $offset);

            $this->load->view('templates/header', $url);
            $this->load->view('users/index', $data);
            $this->load->view('templates/footer');
        }

        public function create_staff(){
            if (!$this->session->userdata('logged_in')) {
                redirect('login');
            }

            if ($this->session->userdata('role') != "admin") {
                redirect();
            }

            $data['title'] = 'Create Staff';
            $url['url'] = '';

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
            
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $url);
                $this->load->view('users/create_staff', $data);
                $this->load->view('templates/footer');
            } else {
                // Encrypt
                $enc_password = md5('password');
                $this->user_model->create_staff($enc_password);

                // Set message
                $this->session->set_flashdata('staff_created', 'Staff Created!');

                redirect('manage/staff');
            }
        }

        public function update_staff($id){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            if ($this->session->userdata('role') != "admin") {
                redirect();
            }

            $data['staff'] = $this->user_model->get_staffs($id);

            // set title
            $data['title'] = 'Update Staff';
            $url['url'] = '';

            // set form validation
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('username', 'Username', 'required|callback_check_username_exists');
            $this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

            if (empty($data['staff'])) {
                show_404();
            }

            $this->load->view('templates/header', $url);
            $this->load->view('users/update_staff', $data);
            $this->load->view('templates/footer');
        }

        public function change_password(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            // set title
            $data['title'] = 'Update Password';
            $url['url'] = '';

            // set form validation
            $this->form_validation->set_rules('oldpassword', 'Old Password', 'required|callback_check_old_password');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $url);
                $this->load->view('users/change_password', $data);
                $this->load->view('templates/footer');
            } else {
                // Encrypt
                $enc_password = md5($this->input->post('password'));

                $this->user_model->change_password($enc_password);

                // Set message
                $this->session->set_flashdata('password_changed', 'Password Changed!');
                redirect();
            }
        }

        public function updatestaff(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            if ($this->session->userdata('role') != "admin") {
                redirect();
            }

            $this->user_model->update_staff();

            // Set message
            $this->session->set_flashdata('staff_updated', 'Staff Updated!');

            redirect('manage/staff');
        }

        public function check_old_password($oldpassword){
            $this->form_validation->set_message('check_old_password', 'Old Password does not match.');

            if ($this->user_model->check_old_password($oldpassword)) {
                return false;
            } else {
                return true;
            }
            
        }

        public function check_username_exists($username){
            $this->form_validation->set_message('check_username_exists', 'That username is taken.');

            if ($this->user_model->check_username_exists($username)) {
                return true;
            } else {
                return false;
            }
            
        }

        public function check_email_exists($email){
            $this->form_validation->set_message('check_email_exists', 'That email is taken.');

            if ($this->user_model->check_email_exists($email)) {
                return true;
            } else {
                return false;
            }
            
        }
    }
?>