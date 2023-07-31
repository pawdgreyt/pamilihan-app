<?php 
    class User_model extends CI_Model{
        public function login($username, $password){
            $this->db->where('username', $username);
            $this->db->where('password', $password);

            $result = $this->db->get('users');

            if ($result->num_rows() == 1) {
                return $result->row(0);
            } else {
                return false;
            }
        }

        public function get_staffs(){
            
        }

        public function register($enc_password){
            // User Data
            $data = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $enc_password,
                'role' => 'customer',
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
    }
?>