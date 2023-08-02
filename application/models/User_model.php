<?php 
    class User_model extends CI_Model{
        public function login($username, $password){
            $this->db->where('username', $username);
            $this->db->where('password', $password);
            $this->db->where('status', 'Active');

            $result = $this->db->get('users');

            if ($result->num_rows() == 1) {
                return $result->row(0);
            } else {
                return false;
            }
        }

        public function get_staffs($id = FALSE,$limit = FALSE, $offset = FALSE){
            if ($limit) {
                $this->db->limit($limit, $offset);
            }

            if ($id === FALSE) {
                $this->db->where('role', 'staff');
                $query = $this->db->get('users');
                return $query->result_array();
            }

            $query = $this->db->get_where('users', array('id' => $id));
            return $query->row_array();
        }

        public function create_staff($enc_password){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'status' => 'Active',
                'role' => 'staff',
            );

            return $this->db->insert('users', $data);
        }

        public function update_staff(){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'status' => $this->input->post('status'),
            );

            $this->db->where('id', $this->session->userdata("user_id"));
            return $this->db->update('users', $data);
        }

        public function update_profile(){
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'status' => "Active",
            );

            $this->db->where('id', $this->session->userdata('user_id'));
            return $this->db->update('users', $data);
        }

        public function change_password($enc_password){
            $data = array(
                'password' => $enc_password,
            );

            $this->db->where('id', $this->session->userdata('user_id'));
            return $this->db->update('users', $data);
        }

        public function register($enc_password){
            // User Data
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'phone' => $this->input->post('phone'),
                'address' => $this->input->post('address'),
                'password' => $enc_password,
                'role' => 'customer',
                'status' => 'Active',
            );

            // Insert
            return $this->db->insert('users', $data);
        }

        public function check_username_exists($username){
            $query = $this->db->get_where('users', array('username' => $username));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }

        public function check_email_exists($email){
            $query = $this->db->get_where('users', array('email' => $email));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }

        public function check_old_password($password){
            $query = $this->db->get_where('users', array('id' => $this->session->userdata('user_id'), 'password' => md5($password)));

            if (empty($query->row_array())) {
                return true;
            }else{
                return false;
            }
        }
    }
?>