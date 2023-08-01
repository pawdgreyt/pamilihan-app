<?php 
    class Pages extends CI_Controller {

        public function view($offset = 0) {
            // check login
            if(!$this->session->userdata('logged_in')){
                redirect('login');
            }

            $page = 'home';
            if (!file_exists(APPPATH . 'views/pages/' . $page . '.php')) {
                show_404();
            }

            $data['title'] = ucfirst($page);
            $url['url'] = base_url();

            //Pagination config
            $config['base_url'] = base_url() . 'pages/view';
            $config['total_rows'] = $this->product_model->count_products_by_category("All");
            $config['per_page'] = 12;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            $data['products'] = $this->product_model->get_products(FALSE,FALSE, $config['per_page'] , $offset);

            $this->load->view('templates/header', $url);
            $this->load->view('pages/home', $data);
            $this->load->view('templates/footer');
        }
    }
?>