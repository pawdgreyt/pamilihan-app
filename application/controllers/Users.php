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
            $this->cart->destroy();

            // Set message
            $this->session->set_flashdata('user_loggedout', 'You are now logged out');
            
            redirect('login');
        }

        public function index(){
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

            $this->load->view('templates/header', $url);
            $this->load->view('users/index', $data);
            $this->load->view('templates/footer');
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