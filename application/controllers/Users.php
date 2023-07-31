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
                        'logged_in' => true
                    );

                    $this->session->set_userdata($user_data);

                    // Set message
                    $this->session->set_flashdata('user_loggedin', 'You are now logged in');

                    // Fetching all the items in cart of user
                    $all_cart_items = $this->cart_model->get_all_cart_items_by_user();
                    foreach ($all_cart_items as $item) {
                        $data = array(
                            'id'    => $item['id'],
                            'qty'    => $item['qty'],
                            'price'    => $item['price'],
                            'name'    => $item['name'],
                            'image' => $item['image']
                        );
                        $this->cart->insert($data);
                    }

                    redirect('pages/view');
                } else {
                    // Set message
                    $this->session->set_flashdata('login_failed', 'Login Failed.');
                    redirect('users/login');
                }
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
    }
?>