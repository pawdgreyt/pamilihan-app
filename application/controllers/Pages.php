<?php 
    class Pages extends CI_Controller{
        public function view($page = 'home', $offset = 0){
            if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
                show_404();
            }

            $data['title'] = ucfirst($page);
            $url['url'] = base_url();

            //Pagination config
            $config['base_url'] = base_url() . 'products/manage/';
            $config['total_rows'] = $this->db->count_all('products'); // counting of all rows of a table
            $config['per_page'] = 20;
            $config['uri_segment'] = 3;
            $config['attributes'] = array('class' => 'pagination-links');

            $this->pagination->initialize($config);

            $data['products'] = $this->product_model->get_products(FALSE,$config['per_page'], $offset);

            $this->load->view('templates/header',$url);
            $this->load->view('pages/'.$page, $data);
            $this->load->view('templates/footer');
        }
    }
?>