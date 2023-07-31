<?php 
    class Categories extends CI_Controller{
        public function index(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            $data['title'] = 'Categories';
            $url['url'] = base_url() . 'categories';

            $data['categories'] = $this->category_model->get_categories();

            
            $this->load->view('templates/header', $url);
            $this->load->view('categories/index', $data);
            $this->load->view('templates/footer');
        }

        public function create(){
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('users/login');
            }

            // check role
            if ($this->session->userdata('role') == "customer") {
                redirect('categories');
            }

            $data['title'] = 'Create Category';
            $url['url'] = '';

            $this->form_validation->set_rules('category', 'Category', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                $this->load->view('templates/header', $url);
                $this->load->view('categories/create', $data);
                $this->load->view('templates/footer');
            } else {
                $this->category_model->create_category();

                // Set message
                $this->session->set_flashdata('category_created', 'Category Created!');

                redirect('categories');
            }
            
        }
    }
?>